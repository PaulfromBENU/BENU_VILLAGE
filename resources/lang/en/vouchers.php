<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Vouchers Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used to translate the vouchers display page.
|
*/

$vouchers_translations = Translation::where('page', 'vouchers')->get();
$translations_array = [];

foreach ($vouchers_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;
