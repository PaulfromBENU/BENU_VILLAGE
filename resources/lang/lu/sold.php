<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Sold items Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used to translate the sold items display page.
|
*/

$sold_translations = Translation::where('page', 'sold')->get();
$translations_array = [];

foreach ($sold_translations as $translation) {
    $translations_array[$translation->key] = $translation->lu;
}

return $translations_array;
