<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| Breadcrumbs Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for breadcrumbs at the top of most pages
|
*/

$breadcrumbs_translations = Translation::where('page', 'breadcrumbs')->get();
$translations_array = [];

foreach ($breadcrumbs_translations as $translation) {
    $translations_array[$translation->key] = $translation->fr;
}

return $translations_array;