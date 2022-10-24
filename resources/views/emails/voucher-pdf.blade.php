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

	<title>{{ trans('emails.pdf-voucher-title', [], $locale) }}</title>
</head>
<body style="width: 80%; margin-left: 10%; font-family: 'Barlow';">
	<div style="width: 100%; margin-bottom: 50px; text-align: center;">
		<img src="{{ $message->embed(asset('media/pictures/logo_benu_green.png')) }}" style="height: 180px; margin: auto;" />
	</div>
	<div>
		<p>
			<strong>{{ trans('emails.pdf-voucher-hello', [], $locale) }} {{ ucfirst($buyer->first_name) }},</strong>
		</p>
		<p>
			{{ trans('emails.pdf-voucher-txt-1', [], $locale) }}
		</p>
		<p>
			{{ trans('emails.pdf-voucher-txt-2', [], $locale) }} <a href="{{ route('client-service-'.app()->getLocale(), ['page' => trans('slugs.services-shops', [], $locale)]) }}" style="color: #27955B;">{{ trans('emails.pdf-voucher-txt-3', [], $locale) }}</a> {{ trans('emails.pdf-voucher-txt-4', [], $locale) }}
		</p>
		
		@if($buyer->role == 'guest_client')
			<p>
				{{ trans('emails.pdf-voucher-no-account-1', [], $locale) }} <a href="{{ route('register-'.$locale) }}" style="color: #27955B;">{{ trans('emails.pdf-voucher-no-account-link', [], $locale) }}</a> {{ trans('emails.pdf-voucher-no-account-2', [], $locale) }}
			</p>
		@else
			<p>
				{{ trans('emails.pdf-voucher-with-account-1', [], $locale) }} <a href="{{ route('dashboard', ['locale' => $locale]) }}" style="color: #27955B;">{{ trans('emails.pdf-voucher-with-account-link', [], $locale) }}</a> {{ trans('emails.pdf-voucher-with-account-2', [], $locale) }}
			</p>
		@endif

		<p>
			{{ trans('emails.pdf-voucher-txt-5', [], $locale) }} <a href="{{ route('footer.policy-'.$locale) }}" style="color: #27955B;">{{ trans('emails.pdf-voucher-txt-6', [], $locale) }}</a>.
		</p>

		<p>
			{{ trans('emails.pdf-voucher-txt-7', [], $locale) }} <a href="mailto:info@benucouture.lu" style="color: #27955B;">info@benucouture.lu</a> {{ trans('emails.pdf-voucher-txt-8', [], $locale) }} <a href="{{ route('client-service-'.$locale, ['page' => __('slugs.services-contact')]) }}" style="color: #27955B;">{{ trans('emails.pdf-voucher-txt-9', [], $locale) }}</a> {{ trans('emails.pdf-voucher-txt-10', [], $locale) }}
		</p>

		<p>
			{{ trans('emails.pdf-voucher-txt-11', [], $locale) }}
		</p>
		<p>
			<em><strong>{{ trans('emails.pdf-voucher-signature', [], $locale) }}</strong></em>
		</p>
	</div>
</body>
</html>