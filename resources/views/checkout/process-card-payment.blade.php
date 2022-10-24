@extends('layouts.payment_layout')

@section('title')
	{{ __('payment.process-seo-title') }}
@endsection

@section('description')
	{{ __('payment.process-seo-description') }}
@endsection

@section('main-content')
	<section class="w-11/12 lg:w-2/3 m-auto text-center">
		<h1 class="text-3xl primary-color mb-5 font-bold">{{ __('payment.process-payment-by-card') }}</h1>
		<div class="mb-5">
			<h3 class="text-lg text-bold">{{ __('payment.process-accepted-cards') }}</h3>
			<img src="{{ asset('media/pictures/services_payment_cards.png') }}" style="height: 50px;" class="m-auto" />
		</div>
		<h3 class="text-lg mb-5">{{ __('payment.process-total-price') }}&nbsp;: <span class="primary-color font-bold">{{ $order->total_price }}&euro;</span></h3>

		<div class="mb-10">
			<p>
				{{ __('payment.process-number-of-articles') }}&nbsp;: <span class="primary-color font-bold"> {{ $order->cart->couture_variations()->count() }}</span>
			</p>
			<p>
				{{ __('payment.process-user-details') }}&nbsp;: <span class="primary-color font-bold"> {{ $order->user->first_name }} {{ $order->user->last_name }}</span>
			</p>
		</div>

		<form method="POST" action="{{ route('payment-process-'.app()->getLocale()) }}" class="payment-process" id="payment-form">
			@csrf
			<input type="hidden" name="payment_method" id="payment_method">
			<input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}">

			<div class="mb-10 text-lg p-5 payment-process__form">
				<label>{{ __('payment.card-owner') }}</label>
				<input type="text" name="order_name" value="{{ $order->user->first_name.' '.$order->user->last_name }}" class="mb-10">

				<div id="payment-element"></div>
			</div>

			@if(session('error') !== null)
			<div class="primary-color text-center mb-5">
				{{ __('payment.payment-error-occured') }}
			</div>
			@endif

			<button class="btn-couture-plain btn-couture-plain--fit btn-couture-plain--dark-hover" id="payment-submit-button">
				<div class="spinner hidden" id="spinner">
					{{ __('payment.process-payment-on-going') }}...
				</div>
        		<span id="button-text">{{ __('payment.process-make-payment') }}</span>
        	</button>

        	<div id="payment-message" class="hidden"></div>
		</form>
	</section>
@endsection

