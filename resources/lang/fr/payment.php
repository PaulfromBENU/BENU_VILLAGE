<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| News Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in the news pages
|
*/

$payment_translations = Translation::where('page', 'payment')->get();
$translations_array = [];

foreach ($payment_translations as $translation) {
    $translations_array[$translation->key] = $translation->fr;
}

return $translations_array;
