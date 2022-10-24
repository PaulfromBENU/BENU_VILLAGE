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

	<title>Nouvelle commande sur BENU</title>
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
			Une nouvelle commande a été effectuée sur les sites BENU.
		</p>
		<p>
			Numéro de commande : <strong>{{ $order->unique_id }}</strong>
		</p>
		<p>
			Prix total de la commande : <strong>{{ $order->total_price }}&euro;</strong>
		</p>
		<p>
			Adresse de livraison : @if($order->address_id == 0) Retrait en magasin @endif
		</p>
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
			Pour suivre l'état de la commande, rejoindre l'onglet 'Handle Orders' dans le <a href="{{ route('home').'/benu-admin/handle-orders' }}" style="color: #D41C1B;">back-office</a>
		</p>
		<p>
			<em><strong>BENU Web</strong></em>
		</p>
	</div>
</body>
</html>