<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Partners Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used by the partners page.
|
*/

$partners_translations = Translation::where('page', 'partners')->get();
$translations_array = [];

foreach ($partners_translations as $translation) {
    $translations_array[$translation->key] = $translation->fr;
}

return $translations_array;