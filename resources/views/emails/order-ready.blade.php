<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet"> 

	<title>{{ trans('emails.order-is-ready', [], $locale) }}</title>
</head>
<body style="width: 80%; margin-left: 10%; font-family: 'Barlow';">
	<div style="width: 100%; margin-bottom: 50px; text-align: center;">
		<img src="{{ $message->embed(asset('media/pictures/logo_benu_green.png')) }}" style="height: 180px; margin: auto;" />
	</div>
	<div>
		<p>
			<strong>{{ trans('emails.order-ready-hello', [], $locale) }} {{ ucfirst($user->first_name) }},</strong>
		</p>
		@if($order->address_id == 0)
			{{ trans('emails.order-ready-shop-1', [], $locale) }}
		@else
			{{ trans('emails.order-ready-delivery-1', [], $locale) }}
		@endif
		@if($user->role !== 'guest_client')
			<p>
				{{ trans('emails.order-ready-with-account-1', [], $locale) }} <a href="{{ route('dashboard', ['locale' => $locale]) }}" style="color: #27955B;">{{ trans('emails.order-ready-with-account-link', [], $locale) }}</a>.
			</p>
		@else
			<p>
				{{ trans('emails.order-ready-no-account-1', [], $locale) }} <a href="{{ route('register-'.$locale) }}" style="color: #27955B;">{{ trans('emails.order-ready-no-account-link', [], $locale) }}</a> {{ trans('emails.order-ready-no-account-2', [], $locale) }}
			</p>
		@endif

		<p style="text-align: center; color: #27955B;">
			{{ trans('emails.order-ready-txt-1', [], $locale) }} <strong>{{ $order->unique_id }}</strong>
		</p>

		@if($order->address_id == 0)
		<p>
			{{ trans('emails.order-ready-txt-collect-1', [], $locale) }} <a href="{{ route('client-service-'.$locale, ['page' => trans('slugs.services-shops', [], $locale)]) }}" style="color: #27955B;">{{ trans('emails.order-ready-txt-collect-2', [], $locale) }}</a> {{ trans('emails.order-ready-txt-collect-3', [], $locale) }}
		</p>
		<p>
			{{ trans('emails.order-ready-txt-collect-4', [], $locale) }}
		</p>
		@endif
		
		@if($order->address_id > 0 && $order->delivery_link !== null && $order->delivery_link !== "")
		<p>
			{{ trans('emails.order-ready-follow-delivery', [], $locale) }} <a href="https://www.post.lu/de/particuliers/colis-courrier/track-and-trace#/search" style="color: #27955B;">{{ trans('emails.order-ready-follow-delivery-link', [], $locale) }}</a>
		</p>
		<p>
			{{ trans('emails.order-ready-follow-up-number', [], $locale) }} {{ $order->delivery_link }}
		</p>
		@endif
<!-- 
		<p>
			{{ trans('emails.order-ready-txt-2', [], $locale) }}
		</p> -->

		<p>
			{{ trans('emails.order-ready-contact-1', [], $locale) }} <a href="mailto:info@benucouture.lu" style="color: #27955B;">info@benucouture.lu</a> {{ trans('emails.order-ready-contact-2', [], $locale) }} <a href="{{ route('client-service-'.$locale, ['page' => __('slugs.services-contact')]) }}" style="color: #27955B;">{{ trans('emails.order-ready-contact-3', [], $locale) }}</a> {{ trans('emails.order-ready-contact-4', [], $locale) }}
		</p>

		<p>
			{{ trans('emails.order-ready-conclusion', [], $locale) }}
		</p>

		<p>
			<em><strong>{{ trans('emails.order-ready-signature', [], $locale) }}</strong></em>
		</p>
	</div>
</body>
</html>