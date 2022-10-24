<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Cart Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for the shopping cart
|
*/

$cart_translations = Translation::where('page', 'cart')->get();
$translations_array = [];

foreach ($cart_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;