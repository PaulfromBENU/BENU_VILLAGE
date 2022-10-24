<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Colors Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for colors
|
*/

$colors_translations = Translation::where('page', 'colors')->get();
$translations_array = [];

foreach ($colors_translations as $translation) {
    $translations_array[$translation->key] = $translation->fr;
}

return $translations_array;