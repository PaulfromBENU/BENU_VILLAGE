<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Cart Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for the campaigns pages (all campaigns and specific campaigns)
|
*/

$campaigns_translations = Translation::where('page', 'campaigns')->get();
$translations_array = [];

foreach ($campaigns_translations as $translation) {
    $translations_array[$translation->key] = $translation->lu;
}

return $translations_array;