<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Sidebar for articles Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used to translate the sidebar with articles details.
|
*/

$sidebar_translations = Translation::where('page', 'sidebar')->get();
$translations_array = [];

foreach ($sidebar_translations as $translation) {
    $translations_array[$translation->key] = $translation->de;
}

return $translations_array;
