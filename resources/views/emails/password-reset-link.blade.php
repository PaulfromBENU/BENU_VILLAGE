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

	<title>{{ trans('emails.pwd-reset-title', [], $locale) }}</title>
</head>
<body style="width: 80%; margin-left: 10%; font-family: 'Barlow';">
	<div style="width: 100%; margin-bottom: 50px; text-align: center;">
		<img src="{{ $message->embed(asset('media/pictures/logo_benu_green.png')) }}" style="height: 180px; margin: auto;" />
	</div>
	<p>
		{{ trans('emails.pwd-reset-hello', [], $locale) }}
	</p>
	<p>
		{{ trans('emails.pwd-reset-introduction', [], $locale) }}
	</p>
	<div style="text-align: center; margin-top: 30px; margin-bottom: 30px;">
		<a href="{{ $url }}" style="min-height: 50px; background: #27955B; color: white; padding: 12px 20px; margin: auto; font-size: 1.3rem; text-align: center; border-radius: 6px; text-decoration: none;">
			{{ trans('emails.pwd-reset-reset-pwd-button', [], $locale) }}
		</a>
	</div>
	<p>
		{{ trans('emails.pwd-reset-valid-for-60-min', [], $locale) }}
	</p>
	<p>
		{{ trans('emails.pwd-reset-conclusion', [], $locale) }}
	</p>
	<p>
		<strong>{{ trans('emails.pwd-reset-signature', [], $locale) }}</strong>
	</p>
</body>
</html>