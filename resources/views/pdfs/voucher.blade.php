<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bon d'achat BENU</title>

	<style type="text/css">
		@font-face {
			font-family: "Barlow Condensed Regular";
			src: url({{ storage_path('fonts/BarlowCondensed/BarlowCondensed-Regular.ttf') }}) format('truetype');
		}

		@font-face {
			font-family: "Barlow Condensed Medium";
			src: url({{ storage_path('fonts/BarlowCondensed/BarlowCondensed-Medium.ttf') }}) format('truetype');
		}

		@font-face {
			font-family: "Barlow Condensed Medium Italic";
			src: url({{ storage_path('fonts/BarlowCondensed/BarlowCondensed-MediumItalic.ttf') }}) format('truetype');
		}

		@font-face {
			font-family: "Barlow Condensed SemiBold";
			src: url({{ storage_path('fonts/BarlowCondensed/BarlowCondensed-SemiBold.ttf') }}) format('truetype');
		}
	</style>
</head>
<body style="width: 100%; margin-left: 0%; font-family: 'Barlow Condensed Regular'; color: rgb(70, 70, 70); font-size: 0.9rem; position: relative;">
	<div style="position: relative; padding-left: 0px; margin-bottom: 50px; height: 180px;">
		<div style="position: absolute; top: 0; left: 0px;">
			<img src="{{ asset('media/pictures/logo_benu_green.png') }}" style="height: 180px;" />
		</div>
		<div style="position: absolute; top: 18px; left: 80px;">
			<p style="font-family: 'Barlow Condensed SemiBold'; margin-bottom: 0px; padding-bottom: 0px;">
				BENU Village Esch asbl
			</p>
			<p>
				51 rue d'Audun
				<br/>
				4018 Esch-sur-Alzette
				<br/>
				Luxembourg
				<br/>
				+352 27 91 19 49
				<br/>
				<span style="color: #27955B;">
					benu@benuvillageesch.lu
				</span>
			</p>
		</div>
	</div>

	<div>
		<p style="text-align: center; font-size: 2.5rem;">
			{{ __('pdf.voucher-voucher') }}
		</p>
		<p style="text-align: center; font-size: 3.2rem; color: #27955B; font-family: 'Barlow Condensed SemiBold';">
			{{ $voucher->initial_value }}&euro;
		</p>
		<p style="text-align: center; font-size: 2rem;">
			{{ __('pdf.voucher-code') }} : <br/>{{ $voucher->unique_code }}
		</p>
	</div>
	<div>
		<p style="font-size: 2rem; padding-left: 10%;">
			{{ __('pdf.voucher-from') }} :
			<br/>
			{{ __('pdf.voucher-for') }} :
		</p>
	</div>
	<div>
		<p style="text-align: center; font-size: 1.2rem;">
			{{ __('pdf.voucher-available-in-all-shops') }}
			<br/>
			{{ __('pdf.voucher-no-time-limit') }}
		</p>
	</div>
</body>
</html>