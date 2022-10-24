<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Contact Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used on the contact page
|
*/

$contact_translations = Translation::where('page', 'contact')->get();
$translations_array = [];

foreach ($contact_translations as $translation) {
    $translations_array[$translation->key] = $translation->fr;
}

return $translations_array;