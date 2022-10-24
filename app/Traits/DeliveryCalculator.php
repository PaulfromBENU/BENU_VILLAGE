<?php

namespace App\Traits;

use App\Models\DeliveryCountry;

use App\Models\Cart;

trait DeliveryCalculator {

	protected $fare_table = [
		'1' => [
			'0.05' => '2',
			'0.5' => '3',
			'1.7' => "6.13",
			'9' => "7.07",
			'18.7' => "8.55",
			'28.5' => "9.05",
		],
		'2' => [
			'0.05' => '2',
			'0.5' => '4',
			'0.9'  => "11.15",
			'1.7' => "11.63",
			'2.6' => '12.10',
			'3.6' => '12.59',
			'4.6' => '12.65',
			'5.5' => '13.12',
			'6.4' => '13.59',
			'7.3' => '14.04',
			'8.3' => '14.51',
			'9' => "14.97",
			'11' => "15.54",
			'12.8' => '16.46',
			'14.8' => '17.36',
			'16.7' => '18.27',
			'18.7' => '18.62',
			'23.5' => '19.49',
			'28.5' => "20.55",
		],
		'3' => [
			'0.05' => '2',
			'0.5' => '4',
			'0.9'  => "13.87",
			'1.7' => "14.23",
			'2.6' => '14.76',
			'3.6' => '15.21',
			'4.6' => '15.92',
			'5.5' => '16.40',
			'6.4' => '16.95',
			'7.3' => '17.52',
			'8.3' => '17.52',
			'9' => "17.52",
			'11' => "18.54",
			'12.8' => '19.19',
			'14.8' => '19.61',
			'16.7' => '20.35',
			'18.7' => '21.08',
			'23.5' => '22.67',
			'28.5' => "23.81",
		],
		'4' => [
			'0.05' => '2',
			'0.5' => '4',
			'0.9'  => "17.04",
			'1.7' => "18.49",
			'2.6' => '19.92',
			'3.6' => '21.37',
			'4.6' => '22.82',
			'5.5' => '23.46',
			'6.4' => '23.99',
			'7.3' => '25.34',
			'8.3' => '26.69',
			'9' => "28.04",
			'11' => "30.57",
			'12.8' => '33.24',
			'14.8' => '35.92',
			'16.7' => '38.61',
			'18.7' => '41.28',
			'23.5' => '47.98',
			'28.5' => "54.70",
		],
		'5' => [
			'0.05' => '2',
			'0.5' => '4',
			'0.9'  => "19.31",
			'1.7' => "22.35",
			'2.6' => '25.62',
			'3.6' => '28.83',
			'4.6' => '28.83',
			'5.5' => '28.83',
			'6.4' => '28.83',
			'7.3' => '28.83',
			'8.3' => '28.83',
			'9' => "28.83",
			'11' => "41.47",
			'12.8' => '46.04',
			'14.8' => '48.60',
			'16.7' => '52.99',
			'18.7' => '57.37',
			'23.5' => '62.95',
			'28.5' => "66.51",
		],
	];

	public function calculateDeliveryTotal($weight, $country_code, $envelope = 0)
	{
		if ($country_code == 'collect') {
			return 0;
		}

		$delivery_cost = 0;

		if($envelope == 0) {
			if (DeliveryCountry::where('country_code', $country_code)->count() == 0) {
				$code = 5;
			} else {
				$code = DeliveryCountry::where('country_code', $country_code)->first()->delivery_zone;
			}

			if(!in_array($code, ['1', '2', '3', '4', '5'])) {
				$code = 5;
			}

			$index = 0;
			foreach ($this->fare_table[$code] as $weight_breakpoint => $amount) {
				if ($index == 0) {
					$delivery_cost = $amount;
				}
				$index ++;
				if ($weight > $weight_breakpoint) {
					$delivery_cost = $amount;
				}
			}

			$delivery_cost += 2;
		} elseif ($envelope == 1) {
			// Case Envelope MINI
			$delivery_cost = 2;
		} elseif ($envelope == 2) {
			// Case Envelope MAXI
			$delivery_cost = 3;
		}

		return $delivery_cost;
	}

	public function calculateDeliveryTotalFromCart(Cart $cart)
	{
		if ($cart->order()->count() > 0 && $cart->order->address_id == 0) {
			return 0;
		}

		$total_weight = 0;

		if ($cart->order()->count() > 0) {
			$country = $cart->order->address->country;
		} else {
			$country = "LU";
		}

		$envelope = 0; // 0: normal package, use grid - 1: MINI envelope - 2: MAXI envelope

		foreach ($cart->couture_variations as $variation) {
			if ($variation->name == 'voucher' && $variation->voucher_type !== 'pdf') {
				$total_weight += 0.02 * $variation->pivot->articles_number;
			} elseif ($variation->name == 'voucher') {
				$total_weight += 0;
			} else {
				$total_weight += $variation->creation->weight / 1000 * $variation->pivot->articles_number;
			}
		}

		if ($total_weight < 0.045) {
			$size_mini_ok = 1;
			$size_maxi_ok = 1;
			foreach ($cart->couture_variations as $variation) {
				if ($variation->name !== 'voucher' && $variation->size_category !== 1) {
					$size_mini_ok = 0;
				} elseif ($variation->name !== 'voucher' && $variation->size_category == 0) {
					$size_maxi_ok = 0;
				}
			}
			if ($size_mini_ok) {
				$envelope = 1;
			} elseif ($size_maxi_ok) {
				$envelope = 2;
			}
		} elseif ($total_weight < 490) {
			$size_maxi_ok = 1;
			foreach ($cart->couture_variations as $variation) {
				if ($variation->name !== 'voucher' && $variation->size_category == 0) {
					$size_maxi_ok = 0;
				}
			}
			if ($size_maxi_ok) {
				$envelope = 2;
			}
		} else {
			$envelope = 0;
		}

		return $this->calculateDeliveryTotal($total_weight, $country, $envelope);
	}
}