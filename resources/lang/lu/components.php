<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Components Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used on specific components, such as models and articles display
|
*/

$components_translations = Translation::where('page', 'components')->get();
$translations_array = [];

foreach ($components_translations as $translation) {
    $translations_array[$translation->key] = $translation->lu;
}

return $translations_array;