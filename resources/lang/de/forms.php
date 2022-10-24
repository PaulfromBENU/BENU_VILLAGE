<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Forms Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for forms through the whole website
|
*/

$forms_translations = Translation::where('page', 'forms')->get();
$translations_array = [];

foreach ($forms_translations as $translation) {
    $translations_array[$translation->key] = $translation->de;
}

return $translations_array;