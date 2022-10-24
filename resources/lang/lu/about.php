<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| About BENU Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used on the 'About BENU' information page.
|
*/

$about_translations = Translation::where('page', 'about')->get();
$translations_array = [];

foreach ($about_translations as $translation) {
    $translations_array[$translation->key] = $translation->lu;
}

return $translations_array;
