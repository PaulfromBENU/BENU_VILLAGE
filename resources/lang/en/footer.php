<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Footer Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in the footer elements
|
*/

$footer_translations = Translation::where('page', 'footer')->get();
$translations_array = [];

foreach ($footer_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;