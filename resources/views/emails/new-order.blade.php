<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet"> 

	<title>{{ trans('emails.new-order-title', [], $locale) }}</title>
</head>
<body style="width: 80%; margin-left: 10%; font-family: 'Barlow';">
	<div style="width: 100%; margin-bottom: 50px; text-align: center;">
		<img src="{{ $message->embed(asset('media/pictures/logo_benu_green.png')) }}" style="height: 180px; margin: auto;" />
	</div>
	<div>
		<p>
			<strong>{{ trans('emails.new-order-hello', [], $locale) }} {{ ucfirst($order->user->first_name) }} !</strong>
		</p>
		<p>
			{{ trans('emails.new-order-txt-1', [], $locale) }}
		</p>
		@if($order->user->role !== 'guest_client')
			<p>
				{{ trans('emails.new-order-txt-account', [], $locale) }} <a href="{{ route('dashboard', ['locale' => $locale]) }}" style="color: #27955B;">{{ trans('emails.new-order-txt-account-link', [], $locale) }}</a>.
			</p>
		@else
			<p>
				{{ trans('emails.new-order-txt-no-account-1', [], $locale) }} <a href="{{ route('register-'.$locale) }}" style="color: #27955B;">{{ trans('emails.new-order-txt-no-account-link', [], $locale) }}</a> {{ trans('emails.new-order-txt-no-account-2', [], $locale) }}
			</p>
		@endif

		@if($order->payment_type == 2 || $order->payment_type == 3)
			<p>
				{{ trans('emails.new-order-not-paid-1', [], $locale) }}
			</p>
			@if($order->payment_type == 2)
			<p>
				{{ trans('emails.new-order-digicash-1', [], $locale) }}
			</p>
			<p style="text-align: center; margin: 20px; font-weight: 600;">
				<em>{{ trans('emails.new-order-digicash-phone', [], $locale) }}</em>
			</p>
			@elseif($order->payment_type == 3)
			<p>
				{{ trans('emails.new-order-transfer-1', [], $locale) }}
			</p>
			<p style="text-align: center; margin: 20px; font-weight: 600;">
				<em>{{ trans('emails.new-order-transfer-1', [], $locale) }}</em><br/>
				<em>{{ trans('emails.new-order-transfer-2', [], $locale) }}</em><br/>
				<em>{{ trans('emails.new-order-transfer-3', [], $locale) }}</em>
			</p>
			@endif
			<p>
				{{ trans('emails.new-order-reference', [], $locale) }}
			</p>
			<p style="text-align: center; margin: 20px; font-weight: 600;">
				BENU{{ $order->unique_id }}
			</p>
		@else
			<p>
				{{ trans('emails.new-order-paid-1', [], $locale) }}
			</p>
		@endif

		<p>
			{{ trans('emails.new-order-txt-2', [], $locale) }} <strong>{{ $order->unique_id }}</strong>
		</p>
		<p>
			{{ trans('emails.new-order-txt-3', [], $locale) }} <strong>{{ $order->total_price }}&euro;</strong>
		</p>
		@if($order->cart->couture_variations()->count() == $order->pdf_vouchers()->count())
		<p>
			{{ trans('emails.new-order-txt-voucher-pdf', [], $locale) }}
		</p>
		@else
		<p>
			{{ trans('emails.new-order-txt-4', [], $locale) }} @if($order->address_id == 0) {{ trans('emails.new-order-benu-shop-1', [], $locale) }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => trans('slugs.services-shops', [], $locale)]) }}" style="color: #27955B;">{{ trans('emails.new-order-benu-shop-2', [], $locale) }}</a> @endif
		</p>
		@endif
		@if($order->address_id > 0)
		<ul>
			<li><strong>{{ $order->address->address_name }}</strong></li>
			<li>{{ $order->address->street_number }}, {{ $order->address->street }}</li>
			<li>{{ $order->address->zip_code }} {{ $order->address->city }}</li>
			<li>{{ $order->address->country }}</li>
			<li>{{ $order->address->phone }}</li>
		</ul>
		@endif
		
		<p>
			{{ trans('emails.new-order-txt-5', [], $locale) }} <a href="mailto:info@benucouture.lu" style="color: #27955B;">info@benucouture.lu</a> {{ trans('emails.new-order-txt-6', [], $locale) }} <a href="{{ route('client-service-'.$locale, ['page' => __('slugs.services-contact')]) }}" style="color: #27955B;">{{ trans('emails.new-order-txt-7', [], $locale) }}</a> {{ trans('emails.new-order-txt-8', [], $locale) }}
		</p>

		<p>
			{{ trans('emails.new-order-txt-9', [], $locale) }}
		</p>
		<p>
			<em><strong>{{ trans('emails.new-order-signature', [], $locale) }}</strong></em>
		</p>
	</div>
</body>
</html>