<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Header Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in the headers (includes payment tunnel header)
|
*/

$header_translations = Translation::where('page', 'header')->get();
$translations_array = [];

foreach ($header_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;