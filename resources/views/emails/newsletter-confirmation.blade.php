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

    <title>{{ trans('emails.newsletter-confirmation-title', [], $locale) }}</title>
</head>
<body style="width: 80%; margin-left: 10%; font-family: 'Barlow';">
    <div style="width: 100%; margin-bottom: 50px; text-align: center;">
        <img src="{{ $message->embed(asset('media/pictures/logo_benu_green.png')) }}" style="height: 180px; margin: auto;" />
    </div>
    <div>
        <p>
            <strong>{{ trans('emails.newsletter-confirmation-hello', [], $locale) }} {{ ucfirst($user->first_name) }},</strong>
        </p>
        <p>
            {{ trans('emails.newsletter-confirmation-txt-1', [], $locale) }}
        </p>
        <p>
            {{ trans('emails.newsletter-confirmation-txt-2', [], $locale) }} <a href="mailto:benu@benu.lu" style="color: #27955B;">{{ trans('emails.newsletter-confirmation-txt-3', [], $locale) }}</a> {{ trans('emails.newsletter-confirmation-txt-4', [], $locale) }}
        </p>
        <p>
            {{ trans('emails.newsletter-confirmation-txt-5', [], $locale) }}
        </p>
        <p>
            {{ trans('emails.newsletter-confirmation-txt-6', [], $locale) }} <a href="mailto:benu@benu.lu" style="color: #27955B;">benu@benu.lu</a> {{ trans('emails.newsletter-confirmation-txt-8', [], $locale) }} <a href="{{ route('newsletter-stop-'.$locale, ['id' => rand(10, 99).rand(10, 99).rand(10, 99).$user->id]) }}" style="color: #27955B">{{ trans('emails.newsletter-confirmation-txt-9', [], $locale) }}</a>.
        </p>

        <p>
            {{ trans('emails.newsletter-confirmation-txt-10', [], $locale) }}
        </p>
        <p>
            {{ trans('emails.newsletter-confirmation-txt-11', [], $locale) }}
        </p>
        <p>
            <em><strong>{{ trans('emails.newsletter-confirmation-signature', [], $locale) }}</strong></em>
        </p>
    </div>
</body>
</html>