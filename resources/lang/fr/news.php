<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| News Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in the news pages
|
*/

$news_translations = Translation::where('page', 'news')->get();
$translations_array = [];

foreach ($news_translations as $translation) {
    $translations_array[$translation->key] = $translation->fr;
}

return $translations_array;
