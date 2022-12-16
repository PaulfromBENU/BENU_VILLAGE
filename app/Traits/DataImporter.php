<?php
// if (strpos(strtolower($picture->getPath()), 'replacement') !== false)
namespace App\Traits;

//use Illuminate\Support\Facades\Storage;

use App\Models\Article;
use App\Models\ArticleCareRecommendation;
use App\Models\ArticleComposition;
use App\Models\ArticlePhoto;
use App\Models\ArticleShop;
use App\Models\CareRecommendation;
use App\Models\Color;
use App\Models\Composition;
use App\Models\Creation;
use App\Models\CreationAccessory;
use App\Models\CreationCategory;
use App\Models\CreationGroup;
use App\Models\CreationKeyword;
use App\Models\Keyword;
use App\Models\Photo;
use App\Models\Shop;
use App\Models\Size;
use App\Models\Translation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;

trait DataImporter {

    public function importTranslations()
    {
        // !! THIS FUNCTION SHOULD ONLY BE RUN AFTER SEEDING THE TRANSLATIONS TABLE WITH THE SEEDER (OTHERWISE SLUGS NOT INCLUDED)
        $raw_translations = json_decode(file_get_contents(asset('json_imports/translations.json')), true);

        echo "<br/><br/><strong>----------------  Importing translations from Sophie's file...</strong><br/>";

        foreach ($raw_translations as $translation) {
            $page = strtolower(explode(".", $translation['key'])[0]);
            $key = strtolower(explode(".", $translation['key'])[1]);

            $path = public_path('../resources/lang/fr/'.$page.'.php');
            if (!File::exists($path)) {
                echo "<span style='color: red;'> !!! Missing translation page for ".$page."</span><br/>";
            }

            if (Translation::where('page', $page)->where('key', $key)->count() > 0) {
                // Case translation key is found in the database
                $updated_translation = Translation::where('page', $page)->where('key', $key)->first();
                if (strpos($translation['fr'], '> lien') !== false || strpos($translation['fr'], '> link') !== false) {
                    echo "Lien à mettre à jour dans le code pour ".$translation['key'].'<br/>';
                } 

                // Import only if translation exists
                if ($translation['fr'] != "") {
                    $updated_translation->fr = $translation['fr'];
                } else {
                    $updated_translation->fr = $page.'.'.$key;
                    echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language FR</span><br/>";
                }
                if ($translation['en'] != "") {
                    $updated_translation->en = $translation['en'];
                } else {
                    $updated_translation->en = $page.'.'.$key;
                    echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language EN</span><br/>";
                }
                if ($translation['de'] != "") {
                    $updated_translation->de = $translation['de'];
                } else {
                    $updated_translation->de = $page.'.'.$key;
                    echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language DE</span><br/>";
                }
                if ($translation['lu'] != "") {
                    $updated_translation->lu = $translation['lu'];
                } else {
                    $updated_translation->lu = $page.'.'.$key;
                    echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language LU</span><br/>";
                }
                
                $updated_translation->translation_key = $translation['key'];
                if ($updated_translation->save()) {
                    echo "<span style='color: green; padding-left: 10px;'>Translation updated in database for ".$page.'.'.$key.", value in French is </span>".$translation['fr']."<br/>";
                }
            } else {
                // Handle translations persisted in database outside of the Translation table
                // Includes colors, types, categories, shops description
                // if ($page == 'colors') {
                //     $new_color = Color::firstOrNew(['name' => $key]);
                //     $new_color->name = $key;

                //     $new_color_translation = Translation::firstOrNew(['page' => 'colors', 'key' => $key]);
                //     $new_color_translation->fr = $translation['fr'];
                //     $new_color_translation->en = $translation['en'];
                //     $new_color_translation->de = $translation['de'];
                //     $new_color_translation->lu = $translation['lu'];
                //     $new_color_translation->translation_key = $page.'.'.$key;

                //     if($new_color->save()  && $new_color_translation->save()) {
                //         echo "<span style='color: green; padding-left: 10px;'>Color ".$key." added and translated in the database</span><br/>";
                //     }
                // } elseif ($page == 'type') {
                //     $new_type = CreationGroup::firstOrNew(['filter_key' => $key]);
                //     $new_type->name_fr = $translation['fr'];
                //     $new_type->name_en = $translation['en'];
                //     $new_type->name_de = $translation['de'];
                //     $new_type->name_lu = $translation['lu'];
                //     $new_type->translation_key = $page.'.'.$key;
                //     if ($new_type->save()) {
                //         echo "<span style='color: green; padding-left: 10px;'>Type ".$key." translated in the database</span><br/>";
                //     }
                // } elseif ($page == 'category') {
                //     $new_category = CreationCategory::firstOrNew(['filter_key' => $key]);
                //     $new_category->name_fr = $translation['fr'];
                //     $new_category->name_en = $translation['en'];
                //     $new_category->name_de = $translation['de'];
                //     $new_category->name_lu = $translation['lu'];
                //     $new_category->translation_key = $page.'.'.$key;
                //     if ($new_category->save()) {
                //         echo "<span style='color: green; padding-left: 10px;'>Category ".$key." translated in the database</span><br/>";
                //     } 
                if ($page == 'shops' && $key == 'description-benu-village') {
                    $new_shop = Shop::where('filter_key', 'benu-esch')->first();
                    $new_shop->description_de = $translation['de'];
                    $new_shop->description_fr = $translation['fr'];
                    $new_shop->description_lu = $translation['lu'];
                    $new_shop->description_en = $translation['en'];
                    if ($new_shop->save()) {
                        echo "<span style='color: green; padding-left: 10px;'>Shop description for BENU Village translated in the database</span><br/>";
                    }
                } elseif ($page == 'services' && strpos($key, 'faq-group') !== false) {
                    $new_faq_info = new Translation();
                    $new_faq_info->page = $page;
                    $new_faq_info->key = $key;
                    $new_faq_info->fr = $translation['fr'];
                    $new_faq_info->en = $translation['en'];
                    $new_faq_info->lu = $translation['lu'];
                    $new_faq_info->de = $translation['de'];
                    $new_faq_info->translation_key = $page.'.'.$key;
                    if ($new_faq_info->save()) {
                        echo "<span style='color: green; padding-left: 10px;'>New element ".$key." added in FAQ</span><br/>";
                    }
                } else {
                    // Case not found at all, create new translation
                    $new_translation = new Translation();
                    $new_translation->page = $page;
                    $new_translation->key = $key;

                    // Import only if translation exists
                    if ($translation['fr'] != "") {
                        $new_translation->fr = $translation['fr'];
                    } else {
                        $new_translation->fr = $page.'.'.$key;
                        echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language FR</span><br/>";
                    }
                    if ($translation['en'] != "") {
                        $new_translation->en = $translation['en'];
                    } else {
                        $new_translation->en = $page.'.'.$key;
                        echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language EN</span><br/>";
                    }
                    if ($translation['de'] != "") {
                        $new_translation->de = $translation['de'];
                    } else {
                        $new_translation->de = $page.'.'.$key;
                        echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language DE</span><br/>";
                    }
                    if ($translation['lu'] != "") {
                        $new_translation->lu = $translation['lu'];
                    } else {
                        $new_translation->lu = $page.'.'.$key;
                        echo "<span style='color: red;'> >>> Translation missing in JSON for ".$page.'.'.$key." in language LU</span><br/>";
                    }
                    $new_translation->translation_key = $page.'.'.$key;
                    if ($new_translation->save()) {
                        echo "<span style='color: green; padding-left: 10px;'>New element ".$page.'.'.$key." added in the database</span><br/>";
                    } else {
                        echo "<span style='color: red;'>*** Not found in Translation database: ".$page.'.'.$key."</span><br/>";
                    }
                }
            }
        }
    }
}