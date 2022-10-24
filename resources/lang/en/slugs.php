<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Slugs Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used to translate the URLs.
|
*/

$slugs_translations = Translation::where('page', 'slugs')->get();
$translations_array = [];

foreach ($slugs_translations as $translation) {
    $translations_array[$translation->key] = $translation->en;
}

return $translations_array;
