<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Participate section Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in the participation pages (from the header or footer)
|
*/

$participate_translations = Translation::where('page', 'participate')->get();
$translations_array = [];

foreach ($participate_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;