@section('scripts')
<script type="text/javascript">
	const stripe = Stripe("{{ config('stripe.public') }}", {
		locale: '{{ app()->getLocale() }}'
	});

	let elements;
	let paymentElement;

	initialize();
	checkStatus();

	document
	  .querySelector("#payment-form")
	  .addEventListener("submit", handleSubmit);

	async function initialize() {
		const { clientSecret } = {!! $client_secret !!};

		const appearance = {
			theme: 'flat',

			variables: {
				colorPrimary: '#d41c1b',
				colorBackground: '#ffffff',
				colorText: '#30313d',
				colorDanger: '#df1b41',
				fontFamily: 'Barlow, Ideal Sans, system-ui, sans-serif',
				spacingUnit: '2px',
				borderRadius: '4px',
				// See all possible variables below
			}
		};

		elements = stripe.elements({ clientSecret, appearance });

		paymentElement = elements.create("payment");
		paymentElement.mount("#payment-element");
	}

	// const cardButton = document.getElementById('payment-submit-button');

	// cardButton.addEventListener('click', async(e) => {
	// 	e.preventDefault();
	// 	setLoading(true);

	// 	const { paymentMethod, error} = await stripe.createPaymentMethod('card', paymentElement);

	// 	if (error) {
	// 		alert('Wrong information entered. Could not process to payment.');
	// 	} else {
	// 		document.getElementById('payment_method').value = paymentMethod.id;
	// 		document.getElementById('payment-form').submit();
	// 	}
	// });

	async function handleSubmit(e) {
		e.preventDefault();
		setLoading(true);

		// const { paymentMethod, error} = await stripe.createPaymentMethod('card', paymentElement);

		// console.log(paymentMethod.id);

		// if (error) {
		// 	alert('Wrong information entered. Could not process to payment.');
		// } else {
		// 	console.log(paymentMethod.id);
		// 	document.getElementById('payment_method').value = paymentMethod.id;
		// 	document.getElementById('payment-form').submit();
		// }

		const { error } = await stripe.confirmPayment({
		elements,
		confirmParams: {
		  // Make sure to change this to your payment completion page
			  return_url: "{{ route('payment-validate-'.app()->getLocale(), ['order' => $order_id]) }}",
			},
		});

		// This point will only be reached if there is an immediate error when
		// confirming the payment. Otherwise, your customer will be redirected to
		// your `return_url`. For some payment methods like iDEAL, your customer will
		// be redirected to an intermediate site first to authorize the payment, then
		// redirected to the `return_url`.
		if (error.type === "card_error" || error.type === "validation_error") {
			showMessage(error.message);
		} else {
			showMessage("An unexpected error occured.");
		}

		setLoading(false);
	}

	// const cardButton = document.getElementById('payment-submit-button');

	// cardButton.addEventListener('click', async(e) => {
	// 	e.preventDefault();
	// 	const { paymentMethod, error} = await stripe.createPaymentMethod('card', cardElement);

	// 	if (error) {
	// 		alert(error);
	// 	} else {
	// 		document.getElementById('payment_method').value = paymentMethod.id;
	// 		document.getElementById('payment-form').submit();
	// 	}
	// });

	// Fetches the payment intent status after payment submission
	async function checkStatus() {
	const clientSecret = new URLSearchParams(window.location.search).get(
	"payment_intent_client_secret"
	);

	if (!clientSecret) {
		return;
	}

	const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

	switch (paymentIntent.status) {
		case "succeeded":
		  showMessage("Payment succeeded!");
		  break;
		case "processing":
		  showMessage("Your payment is processing.");
		  break;
		case "requires_payment_method":
		  showMessage("Your payment was not successful, please try again.");
		  break;
		default:
		  showMessage("Something went wrong.");
		  break;
		}
	}

	// ------- UI helpers -------

	function showMessage(messageText) {
		const messageContainer = document.querySelector("#payment-message");

		messageContainer.classList.remove("hidden");
		messageContainer.textContent = messageText;

		setTimeout(function () {
			messageContainer.classList.add("hidden");
			messageText.textContent = "";
			}, 4000);
	}

	// Show a spinner on payment submission
	function setLoading(isLoading) {
		if (isLoading) {
			// Disable the button and show a spinner
			document.querySelector("#payment-submit-button").disabled = true;
			document.querySelector("#spinner").classList.remove("hidden");
			document.querySelector("#button-text").classList.add("hidden");
		} else {
			document.querySelector("#payment-submit-button").disabled = false;
			document.querySelector("#spinner").classList.add("hidden");
			document.querySelector("#button-text").classList.remove("hidden");
		}
	}

	// elements = stripe.elements({ clientSecret });

	// const elements = stripe.elements();
	// const cardElement = elements.create('card', {
	// 	classes: {
	// 		base: 'StripeElement bg-white w-full p-2 m-auto my-2 rounded-lg'
	// 	},
	// 	style: {
	// 		base: {
	// 			iconColor: '#D41C1B',
	// 			color: '#2E1414',
	// 			fontWeight: '500',
	// 			fontFamily: 'Barlow, Open Sans, Segoe UI, sans-serif',
	// 			fontSize: '18px',
	// 			fontSmoothing: 'antialiased',
	// 			':-webkit-autofill': {
	// 			color: '#2E1414',
	// 			},
	// 			'::placeholder': {
	// 			color: 'grey',
	// 			},
	// 		}
	// 	}
	// })

	// cardElement.mount('#card-element');

	// const cardButton = document.getElementById('payment-submit-button');

	// cardButton.addEventListener('click', async(e) => {
	// 	e.preventDefault();
	// 	const { paymentMethod, error} = await stripe.createPaymentMethod('card', cardElement);

	// 	if (error) {
	// 		alert(error);
	// 	} else {
	// 		document.getElementById('payment_method').value = paymentMethod.id;
	// 		document.getElementById('payment-form').submit();
	// 	}
	// });
</script>

@endsection