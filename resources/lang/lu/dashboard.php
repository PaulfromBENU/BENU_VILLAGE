<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Dashboard Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for the dashboard
|
*/

$dashboard_translations = Translation::where('page', 'dashboard')->get();
$translations_array = [];

foreach ($dashboard_translations as $translation) {
    $translations_array[$translation->key] = $translation->lu;
}

return $translations_array;