@extends('layouts.payment_layout')

@section('title')
	{{ __('payment.process-seo-title') }}
@endsection

@section('description')
	{{ __('payment.process-seo-description') }}
@endsection

@section('main-content')
<!-- https://developer.paypal.com/integration-builder -->
	<section class="w-2/3 m-auto text-center">
		<h1 class="text-3xl primary-color mb-5 font-bold">{{ __('payment.process-payment-by-paypal') }}</h1>
		<div class="mb-5">
			<img src="{{ asset('media/pictures/services_payment_paypal.png') }}" style="height: 50px;" class="m-auto" />
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

		<script src="https://www.paypal.com/sdk/js?client-id=AYs7FoPTTx70LosYM1nycZYyWtB8YlxAZKn0jOcUIHxkzPtilbcqptpih0L0KHTbDsOnnpYKAtCduAaS&currency=EUR&disable-funding=card"></script>

		<div id="paypal-button-container"></div>
	</section>
@endsection

@section('scripts')
<script>
  const fundingSources = [
    paypal.FUNDING.PAYPAL
    ]

  for (const fundingSource of fundingSources) {
    const paypalButtonsComponent = paypal.Buttons({
      fundingSource: fundingSource,

      // optional styling for buttons
      // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
      style: {
        shape: 'rect',
        height: 40,
      },

      // set up the transaction
      createOrder: (data, actions) => {
        // pass in any options from the v2 orders create call:
        // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
        const createOrderPayload = {
          purchase_units: [
            {
              amount: {
                value: {{ $order->total_price }},
              },
            },
          ],
        }

        return actions.order.create(createOrderPayload)
      },

      // finalize the transaction
      onApprove: (data, actions) => {
        const captureOrderHandler = (details) => {
          const payerName = details.payer.name.given_name
          // console.log('Transaction completed!')
        }

        return actions.order.capture().then(captureOrderHandler)
      },

      // handle unrecoverable errors
      onError: (err) => {
        console.error(
          'An error prevented the buyer from checking out with PayPal',
        )
      },
    })

    if (paypalButtonsComponent.isEligible()) {
      paypalButtonsComponent
        .render('#paypal-button-container')
        .catch((err) => {
          console.error('PayPal Buttons failed to render');
        })
    } else {
      console.log('The funding source is ineligible');
    }
  }
</script>
<!-- <script>
	paypal.Buttons({

	// Sets up the transaction when a payment button is clicked
	createOrder: (data, actions) => {

		return actions.order.create({
			purchase_units: [{
				amount: {
					value: {{ $order->total_price }} // Can also reference a variable or function
				}
			}]
		});
	},

	// Finalize the transaction after payer approval

	onApprove: (data, actions) => {

		return actions.order.capture().then(function(orderData) {

			// For production
			// actions.redirect('{{ route('payment-processed-'.app()->getLocale(), ['order' => $order_id]) }}');

			// Successful capture! For dev/demo purposes:
			console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
			const transaction = orderData.purchase_units[0].payments.captures[0];
			alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

			// When ready to go live, remove the alert and show a success message within this page. For example:
			// const element = document.getElementById('paypal-button-container');
			// element.innerHTML = '<h3>Thank you for your payment!</h3>';
			// Or go to another URL:  actions.redirect('thank_you.html');
		});
	}

}).render('#paypal-button-container');

</script> -->
@endsection