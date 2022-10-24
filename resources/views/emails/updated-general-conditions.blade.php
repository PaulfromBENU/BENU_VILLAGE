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

	<title>{{ trans('emails.new-conditions-title', [], $locale) }}</title>
</head>
<body style="width: 80%; margin-left: 10%; font-family: 'Barlow';">
	<div style="width: 100%; margin-bottom: 50px; text-align: center;">
		<img src="{{ $message->embed(asset('media/pictures/logo_benu_green.png')) }}" style="height: 180px; margin: auto;" />
	</div>
	<div>
		<p>
			<strong>{{ trans('emails.new-conditions-hello', [], $locale) }} {{ ucfirst($user->first_name) }},</strong>
		</p>
		<p>
			{{ trans('emails.new-conditions-txt-1', [], $locale) }}
		</p>
		<p>
			{{ trans('emails.new-conditions-txt-2', [], $locale) }}
		</p>
		<p>
			{{ trans('emails.new-conditions-txt-3', [], $locale) }} <a href="{{ route('dashboard', ['locale' => $locale]) }}" style="color: #27955B;">{{ trans('emails.new-conditions-txt-4', [], $locale) }}</a> {{ trans('emails.new-conditions-txt-5', [], $locale) }}
		</p>
		<p>
			{{ trans('emails.new-conditions-txt-6', [], $locale) }}
		</p>
		<p>
			{{ trans('emails.new-conditions-txt-7', [], $locale) }} <a href="mailto:info@benucouture.lu" style="color: #27955B;">info@benucouture.lu</a> {{ trans('emails.new-conditions-txt-8', [], $locale) }} <a href="{{ route('client-service-'.$locale, ['page' => __('slugs.services-contact')]) }}" style="color: #27955B;">{{ trans('emails.new-conditions-txt-9', [], $locale) }}</a> {{ trans('emails.new-conditions-txt-10', [], $locale) }}
		</p>
		<p>
			{{ trans('emails.new-conditions-txt-11', [], $locale) }}
		</p>
		<p>
			<em><strong>{{ trans('emails.new-conditions-signature', [], $locale) }}</strong></em>
		</p>
	</div>
</body>
</html>