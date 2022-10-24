<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Dashboard Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for all emails
|
*/

$emails_translations = Translation::where('page', 'emails')->get();
$translations_array = [];

foreach ($emails_translations as $translation) {
    $translations_array[$translation->key] = $translation->fr;
}

return $translations_array;