<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Welcome page Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used on the welcome page
|
*/

$welcome_translations = Translation::where('page', 'welcome')->get();
$translations_array = [];

foreach ($welcome_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;