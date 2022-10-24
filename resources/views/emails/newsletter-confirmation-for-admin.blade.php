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

    <title>Newsletter BENU - nouvelle inscription</title>
</head>
<body style="width: 80%; margin-left: 10%; font-family: 'Barlow';">
    <div style="width: 100%; margin-bottom: 50px; text-align: center;">
        <img src="{{ $message->embed(asset('media/pictures/logo_benu_green.png')) }}" style="height: 180px; margin: auto;" />
    </div>
    <div>
        <p>
            <strong>Moien,</strong>
        </p>
        <p>
            Une nouvelle demande d'inscription à la newsletter a été envoyée depuis <span style="color: #D41C1B;">BENU COUTURE</span> ! Les coordonnées de la personne sont les suivantes :
        </p>
        <ul>
            <li>Prénom et Nom : {{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</li>
            <li>Email : {{ $user->email }}</li>
            <li>Langue utilisateur : {{ strtoupper($locale) }}</li>
            <li>URL : {{ route('newsletter-'.$locale) }}</li>
            <li>Date et heure de connection : {{ Carbon\Carbon::now()->format('d\/m\/Y H:i:s') }}</li>
            <li>Adresse IP : {{ \Request::ip() }}</li>
        </ul>
        <p>
            Merci de mettre cette information à jour dans la base de données MailChimp ! :)
        </p>
    </div>
</body>
</html>