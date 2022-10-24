<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Client service Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in the client service page
|
*/

$services_translations = Translation::where('page', 'services')->get();
$translations_array = [];

foreach ($services_translations as $translation) {
    $translations_array[$translation->key] = $translation->de;
}

return $translations_array;