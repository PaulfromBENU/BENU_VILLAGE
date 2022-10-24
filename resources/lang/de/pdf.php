<?php

use App\Models\Translation;

/*
|--------------------------------------------------------------------------
| PDF files Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in the pdf pages
|
*/

$pdf_translations = Translation::where('page', 'pdf')->get();
$translations_array = [];

foreach ($pdf_translations as $translation) {
    $translations_array[$translation->key] = $translation->de;
}

return $translations_array;
