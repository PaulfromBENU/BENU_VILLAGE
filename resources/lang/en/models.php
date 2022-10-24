<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Models Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used to translate the models display page.
|
*/

$models_translations = Translation::where('page', 'models')->get();
$translations_array = [];

foreach ($models_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;
