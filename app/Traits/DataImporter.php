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

use App\Traits\VariationPhotoHandler;

trait DataImporter {

    use VariationPhotoHandler;

    public function importDataFromSophie()
    {
        // Importation of non creation-specific data
        $cares_created = [];
        $categories_created = [];
        $colors_created = [];
        $compositions_created = [];
        $sizes_created = [];
        $types_created = [];

        $care_recommendations = json_decode(file_get_contents(asset('json_imports/care.json')), true);
        $categories = json_decode(file_get_contents(asset('json_imports/categories.json')), true);
        $colors = json_decode(file_get_contents(asset('json_imports/colors.json')), true);
        $compositions = json_decode(file_get_contents(asset('json_imports/compositions.json')), true);
        $sizes = json_decode(file_get_contents(asset('json_imports/sizes.json')), true);
        $types = json_decode(file_get_contents(asset('json_imports/types.json')), true);

        echo "<br/><br/><strong>----------------  Importing data from Sophie's file...</strong><br/>";

        if (env('APP_ENV') !== 'production') {
            // WARNING: will empty the table!! To be used with caution.
            DB::connection('mysql_couture')->table('article_care_recommendation')->truncate();
            DB::connection('mysql_couture')->table('article_composition')->truncate();
            CareRecommendation::truncate();
            Composition::truncate();
            Color::truncate();
            Size::truncate();
            CreationGroup::truncate();
            echo "<strong>--- All data deleted from CareRecommendation, Composition, Color, Size, CreationGroup tables in database ---</strong><br/>";
        }

        foreach ($care_recommendations as $care) {
            if (!in_array($care['name'], $cares_created)) {
                $new_care = new CareRecommendation();
                $new_care->name = $care['name'];
                if (isset($care['family'])) {
                    $new_care->family = $care['family'];
                }
                $new_care->description_de = $care['description_de'];
                $new_care->description_lu = $care['description_lu'];
                $new_care->description_fr = $care['description_fr'];
                $new_care->description_en = $care['description_en'];
                $new_care->translation_key = $care['translation_key'];
                if ($care['picture'] !== "") {
                    $new_care->picture = $care['picture'];
                } else {
                    $new_care->picture = "services_care_1";
                }
                if ($new_care->save()) {
                    array_push($cares_created, $care['name']);
                    echo "<span style='color:green;'>New care recommendation ".$care['name']." successfully added to the database :)</span><br/>";
                }
            }
        }

        foreach ($categories as $category) {
            if (!in_array($category['filter_key'], $categories_created) && CreationCategory::where('filter_key', $category['filter_key'])->count() == 0) {
                $new_category = new CreationCategory();
                $new_category->name_fr = $category['name_fr'];
                $new_category->name_lu = $category['name_lu'];
                $new_category->name_en = $category['name_en'];
                $new_category->name_de = $category['name_de'];
                $new_category->translation_key = $category['translation_key'];
                $new_category->filter_key = $category['filter_key'];
                if ($new_category->save()) {
                    array_push($categories_created, $category['filter_key']);
                    echo "<span style='color:green;'>New creation category ".$category['name_fr']." successfully added to the database :)</span><br/>";
                }
            }
        }

        foreach ($colors as $color) {
            if (!in_array($color['name_en'], $colors_created)) {
                $new_color = new Color();
                $new_color->name = strtolower($color['name_en']);
                $new_color->hex_code = $color['hex_code'];
                if ($new_color->save()) {
                    array_push($colors_created, $color['name_en']);
                    echo "<span style='color:green;'>New color ".$color['name_en']." successfully added to the database :)</span><br/>";
                }
            }
        }

        foreach ($compositions as $composition) {
            if (!in_array($composition['fabric_fr'], $compositions_created)) {
                $new_composition = new Composition();
                $new_composition->fabric_fr = $composition['fabric_fr'];
                $new_composition->fabric_lu = $composition['fabric_lu'];
                $new_composition->fabric_de = $composition['fabric_de'];
                $new_composition->fabric_en = $composition['fabric_en'];
                $new_composition->translation_key_fabric = $composition['translation_key_fabric'];
                $new_composition->explanation_lu = $composition['explanation_lu'];
                $new_composition->explanation_en = $composition['explanation_en'];
                $new_composition->explanation_de = $composition['explanation_de'];
                $new_composition->explanation_fr = $composition['explanation_fr'];
                $new_composition->translation_key_explanation = $composition['translation_key_explanation'];
                $new_composition->picture = $composition['picture'];
                if ($new_composition->save()) {
                    array_push($compositions_created, $composition['fabric_fr']);
                    echo "<span style='color:green;'>New composition ".$composition['fabric_fr']." successfully added to the database :)</span><br/>";
                }
            }
        }

        foreach ($sizes as $size) {
            if (!in_array($size['value'], $sizes_created)) {
                $new_size = new Size();
                $new_size->value = $size['value'];
                $new_size->category = $size['category'];
                if ($new_size->save()) {
                    array_push($sizes_created, $size['value']);
                    echo "<span style='color:green;'>New size ".$size['value']." successfully added to the database :)</span><br/>";
                }
            }
        }

        foreach ($types as $type) {
            if (!in_array($type['filter_key'], $types_created)) {
                $new_type = new CreationGroup();
                $new_type->name_fr = $type['name_fr'];
                $new_type->name_lu = $type['name_lu'];
                $new_type->name_de = $type['name_de'];
                $new_type->name_en = $type['name_en'];
                $new_type->filter_key = $type['filter_key'];
                $new_type->translation_key = $type['translation_key'];
                if ($new_type->save()) {
                    array_push($types_created, $type['name_fr']);
                    echo "<span style='color:green;'>New type ".$type['name_fr']." successfully added to the database :)</span><br/>";
                }
            }
        }

    }


    public function importCreationsFromLou()
    {
        echo "<br/><br/><strong>----------------  Importing data from Lou's file...</strong><br/>";

        if (env('APP_ENV') != 'production') {
            // WARNING: will empty the table!! To be used with caution.
            Creation::truncate();
            echo "<strong>--- All data deleted from Creations table in database ---</strong><br/>";
        }

        $new_creations = json_decode(file_get_contents(asset('json_imports/creations_lou.json')), true);
        $creations_success = [];
        $creations_failed = [];
        $creations_already_present = [];
        $missing_categories = [];

        $replacements = [
            'JENTINKI' => 'BOBOCA'
        ];

        foreach ($new_creations as $creation) {
            echo "<br/>";
            if (!isset($replacements[$creation['name']])) {
                $new_creation = new Creation();
                //$category_id = 0;
                $error_detected = 0;

                if (!isset($creation['rental_enabled'])) {
                    $creation['rental_enabled'] = 0;
                }

                if (!isset($creation['partner_id'])) {
                    $creation['partner_id'] = "";
                }

                if (Creation::where('name', $creation['name'])->count() == 0) {
                    $new_creation->creation_category_id = null;
                    if(is_string($creation['name']) && strlen($creation['name']) > 1) {
                        $creation['name'] = strtoupper($creation['name']);
                        $new_creation->name = $creation['name'];
                    } else {
                        echo "<span style='color:red;'>!!! ".$creation['name'].": name is not correct...</span><br/>";
                        $error_detected = 1;
                    }

                    // if (strpos(strtolower($creation['desc_loubna']), 'accessoire') !== false) {
                    //     $new_creation->is_accessory = '1';
                    // } else {
                    //     $new_creation->is_accessory = '0';
                    // }

                    if (floatval($creation['price']) != 0) {
                        $new_creation->price = floatval($creation['price']);
                    } else {
                        $error_detected = 1;
                        echo "<span style='color:red;'>!!! ".$creation['name'].": price". $creation['price'] ." is not correct... Creation not imported to database.</span><br/>";
                        //echo "<span style='color:red;'>".$creation['name']."</span><br/>";
                        array_push($creations_failed, $creation['name']);
                    }
                    if (intval($creation['Weight [g]']) != 0) {
                        $new_creation->weight = floatval($creation['Weight [g]']);
                    }
                    $new_creation->description_lu = $creation['description_lu'];
                    $new_creation->description_fr = $creation['description_fr'];
                    $new_creation->description_de = $creation['description_de'];
                    $new_creation->description_en = $creation['description_en'];
                    if($creation['origin_link_en'] == "/") {
                        $new_creation->origin_link_en = "";
                    } else {
                        $new_creation->origin_link_en = $creation['origin_link_en'];
                    }
                    if($creation['origin_link_fr'] == "/") {
                        $new_creation->origin_link_fr = "";
                    } else {
                        $new_creation->origin_link_fr = $creation['origin_link_fr'];
                    }
                    if($creation['origin_link_de'] == "/") {
                        $new_creation->origin_link_de = "";
                    } else {
                        $new_creation->origin_link_de = $creation['origin_link_de'];
                    }
                    if($creation['origin_link_lu'] == "/") {
                        $new_creation->origin_link_lu = "";
                    } else {
                        $new_creation->origin_link_lu = $creation['origin_link_lu'];
                    }
                    $new_creation->rental_enabled = $creation['rental_enabled'];
                    if ($creation['partner_id'] == "") {
                        $new_creation->partner_id = null;
                    } else if(is_int($creation['partner_id'])) {
                        $new_creation->partner_id = $creation['partner_id'];
                    }
                    
                    if ($error_detected == 0 && $new_creation->save()) {
                        echo "<span style='color:green;'>".$creation['name']." successfully added to the database :)</span><br/>";
                        array_push($creations_success, $creation['name']);
                    } else {
                        if (!in_array($creation['name'], $creations_failed)) {
                            array_push($creations_failed, $creation['name']);
                            echo "<span style='color:red;'>*** ".$creation['name']." could not added to the database :(</span><br/>";
                        }
                    }
                } else {
                    array_push($creations_already_present, $creation['name']);
                    echo "<span style='color:orange;'>ooo ".$creation['name']." was already present in the database.</span><br/>";
                }
            }
        }
    }


    public function importCreationsFromSabine()
    {
        $new_creations = json_decode(file_get_contents(asset('json_imports/creations_sabine.json')), true);

        echo "<br/><br/><strong>----------------  Importing data from Sabine's file...</strong><br/>";

        foreach ($new_creations as $creation) {
            echo "<br/>";

            $creation['New BENU Name'] = strtoupper($creation['New BENU Name']);
            if ($creation['New BENU Name'] !== "" && Creation::where('name', $creation['New BENU Name'])->count() > 0) {
                $creation_to_update = Creation::where('name', $creation['New BENU Name'])->first();

                // Assignment of categories - only if not already completed
                if ($creation_to_update->creation_category_id == null) {
                    switch ($creation['Category']) {
                        case 'Home':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'home')->first()->id;
                            break;

                        case 'Blouse & Chemise':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'blouses-shirts')->first()->id;
                            break;

                        case 'Blouson & Veste':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'jackets-vests')->first()->id;
                            break;

                        case 'Bonnet':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'bonnets')->first()->id;
                            break;

                        case 'Accessoire':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'others')->first()->id;
                            $creation_to_update->is_accessory = 1;
                            break;

                        case 'Pull':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'sweaters')->first()->id;
                            break;

                        case 'Top':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'tops')->first()->id;
                            break;

                        case 'Echarpe & Gant':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'scarfs-gloves')->first()->id;
                            break;

                        case 'Sous-vêtement':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'underwear')->first()->id;
                            break;

                        case 'Robe':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'dresses')->first()->id;
                            break;

                        case 'Gilet':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'cardigans')->first()->id;
                            break;

                        case 'Pantalon':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'trousers')->first()->id;
                            break;

                        case 'Jeux':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'games')->first()->id;
                            break;

                        case 'Jupe':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'skirts')->first()->id;
                            break;

                        case 'Sac & Trousse':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'bags-cases')->first()->id;
                            break;

                        case 'T-shirt':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'tee-shirts')->first()->id;
                            break;

                        case 'Masque':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'masks')->first()->id;
                            $creation_to_update->is_accessory = 1;
                            if ($creation['Kids'] == 'VRAI') {
                                $creation_to_update->product_type = 1;
                            } else {
                                $creation_to_update->product_type = 2;
                            }
                            break;

                        case 'Pique-nique':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'picnic')->first()->id;
                            break;

                        case 'Emballages cadeau':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'gift')->first()->id;
                            break;

                        case 'Coussins':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'pillow')->first()->id;
                            break;

                        case 'Démaquillants':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'makeup')->first()->id;
                            break;

                        case 'Maque-pages':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'bookmarks')->first()->id;
                            break;

                        case 'Masques de nuit':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'nightmasks')->first()->id;
                            break;

                        case 'Porte-Monnaies':
                            $creation_to_update->creation_category_id = CreationCategory::where('filter_key', 'wallets')->first()->id;
                            break;
                        
                        default:
                            echo "<span style='color:red;'>!!! Category ".$creation['Category']." is missing. Creation ".$creation['New BENU Name']." was not updated.</span><br/>";
                            break;
                    }
                }

                //Assignment of types
                if ($creation['Unisex'] == 'VRAI' && !($creation_to_update->creation_groups->contains(CreationGroup::where('filter_key', 'unisex')->first()->id))) {
                    $creation_to_update->creation_groups()->attach(CreationGroup::where('filter_key', 'unisex')->first()->id);
                }

                if ($creation['Ladies'] == 'VRAI' && !($creation_to_update->creation_groups->contains(CreationGroup::where('filter_key', 'ladies')->first()->id))) {
                    $creation_to_update->creation_groups()->attach(CreationGroup::where('filter_key', 'ladies')->first()->id);
                }

                if ($creation['Men'] == 'VRAI' && !($creation_to_update->creation_groups->contains(CreationGroup::where('filter_key', 'gentlemen')->first()->id))) {
                    $creation_to_update->creation_groups()->attach(CreationGroup::where('filter_key', 'gentlemen')->first()->id);
                }

                if ($creation['Kids'] == 'VRAI' && !($creation_to_update->creation_groups->contains(CreationGroup::where('filter_key', 'kids')->first()->id))) {
                    $creation_to_update->creation_groups()->attach(CreationGroup::where('filter_key', 'kids')->first()->id);
                }

                // Accessory not attached as a creation group (type) anymore, boolean 'is_accessory' used instead
                if ($creation['Accessories'] == 'VRAI') {
                    $creation_to_update->is_accessory = '1';
                }

                // if ($creation['Accessories'] == 'VRAI' && !($creation_to_update->creation_groups->contains(CreationGroup::where('filter_key', 'accessories')->first()->id))) {
                //     $creation_to_update->creation_groups()->attach(CreationGroup::where('filter_key', 'accessories')->first()->id);
                // }

                if ($creation['Home'] == 'VRAI' && !($creation_to_update->creation_groups->contains(CreationGroup::where('filter_key', 'home')->first()->id))) {
                    $creation_to_update->creation_groups()->attach(CreationGroup::where('filter_key', 'home')->first()->id);
                }


                if($creation_to_update->save()) {
                    echo "<span style='color:green;'>".$creation['New BENU Name']." was updated in the database.</span><br/>";
                } else {
                    echo "<span style='color:red;'>*** An error occured when updating ".$creation['New BENU Name']." in the database. Update aborted.</span><br/>";
                }
            } else {
                echo "<span style='color:red;'>*** ".$creation['New BENU Name']." was not found in the database.</span><br/>";
            }
        }

        // Display all creations with no category
        foreach (Creation::where('creation_category_id', null)->get() as $creation_with_no_category) {
            echo "<span style='color:orange;'>xxx ".$creation_with_no_category->name." does not have a category.</span><br/>";
            //echo "<span style='color:orange;'>o ".$creation_with_no_category->name."</span><br/>";
        }

        // For copy in Numbers
        // $articles_array = [];
        // foreach (Article::all() as $article) {
        //     array_push($articles_array, ['name' => $article->name, 'creation' => $article->creation->name, 'color' => $article->color->name, 'size' => $article->size->value]);
        // }
        // $articles_json = json_encode($articles_array, true);
        // echo $articles_json;
    }


    public function createModelsFolders()
    {
        $folders_created = [];
        $folders_not_created = [];

        
            $new_creations = json_decode(file_get_contents(asset('json_imports/creations_lou.json')), true);

            foreach ($new_creations as $creation) {
                if ($creation['name'] != "" && $creation['google_drive_link'] != "") {
                    $path = public_path('images/pictures/articles/to_be_processed/'.strtoupper($creation['name']));

                    if(!File::isDirectory($path)){
                        File::makeDirectory($path);//, 0755, true, true
                        array_push($folders_created, strtoupper($creation['name']));
                    }
                } else {
                    array_push($folders_not_created, strtoupper($creation['name']));
                }
            }

            dd('Dossiers créés :', $folders_created, "Dossiers non créés :", $folders_not_created);
    }

    public function createArticlesFromPictures()
    {
        echo "<strong>------------  Creating articles from pictures...</strong><br/>";

        if (env('APP_ENV') != 'production') {
            // WARNING: will empty the table!! To be used with caution.
            // Article::truncate(); Deactivated if seeder used before
            Photo::truncate();
            echo "<strong>--- All data deleted from Articles table in database ---</strong><br/>";
        }

        $pic_count = 0;
        $success_number = 0;
        $failure_number = 0;
        $missing_sizes_number = 0;
        $missing_colors = [];
        $missing_sizes = [];


        foreach (Creation::where('creation_category_id', '<>', null)->get() as $creation) {

            $article_counter = 1;
            $article_pic_count = 0;

            if (File::exists(public_path('images/pictures/articles/to_be_processed/'.strtoupper($creation->name)))) {
                // Check if folder with model name exists
                $all_pictures = File::allFiles(public_path('images/pictures/articles/to_be_processed/'.strtoupper($creation->name)));
                foreach ($all_pictures as $picture) {
                    $picture_name = trim($picture->getFilename());
                    $picture_info = explode(" ", $picture_name);
                    $color_options = [
                        'beige', 'wool', 'caramel', 'black', 'back', 'dark', 'babyblue', 'blue', 'cyan', 'darkblue', 'fadedblue',  'lightblue', 'ligthblue', 'marineblue', 'navy', 'navyblue', 'skyblue', 'stoneblue', 'turquoise', 'blueish', 'thin', 'thinblue', 'camo', 'royal', 'teal', 'bronze', 'Brown', 'brown', 'brownish', 'darkbrown', 'maroon', 'marron', 'chestnut', 'lightbrown', 'Denim', 'jeans', 'jean', 'darkgreen', 'green', 'greenish', 'khaki', 'militarygreen', 'mint', 'neongreen', 'olive', 'lightgreen', 'kaki', 'sacramento', 'moss', 'darkgrey', 'rey', 'grey', 'greyish', 'jeangrey', 'lightgrey', 'floral', 'flowers', 'Mosaique', 'colorful', 'various', 'multicolor', 'motive', 'pink', 'rose', 'baby', 'salmon', 'lightrose', 'deep_mauve', 'eggplant', 'lightpurple', 'mauve', 'purple', 'lavender', 'bordeau', 'bordeaux', 'burgundy', 'darkred', 'red', 'firered', 'velvet', 'cream', 'creamwhite', 'white', 'whtie', 'creamy', 'golden', 'lightyellow', 'mustard', 'neonyellow', 'yellow', 'trombone', 'orange', 'deep', 'old',
                    ];

                    if (in_array(explode("_", $picture_info[2])[0], $color_options)) {
                        $color_index = 2;
                    } else {
                        $color_index = 1;
                    }

                    if ($creation->is_accessory == '0') {
                        if(count($picture_info) == 10) {
                            // $color_index = 2;
                            $size_index = 9;
                        } else {
                            // $color_index = 1;
                            $size_index = 8;
                        }
                    } else {
                        if (count($picture_info) == 10) {
                            // $color_index = 2;
                            $size_index = 9;
                        }
                        elseif(count($picture_info) == 9) {
                            // $color_index = 2;
                            $size_index = 8;
                        } else {
                            // $color_index = 2;
                            $size_index = 100; //Not used
                        }
                    }

                    if(count($picture_info) >= 8 && count($picture_info) <= 10) {
                        // Get first three colors from picture file name
                        $picture_colors = $picture_info[$color_index];
                        $picture_main_color = explode("_", $picture_colors)[0];
                        if (isset(explode("_", $picture_colors)[1])) {
                            $picture_secondary_color = explode("_", $picture_colors)[1];
                        } else {
                            $picture_secondary_color = null;
                        }
                        if (isset(explode("_", $picture_colors)[2])) {
                            $picture_third_color = explode("_", $picture_colors)[2];
                        } else {
                            $picture_third_color = null;
                        }

                        // Convert color to one of the existing colors based on Excel file equivalence
                        if (in_array($picture_main_color, ['beige', 'wool', 'caramel'])) {
                            $picture_main_color  = 'beige';
                        } elseif (in_array($picture_main_color, ['black', 'back', 'dark'])) {
                            $picture_main_color  = 'black';
                        } elseif (in_array($picture_main_color, ['babyblue', 'blue', 'cyan', 'darkblue', 'fadedblue',  'lightblue', 'ligthblue', 'marineblue', 'navy', 'navyblue', 'skyblue', 'stoneblue', 'turquoise', 'blueish', 'thin', 'thinblue', 'camo', 'royal', 'teal'])) {
                            $picture_main_color  = 'blue';
                        } elseif (in_array($picture_main_color, ['bronze', 'Brown', 'brown', 'brownish', 'darkbrown', 'maroon', 'marron', 'chestnut', 'lightbrown'])) {
                            $picture_main_color  = 'brown';
                        } elseif (in_array($picture_main_color, ['Denim', 'jeans', 'jean'])) {
                            $picture_main_color  = 'blue';
                        } elseif (in_array($picture_main_color, ['darkgreen', 'green', 'greenish', 'khaki', 'militarygreen', 'mint', 'neongreen', 'olive', 'lightgreen', 'kaki', 'sacramento', 'moss'])) {
                            $picture_main_color  = 'green';
                        } elseif (in_array($picture_main_color, ['darkgrey', 'rey', 'grey', 'greyish', 'jeangrey', 'lightgrey'])) {
                            $picture_main_color  = 'grey';
                        } elseif (in_array($picture_main_color, ['floral', 'flowers', 'Mosaique', 'colorful', 'various', 'multicolor', 'motive'])) {
                            $picture_main_color  = 'multicolored';
                        } elseif (in_array($picture_main_color, ['pink', 'rose', 'baby', 'salmon', 'lightrose'])) {
                            $picture_main_color  = 'pink';
                        } elseif (in_array($picture_main_color, ['deep_mauve', 'eggplant', 'lightpurple', 'mauve', 'purple', 'lavender', 'deep', 'old'])) {
                            $picture_main_color  = 'purple';
                        } elseif (in_array($picture_main_color, ['bordeau', 'bordeaux', 'burgundy', 'darkred', 'red', 'firered', 'velvet'])) {
                            $picture_main_color  = 'red';
                        } elseif (in_array($picture_main_color, ['cream', 'creamwhite', 'white', 'whtie', 'creamy'])) {
                            $picture_main_color  = 'white';
                        } elseif (in_array($picture_main_color, ['golden', 'lightyellow', 'mustard', 'neonyellow', 'yellow', 'trombone'])) {
                            $picture_main_color  = 'yellow';
                        } elseif (in_array($picture_main_color, ['orange'])) {
                            $picture_main_color  = 'orange';
                        }

                        if (isset($picture_info[$size_index]) && in_array($picture_info[$size_index], ['Unique', 'unique', 'unique(1)'])) {
                            $picture_size = "unique";
                        } elseif (count($picture_info) >= 9 && isset($picture_info[$size_index])) {
                            if (explode(".", $picture_info[$size_index])[0] == 'All') {
                                $picture_size = "unique";
                            } else {
                                $picture_size = explode(".", $picture_info[$size_index])[0];
                            }
                        } elseif(count($picture_info) == 8 && $creation->is_accessory == '1') {
                            $picture_size = "unique";
                        } else {
                            $picture_size = 'invalid';
                        }
                        
                        if ($picture_size  == 'M(1)') {
                            $picture_size = 'M';
                        }
                        if ($picture_size  == 'XXL') {
                            $picture_size = '2XL';
                        }
                        if ($picture_size  == 'XL(1)') {
                            $picture_size = 'XL';
                        }

                        if ($picture_size  == 'uk') {
                            $picture_size = 'unique';
                        }

                        if ($picture_size  == 'uy') {
                            $picture_size = 'unique';
                        }

                        // Default value to M for sold articles of unknown size
                        if (strpos(strtolower($picture->getPath()), 'sold') !== false && $picture_size == '0') {
                            $picture_size = 'M';
                        }
                        
                        if (Color::where('name', $picture_main_color)->count() > 0 && Size::where('value', $picture_size)->count() > 0) {
                            $color_id  = Color::where('name', $picture_main_color)->first()->id;
                            $size_id = Size::where('value', $picture_size)->first()->id;

                            if (Article::where('creation_id', $creation->id)
                                         ->where('color_id', $color_id)
                                         ->where('secondary_color', $picture_secondary_color)
                                         ->where('third_color', $picture_third_color)
                                         ->where('size_id', $size_id)
                                         ->count() == 0) {

                                $article_pic_count = 0;

                                $new_article = new Article();
                                $new_article->name = ucfirst(strtolower($creation->name)).'-'.str_pad($article_counter, 3, '0', STR_PAD_LEFT);
                                //$new_article->type  = "article";
                                $new_article->creation_id = $creation->id;
                                // if ($creation->is_accessory == '0') {
                                    $new_article->size_id = $size_id;
                                // }
                                $new_article->color_id = $color_id;
                                $new_article->secondary_color = $picture_secondary_color;
                                $new_article->third_color = $picture_third_color;
                                $new_article->singularity_lu = "";
                                $new_article->singularity_fr = "";
                                $new_article->singularity_en = "";
                                $new_article->singularity_de = "";
                                $new_article->translation_key = "article.singularity-".strtolower($new_article->name);
                                $new_article->creation_date = $picture_info[6];
                                //$new_article->picture_name = $picture_name;

                                $new_article->checked = 1;

                                if ($new_article->save()) {
                                    $article_counter ++;
                                    echo "<span style='color: green; padding-top: 5px;'>New article ".$new_article->name." created for model ".strtoupper($creation->name).", with color ".$picture_main_color.", secondary color ". $picture_secondary_color ." and size ".$picture_size.", from file ".$picture_name."</span><br/>";
                                }
                            }

                            if(Article::where('creation_id', $creation->id)
                                         ->where('color_id', $color_id)
                                         ->where('secondary_color', $picture_secondary_color)
                                         ->where('third_color', $picture_third_color)
                                         ->where('size_id', $size_id)
                                         ->count() == 1) {

                                $new_article = Article::where('creation_id', $creation->id)
                                         ->where('color_id', $color_id)
                                         ->where('secondary_color', $picture_secondary_color)
                                         ->where('third_color', $picture_third_color)
                                         ->where('size_id', $size_id)
                                         ->first();

                                $article_pic_count ++;

                                $new_photo = new Photo();
                                $new_photo_rand_id = rand(100, 999);
                                $new_photo->file_name = 'processed/'.$creation->name.'/'.$new_article->name.'-'.$new_photo_rand_id.''.$article_pic_count.'.png';
                                $new_photo->use_for_model = 1;
                                if (strpos($picture_name, " front ") !== false) {
                                    $new_photo->is_front = '1';
                                }
                                $new_photo->title = $creation->name." by BENU COUTURE - Article ".$article_counter;
                                $new_photo->author = "BENU Village Esch Asbl";

                                $img = Image::make($picture);
                                $img_saved = $this->savePhotoWithWatermark($img, $creation->name, $new_article->name, $article_pic_count, $new_photo_rand_id);
                                // if ($img->width() > $img->height()) {
                                //     $img->rotate(-90);
                                // }
                                // $img->resize(560, 747, function ($constraint) {
                                //     $constraint->aspectRatio();
                                //     $constraint->upsize();
                                // });

                                // // create a new Image instance for inserting a watermark
                                // $watermark = Image::make(public_path('images/pictures/logo_benu_couture_watermark.png'));
                                // $watermark->resize(56, 75, function ($constraint) {
                                //     $constraint->aspectRatio();
                                //     $constraint->upsize();
                                // });
                                // $img->insert($watermark, 'bottom-right', 20, 20);

                                // $save_path = public_path('images/pictures/articles/processed/'.$creation->name);

                                // if(!File::isDirectory($save_path)){
                                //     File::makeDirectory($save_path);//, 0755, true, true
                                // }

                                if ($new_photo->save() && $img_saved) {

                                    $success_number ++;
                                    echo "<span style='color: green; padding-left: 10px;'>New picture added for article ".$new_article->name." of model ".strtoupper($creation->name).", from file ".$picture_name."</span><br/>";

                                    //$new_article->photos()->detach();
                                    $new_article->photos()->attach($new_photo->id);

                                    // Determine if article is sold or in stock. Only handles Benu Esch shop and Hamilius pop-up.
                                    //$new_article->shops()->detach();
                                    if (strpos(strtolower($picture->getPath()), 'hamilius') !== false) {
                                        if (!($new_article->shops->contains(Shop::where('filter_key', 'pop-up-hamilius')->first()->id))) {
                                            $pop_up_id = Shop::where('filter_key', 'pop-up-hamilius')->first()->id;
                                            if (strpos(strtolower($picture->getPath()), 'sold') !== false) {
                                                $new_article->shops()->attach($pop_up_id, ['stock' => '0']);
                                            } else {
                                                $new_article->shops()->attach($pop_up_id, ['stock' => '1']);
                                            }
                                        }
                                    } else {
                                        if (!($new_article->shops->contains(Shop::where('filter_key', 'benu-esch')->first()->id))) {
                                            if (strpos(strtolower($picture->getPath()), 'sold') !== false) {
                                                $new_article->shops()->attach(1, ['stock' => '0']);
                                            } else {
                                                $new_article->shops()->attach(1, ['stock' => '1']);
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "<span style='color: red;'>*** Wrong size or color for ".$picture_name." of creation ".strtoupper($creation->name).", could not be imported. Color is ".$picture_main_color." and size is ".$picture_size."</span><br/>";
                            $failure_number ++;
                        }

                        // if (Color::where('name', $picture_main_color)->count() == 0) {
                        //     if (!in_array($picture_main_color, $missing_colors)) {
                        //         array_push($missing_colors, $picture_main_color);
                        //         echo "Couleur manquante : ".$picture_main_color."<br/>";
                        //     }
                        // }

                        if (Size::where('value', $picture_size)->count() == 0) {
                            if ($picture_size == '0') {
                                echo "Missing size for file ".$picture_name."<br/>";
                                $missing_sizes_number ++;
                            }
                            // if (!in_array($picture_size, $missing_sizes) && $picture_size != '0') {
                            //     array_push($missing_sizes, $picture_size);
                            //     echo "Missing size: ".$picture_size."<br/>";
                            // }
                        }
                    } else {
                        echo "<span style='color: red;'>*** Wrong file name format for picture ".$picture_name." of creation ".strtoupper($creation->name).".  File size is ".count($picture_info).".</span><br/>";
                        // echo "<span style='color: red;'>".$picture_name." of creation ".strtoupper($creation->name)."</span><br/>";
                        $failure_number ++;
                    }
                    // echo "<br/>".$picture_name."<br/>";
                    // echo $picture->getPath()."<br/>";
                    $pic_count ++;
                }
            }
        }


        // Replacement elements handling
        $replacements = [
            'JENTINKI' => 'BOBOCA',
        ];

        $replacements_prices = [
            'JENTINKI' => 50,
        ];

        foreach ($replacements as $replacement => $creation) {
            $article_counter = 1;
            $article_pic_count = 0;
            
            $replacement_creation_id = 0;
            if (Creation::where('name', strtoupper($creation))->count() > 0) {
                $replacement_creation_id = Creation::where('name', strtoupper($creation))->first()->id;
            }
            if (File::exists(public_path('images/pictures/articles/to_be_processed/'.strtoupper($replacement)))) {
            // Check if folder with model name exists
                $all_replacement_pictures = File::allFiles(public_path('images/pictures/articles/to_be_processed/'.strtoupper($replacement)));
                foreach ($all_replacement_pictures as $replacement_picture) {
                    $picture_info = explode(" ", trim($replacement_picture->getFilename()));
                    $color_options = [
                        'beige', 'wool', 'caramel', 'black', 'back', 'dark', 'babyblue', 'blue', 'cyan', 'darkblue', 'fadedblue',  'lightblue', 'ligthblue', 'marineblue', 'navy', 'navyblue', 'skyblue', 'stoneblue', 'turquoise', 'blueish', 'thin', 'thinblue', 'camo', 'royal', 'teal', 'bronze', 'Brown', 'brown', 'brownish', 'darkbrown', 'maroon', 'marron', 'chestnut', 'lightbrown', 'Denim', 'jeans', 'jean', 'darkgreen', 'green', 'greenish', 'khaki', 'militarygreen', 'mint', 'neongreen', 'olive', 'lightgreen', 'kaki', 'sacramento', 'moss', 'darkgrey', 'rey', 'grey', 'greyish', 'jeangrey', 'lightgrey', 'floral', 'flowers', 'Mosaique', 'colorful', 'various', 'multicolor', 'motive', 'pink', 'rose', 'baby', 'salmon', 'lightrose', 'deep_mauve', 'eggplant', 'lightpurple', 'mauve', 'purple', 'lavender', 'bordeau', 'bordeaux', 'burgundy', 'darkred', 'red', 'firered', 'velvet', 'cream', 'creamwhite', 'white', 'whtie', 'creamy', 'golden', 'lightyellow', 'mustard', 'neonyellow', 'yellow', 'trombone', 'orange', 'deep', 'old',
                    ];

                    if (in_array(explode("_", $picture_info[2])[0], $color_options)) {
                        $color_index = 2;
                    } else {
                        $color_index = 1;
                    }

                    if (count($picture_info) == 10) {
                        // $color_index = 2;
                        $size_index = 9;
                    }
                    elseif(count($picture_info) == 9) {
                        // $color_index = 2;
                        $size_index = 8;
                    } else {
                        // $color_index = 2;
                        $size_index = 100; //Not used
                    }

                    if(count($picture_info) >= 8 && count($picture_info) <= 10) {
                        // Get first three colors from picture file name
                        $picture_colors = $picture_info[$color_index];
                        $picture_main_color = explode("_", $picture_colors)[0];
                        if (isset(explode("_", $picture_colors)[1])) {
                            $picture_secondary_color = explode("_", $picture_colors)[1];
                        } else {
                            $picture_secondary_color = null;
                        }
                        if (isset(explode("_", $picture_colors)[2])) {
                            $picture_third_color = explode("_", $picture_colors)[2];
                        } else {
                            $picture_third_color = null;
                        }

                        // Convert color to one of the existing colors based on Excel file equivalence
                        if (in_array($picture_main_color, ['beige', 'wool', 'caramel'])) {
                            $picture_main_color  = 'beige';
                        } elseif (in_array($picture_main_color, ['black', 'back', 'dark'])) {
                            $picture_main_color  = 'black';
                        } elseif (in_array($picture_main_color, ['babyblue', 'blue', 'cyan', 'darkblue', 'fadedblue',  'lightblue', 'ligthblue', 'marineblue', 'navy', 'navyblue', 'skyblue', 'stoneblue', 'turquoise', 'blueish', 'thin', 'thinblue', 'camo', 'royal', 'teal'])) {
                            $picture_main_color  = 'blue';
                        } elseif (in_array($picture_main_color, ['bronze', 'Brown', 'brown', 'brownish', 'darkbrown', 'maroon', 'marron', 'chestnut', 'lightbrown'])) {
                            $picture_main_color  = 'brown';
                        } elseif (in_array($picture_main_color, ['Denim', 'jeans', 'jean'])) {
                            $picture_main_color  = 'Denim';
                        } elseif (in_array($picture_main_color, ['darkgreen', 'green', 'greenish', 'khaki', 'militarygreen', 'mint', 'neongreen', 'olive', 'lightgreen', 'kaki', 'sacramento', 'moss'])) {
                            $picture_main_color  = 'green';
                        } elseif (in_array($picture_main_color, ['darkgrey', 'rey', 'grey', 'greyish', 'jeangrey', 'lightgrey'])) {
                            $picture_main_color  = 'grey';
                        } elseif (in_array($picture_main_color, ['floral', 'flowers', 'Mosaique', 'colorful', 'various', 'multicolor', 'motive'])) {
                            $picture_main_color  = 'multicolored';
                        } elseif (in_array($picture_main_color, ['pink', 'rose', 'baby', 'salmon', 'lightrose'])) {
                            $picture_main_color  = 'pink';
                        } elseif (in_array($picture_main_color, ['deep_mauve', 'eggplant', 'lightpurple', 'mauve', 'purple', 'lavender', 'deep', 'old'])) {
                            $picture_main_color  = 'purple';
                        } elseif (in_array($picture_main_color, ['bordeau', 'bordeaux', 'burgundy', 'darkred', 'red', 'firered', 'velvet'])) {
                            $picture_main_color  = 'red';
                        } elseif (in_array($picture_main_color, ['cream', 'creamwhite', 'white', 'whtie', 'creamy'])) {
                            $picture_main_color  = 'white';
                        } elseif (in_array($picture_main_color, ['golden', 'lightyellow', 'mustard', 'neonyellow', 'yellow', 'trombone'])) {
                            $picture_main_color  = 'yellow';
                        } elseif (in_array($picture_main_color, ['orange'])) {
                            $picture_main_color  = 'orange';
                        }

                        if (isset($picture_info[$size_index]) && in_array($picture_info[$size_index], ['Unique', 'unique', 'unique(1)'])) {
                            $picture_size = "unique";
                        } elseif (count($picture_info) >= 9 && isset($picture_info[$size_index])) {
                            if (explode(".", $picture_info[$size_index])[0] == 'All') {
                                $picture_size = "unique";
                            } else {
                                $picture_size = explode(".", $picture_info[$size_index])[0];
                            }
                        } else {
                            $picture_size = "unique";
                        }
                        
                        if ($picture_size  == 'M(1)') {
                            $picture_size = 'M';
                        }
                        if ($picture_size  == '2XL') {
                            $picture_size = 'XXL';
                        }
                        if ($picture_size  == 'XL(1)') {
                            $picture_size = 'XL';
                        }
                        
                        if (Color::where('name', $picture_main_color)->count() > 0 && Size::where('value', $picture_size)->count() > 0) {
                            $color_id  = Color::where('name', $picture_main_color)->first()->id;
                            $size_id = Size::where('value', $picture_size)->first()->id;

                            if (Article::where('creation_id', $replacement_creation_id)
                                         ->where('color_id', $color_id)
                                         ->where('secondary_color', $picture_secondary_color)
                                         ->where('third_color', $picture_third_color)
                                         ->where('size_id', $size_id)
                                         ->where('is_extra_accessory', '1')
                                         ->count() == 0) {

                                $article_pic_count = 0;

                                $new_replacement = new Article();
                                $new_replacement->name = ucfirst(strtolower($replacement)).'-'.str_pad($article_counter, 3, '0', STR_PAD_LEFT);
                                //$new_article->type  = "article";
                                $new_replacement->creation_id = $replacement_creation_id;
                                $new_replacement->is_extra_accessory = 1;

                                $new_replacement->size_id = $size_id;
                                $new_replacement->color_id = $color_id;
                                $new_replacement->secondary_color = $picture_secondary_color;
                                $new_replacement->third_color = $picture_third_color;
                                $new_replacement->singularity_lu = "";
                                $new_replacement->singularity_fr = "";
                                $new_replacement->singularity_en = "";
                                $new_replacement->singularity_de = "";
                                $new_replacement->translation_key = "article.singularity-".strtolower($new_replacement->name);
                                $new_replacement->creation_date = $picture_info[6];

                                $new_replacement->checked = 1;

                                $new_replacement->specific_price = $replacements_prices[$replacement];

                                if ($new_replacement->save()) {
                                    $article_counter ++;
                                    echo "<span style='color: green; padding-top: 5px;'>New replacement ".$new_replacement->name." created for model ".strtoupper($creation).", with color ".$picture_main_color.", secondary color ". $picture_secondary_color ." and size ".$picture_size.", from file ".$replacement_picture->getFilename()."</span><br/>";
                                }
                            }

                            if(Article::where('creation_id', $replacement_creation_id)
                                         ->where('color_id', $color_id)
                                         ->where('secondary_color', $picture_secondary_color)
                                         ->where('third_color', $picture_third_color)
                                         ->where('size_id', $size_id)
                                         ->where('is_extra_accessory', '1')
                                         ->count() == 1) {

                                $new_replacement = Article::where('creation_id', $replacement_creation_id)
                                         ->where('color_id', $color_id)
                                         ->where('secondary_color', $picture_secondary_color)
                                         ->where('third_color', $picture_third_color)
                                         ->where('size_id', $size_id)
                                         ->where('is_extra_accessory', '1')
                                         ->first();

                                $article_pic_count ++;

                                $new_photo = new Photo();
                                $new_photo_rand_id = rand(100, 999);
                                $new_photo->file_name = 'processed/'.strtoupper($creation).'/'.$new_replacement->name.'-'.$new_photo_rand_id.''.$article_pic_count.'.png';
                                $new_photo->use_for_model = 1;
                                if (strpos($replacement_picture->getFilename(), " front ") !== false) {
                                    $new_photo->is_front = '1';
                                }
                                $new_photo->title = $creation." by BENU COUTURE - Article ".$article_counter;
                                $new_photo->author = "BENU Village Esch Asbl";

                                $img = Image::make($replacement_picture);
                                $img_saved = $this->savePhotoWithWatermark($img, $creation, $new_replacement->name, $article_pic_count, $new_photo_rand_id);

                                if ($new_photo->save() && $img_saved) {

                                    $success_number ++;
                                    echo "<span style='color: green; padding-left: 10px;'>New picture added for article ".$new_replacement->name." of model ".strtoupper($creation).", from file ".$replacement_picture->getFilename()."</span><br/>";

                                    $new_replacement->photos()->attach($new_photo->id);

                                    // Determine if article is sold or in stock. Only handles Benu Esch shop and Hamilius pop-up.
                                    if (strpos(strtolower($replacement_picture->getPath()), 'hamilius') !== false) {
                                        if (!($new_replacement->shops->contains(Shop::where('filter_key', 'pop-up-hamilius')->first()->id))) {
                                            $pop_up_id = Shop::where('filter_key', 'pop-up-hamilius')->first()->id;
                                            $new_replacement->shops()->attach($pop_up_id, ['stock' => '1']);
                                        }
                                    } else {
                                        if (!($new_replacement->shops->contains(Shop::where('filter_key', 'benu-esch')->first()->id))) {
                                            $new_replacement->shops()->attach(1, ['stock' => '1']);
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "<span style='color: red;'>*** Wrong size or color for ".$replacement_picture->getFilename()." of creation ".strtoupper($creation).", could not be imported. Color is ".$picture_main_color." and size is ".$picture_size."</span><br/>";
                            $failure_number ++;
                        }
                    } else {
                        echo "<span style='color: red;'>*** Wrong file name format for picture ".$replacement_picture->getFilename()." of creation ".strtoupper($creation)."</span><br/>";
                        $failure_number ++;
                    }
                    $pic_count ++;
                }
            }
        }


        $success_rate = round(($success_number / $pic_count) * 100);
        echo "Nombre de photos non vendues avec la taille 0 : ".$missing_sizes_number."<br/>";
        echo "Taux de réussite : ".$success_rate."%";
    }

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


    public function updateArticlesFromLouAndSophie()
    {
        echo "<br/><br/><strong>----------------  Updating Creations and articles data from Lou's and Sophie's file...</strong><br/>";
        // Import of article and creation details from Lou's and Sophie's files
        $articles_updated_from_lou = [];
        $articles_updated_from_sophie = [];
        $keywords_created = [];

        $creations_lou = json_decode(file_get_contents(asset('json_imports/creations_lou.json')), true);
        $articles_sophie = json_decode(file_get_contents(asset('json_imports/articles.json')), true);

        if (env('APP_ENV') != 'production') {
            // WARNING: will empty the table!! To be used with caution.
            DB::table('article_care_recommendation')->truncate();
            DB::table('article_composition')->truncate();
            DB::table('creation_keyword')->truncate();
            Keyword::truncate();
            echo "<strong>--- All data deleted from ArticleCareRecommendation, ArticleComposition, CreationKeyword, Keyword tables in database ---</strong><br/>";
        }

        echo "<br/><br/><strong>----------------  Updating Creations and articles data from Lou's file...</strong><br/>";

        // Determination of composition ids for attaching
        $compo_silk_id = Composition::where('fabric_fr', 'Soie')->first()->id;
        $compo_silk_crepe_id = Composition::where('fabric_fr', 'Crêpe de soie')->first()->id;
        $compo_cotton_id = Composition::where('fabric_fr', 'Coton')->first()->id;
        // $compo_cotton_crepe_id = Composition::where('fabric_fr', 'Crêpe de coton')->first()->id;
        $compo_jersey_id = Composition::where('fabric_fr', 'Jersey de coton')->first()->id;
        $compo_wool_id = Composition::where('fabric_fr', 'Laine')->first()->id;
        $compo_tissed_wool_id = Composition::where('fabric_fr', 'Laine tissée')->first()->id;
        $compo_viscose_id = Composition::where('fabric_fr', 'Viscose')->first()->id;
        $compo_synthetic_id = Composition::where('fabric_fr', 'Fibres synthétiques')->first()->id;
        $compo_poly_crepe_id = Composition::where('fabric_fr', 'Crêpe de Polyester')->first()->id;
        $compo_elasthane_id = Composition::where('fabric_fr', 'Élasthanne')->first()->id;
        $compo_linen_id = Composition::where('fabric_fr', 'Lin')->first()->id;
        $compo_nylon_id = Composition::where('fabric_fr', 'Nylon')->first()->id;
        $compo_velvet_id = Composition::where('fabric_fr', 'Velours côtelé de coton')->first()->id;
        $compo_smooth_velvet_id = Composition::where('fabric_fr', 'Velours lisse de coton')->first()->id;
        $compo_denim_id = Composition::where('fabric_fr', 'Denim')->first()->id;
        $compo_acrylic_id = Composition::where('fabric_fr', 'Acrylique')->first()->id;
        $compo_leather_id = Composition::where('fabric_fr', 'Cuir')->first()->id;

        // Determination of care recommendation ids for attaching
        // $care_no_washing_id = CareRecommendation::where('name', 'no_washing')->first()->id;
        $care_wool_id = CareRecommendation::where('name', 'cold_wash')->first()->id;
        $care_30deg_id = CareRecommendation::where('name', 'wash_30C')->first()->id;
        $care_40deg_id = CareRecommendation::where('name', 'wash_40C')->first()->id;
        $care_60deg_id = CareRecommendation::where('name', 'wash_60C')->first()->id;
        $care_delicate_id = CareRecommendation::where('name', 'delicate_wash')->first()->id;
        // $care_hand_id = CareRecommendation::where('name', 'hand_wash')->first()->id;
        $care_no_spinning_id = CareRecommendation::where('name', 'avoid_spinning')->first()->id;
        $care_no_drying_id = CareRecommendation::where('name', 'not_tumble_dry')->first()->id;
        $care_low_drying_id = CareRecommendation::where('name', 'dry_low_temp')->first()->id;
        $care_medium_drying_id = CareRecommendation::where('name', 'dry_medium_temp')->first()->id;
        $care_flat_drying_id = CareRecommendation::where('name', 'dry_flat')->first()->id;
        $care_no_iron_id = CareRecommendation::where('name', 'not_iron')->first()->id;
        $care_low_iron_id = CareRecommendation::where('name', 'iron_low_temp')->first()->id;
        $care_medium_iron_id = CareRecommendation::where('name', 'iron_medium_temp')->first()->id;
        $care_high_iron_id = CareRecommendation::where('name', 'iron_high_temp')->first()->id;


        foreach ($creations_lou as $creation_lou) {
            if (Article::query()
                ->where('is_extra_accessory', '1')
                ->where('name', 'LIKE', '%'.ucfirst(strtolower($creation_lou['name'])).'%')
                ->count() > 0) {

                $extra_accessory_articles = Article::query()
                ->where('is_extra_accessory', '1')
                ->where('name', 'LIKE', '%'.ucfirst(strtolower($creation_lou['name'])).'%')
                ->get();

                foreach ($extra_accessory_articles as $article) {
                    if ($creation_lou['Soie'] == "x") {
                        $article->compositions()->attach($compo_silk_id);
                    }
                    if ($creation_lou['Crêpe de soie'] == "x") {
                        $article->compositions()->attach($compo_silk_crepe_id);
                    }
                    if ($creation_lou['Coton'] == "x") {
                        $article->compositions()->attach($compo_cotton_id);
                    }
                    // if ($creation_lou['Crêpe de coton'] == "x") {
                    //     $article->compositions()->attach($compo_cotton_crepe_id);
                    // }
                    if ($creation_lou['Jersey de coton'] == "x") {
                        $article->compositions()->attach($compo_jersey_id);
                    }
                    if ($creation_lou['Laine'] == "x") {
                        $article->compositions()->attach($compo_wool_id);
                    }
                    if ($creation_lou['Laine tissée'] == "x") {
                        $article->compositions()->attach($compo_tissed_wool_id);
                    }
                    if ($creation_lou['Viscose'] == "x") {
                        $article->compositions()->attach($compo_viscose_id);
                    }
                    if ($creation_lou['Fibres synthétiques'] == "x") {
                        $article->compositions()->attach($compo_synthetic_id);
                    }
                    if ($creation_lou['Polyester'] == "x") {
                        $article->compositions()->attach($compo_poly_crepe_id);
                    }
                    if ($creation_lou['Élasthanne'] == "x") {
                        $article->compositions()->attach($compo_elasthane_id);
                    }
                    if ($creation_lou['Lin'] == "x") {
                        $article->compositions()->attach($compo_linen_id);
                    }
                    if ($creation_lou['Nylon'] == "x") {
                        $article->compositions()->attach($compo_nylon_id);
                    }
                    if ($creation_lou['Velours de coton côtelé'] == "x") {
                        $article->compositions()->attach($compo_velvet_id);
                    }
                    if ($creation_lou['Velours de coton lisse'] == "x") {
                        $article->compositions()->attach($compo_smooth_velvet_id);
                    }
                    if ($creation_lou['Denim'] == "x") {
                        $article->compositions()->attach($compo_denim_id);
                    }
                    if ($creation_lou['Acrylique'] == "x") {
                        $article->compositions()->attach($compo_acrylic_id);
                    }
                    if ($creation_lou['Cuir'] == "x") {
                        $article->compositions()->attach($compo_leather_id);
                    }

                    echo "<span style='color: green;'>Composition updated for article ".$article->name."</span><br/>";

                    // if ($creation_lou['Pas de lavage recommandé'] == "x") {
                    //     $article->care_recommendations()->attach($care_no_washing_id);
                    // }
                    if ($creation_lou['Cold wash (wool program) or hand wash'] == "x") {
                        $article->care_recommendations()->attach($care_wool_id);
                    }
                    if ($creation_lou['30°C max'] == "x") {
                        $article->care_recommendations()->attach($care_30deg_id);
                    }
                    if ($creation_lou['40°C max'] == "x") {
                        $article->care_recommendations()->attach($care_40deg_id);
                    }
                    if ($creation_lou['60°C max'] == "x") {
                        $article->care_recommendations()->attach($care_60deg_id);
                    }
                    if ($creation_lou['Lavage délicat (option supplémentaire)'] == "x") {
                        $article->care_recommendations()->attach($care_delicate_id);
                    }
                    if ($creation_lou['Eviter essorage (option supplémentaire)'] == "x") {
                        $article->care_recommendations()->attach($care_no_spinning_id);
                    }
                    if ($creation_lou['Pas de séchoir'] == "x") {
                        $article->care_recommendations()->attach($care_no_drying_id);
                    }
                    if ($creation_lou['Séchage modéré'] == "x") {
                        $article->care_recommendations()->attach($care_low_drying_id);
                    }
                    if ($creation_lou['Séchage normal'] == "x") {
                        $article->care_recommendations()->attach($care_medium_drying_id);
                    }
                    if ($creation_lou['Séchage manuel à l\'horizontale (ex. pullover)'] == "x") {
                        $article->care_recommendations()->attach($care_flat_drying_id);
                    }
                    if ($creation_lou['Ne pas repasser'] == "x") {
                        $article->care_recommendations()->attach($care_no_iron_id);
                    }
                    if ($creation_lou['Repassage à basse température'] == "x") {
                        $article->care_recommendations()->attach($care_low_iron_id);
                    }
                    if ($creation_lou['Repassage à température moyenne'] == "x") {
                        $article->care_recommendations()->attach($care_medium_iron_id);
                    }
                    if ($creation_lou['Repassage à haute température'] == "x") {
                        $article->care_recommendations()->attach($care_high_iron_id);
                    }

                    echo "<span style='color: green;'>Care Recommendations updated for article ".$article->name."</span><br/>";
                }

            } elseif (Creation::where('name', $creation_lou['name'])->count() > 0) {
                $creation = Creation::where('name', $creation_lou['name'])->first();

                foreach ($creation->articles as $article) {
                    if ($creation_lou['Soie'] == "x") {
                        $article->compositions()->attach($compo_silk_id);
                    }
                    if ($creation_lou['Crêpe de soie'] == "x") {
                        $article->compositions()->attach($compo_silk_crepe_id);
                    }
                    if ($creation_lou['Coton'] == "x") {
                        $article->compositions()->attach($compo_cotton_id);
                    }
                    // if ($creation_lou['Crêpe de coton'] == "x") {
                    //     $article->compositions()->attach($compo_cotton_crepe_id);
                    // }
                    if ($creation_lou['Jersey de coton'] == "x") {
                        $article->compositions()->attach($compo_jersey_id);
                    }
                    if ($creation_lou['Laine'] == "x") {
                        $article->compositions()->attach($compo_wool_id);
                    }
                    if ($creation_lou['Laine tissée'] == "x") {
                        $article->compositions()->attach($compo_tissed_wool_id);
                    }
                    if ($creation_lou['Viscose'] == "x") {
                        $article->compositions()->attach($compo_viscose_id);
                    }
                    if ($creation_lou['Fibres synthétiques'] == "x") {
                        $article->compositions()->attach($compo_synthetic_id);
                    }
                    if ($creation_lou['Polyester'] == "x") {
                        $article->compositions()->attach($compo_poly_crepe_id);
                    }
                    if ($creation_lou['Élasthanne'] == "x") {
                        $article->compositions()->attach($compo_elasthane_id);
                    }
                    if ($creation_lou['Lin'] == "x") {
                        $article->compositions()->attach($compo_linen_id);
                    }
                    if ($creation_lou['Nylon'] == "x") {
                        $article->compositions()->attach($compo_nylon_id);
                    }
                    if ($creation_lou['Velours de coton côtelé'] == "x") {
                        $article->compositions()->attach($compo_velvet_id);
                    }
                    if ($creation_lou['Velours de coton lisse'] == "x") {
                        $article->compositions()->attach($compo_smooth_velvet_id);
                    }
                    if ($creation_lou['Denim'] == "x") {
                        $article->compositions()->attach($compo_denim_id);
                    }
                    if ($creation_lou['Acrylique'] == "x") {
                        $article->compositions()->attach($compo_acrylic_id);
                    }
                    if ($creation_lou['Cuir'] == "x") {
                        $article->compositions()->attach($compo_leather_id);
                    }

                    echo "<span style='color: green;'>Composition updated for article ".$article->name."</span><br/>";

                    // if ($creation_lou['Pas de lavage recommandé'] == "x") {
                    //     $article->care_recommendations()->attach($care_no_washing_id);
                    // }
                    if ($creation_lou['Cold wash (wool program) or hand wash'] == "x") {
                        $article->care_recommendations()->attach($care_wool_id);
                    }
                    if ($creation_lou['30°C max'] == "x") {
                        $article->care_recommendations()->attach($care_30deg_id);
                    }
                    if ($creation_lou['40°C max'] == "x") {
                        $article->care_recommendations()->attach($care_40deg_id);
                    }
                    if ($creation_lou['60°C max'] == "x") {
                        $article->care_recommendations()->attach($care_60deg_id);
                    }
                    if ($creation_lou['Lavage délicat (option supplémentaire)'] == "x") {
                        $article->care_recommendations()->attach($care_delicate_id);
                    }
                    if ($creation_lou['Eviter essorage (option supplémentaire)'] == "x") {
                        $article->care_recommendations()->attach($care_no_spinning_id);
                    }
                    if ($creation_lou['Pas de séchoir'] == "x") {
                        $article->care_recommendations()->attach($care_no_drying_id);
                    }
                    if ($creation_lou['Séchage modéré'] == "x") {
                        $article->care_recommendations()->attach($care_low_drying_id);
                    }
                    if ($creation_lou['Séchage normal'] == "x") {
                        $article->care_recommendations()->attach($care_medium_drying_id);
                    }
                    if ($creation_lou['Séchage manuel à l\'horizontale (ex. pullover)'] == "x") {
                        $article->care_recommendations()->attach($care_flat_drying_id);
                    }
                    if ($creation_lou['Ne pas repasser'] == "x") {
                        $article->care_recommendations()->attach($care_no_iron_id);
                    }
                    if ($creation_lou['Repassage à basse température'] == "x") {
                        $article->care_recommendations()->attach($care_low_iron_id);
                    }
                    if ($creation_lou['Repassage à température moyenne'] == "x") {
                        $article->care_recommendations()->attach($care_medium_iron_id);
                    }
                    if ($creation_lou['Repassage à haute température'] == "x") {
                        $article->care_recommendations()->attach($care_high_iron_id);
                    }

                    echo "<span style='color: green;'>Care Recommendations updated for article ".$article->name."</span><br/>";

                    // Size category update
                    $article->size_category = $creation_lou['Enveloppe'];
                }

                // Keywords handling
                if ($creation_lou['Détails (Mots clés) FR'] != "") {
                    $keywords_fr = explode(";", $creation_lou['Détails (Mots clés) FR']);
                    $keywords_lu = explode(";", $creation_lou['Détails (Mots clés) LU']);
                    $keywords_de = explode(";", $creation_lou['Détails (Mots clés) DE']);
                    $keywords_en = explode(";", $creation_lou['Détails (Mots clés) EN']);

                    foreach ($keywords_fr as $index => $keyword_fr) {
                        if (Keyword::where('keyword_fr', $keyword_fr)->count() == 0) {
                            $new_keyword = new Keyword();
                            $new_keyword->keyword_fr = $keyword_fr;
                            if (isset($keywords_lu[$index])) {
                                $new_keyword->keyword_lu = $keywords_lu[$index];
                            } else {
                                $new_keyword->keyword_lu = "";
                            }
                            if (isset($keywords_de[$index])) {
                                $new_keyword->keyword_de = $keywords_de[$index];
                            } else {
                                $new_keyword->keyword_de = "";
                            }
                            if (isset($keywords_en[$index])) {
                                $new_keyword->keyword_en = $keywords_en[$index];
                            } else {
                                $new_keyword->keyword_en = "";
                            }
                            $new_keyword->save();
                            echo "<span style='color: green;'>New keyword ".$keyword_fr." has been created</span><br/>";
                        } else {
                            $new_keyword = Keyword::where('keyword_fr', $keywords_fr)->first();
                        }
                        if (!($creation->keywords->contains($new_keyword->id))) {
                            $creation->keywords()->attach($new_keyword->id);
                            echo "<span style='color: green; padding-left: 10px;'>Keyword ".$keyword_fr." has been attached to creation ".$creation->name."</span><br/>";
                        }
                    }
                }
            }
        }

        echo "<br/><br/><strong>----------------  Updating Creations and articles data from Sophie's file...</strong><br/>";

        foreach ($articles_sophie as $article_sophie) {
            if ($article_sophie['name'] != "" && Article::where('name', $article_sophie['name'])->count() > 0) {
                $article = Article::where('name', $article_sophie['name'])->first();

                $article->care_recommendations()->detach();
                $article->compositions()->detach();

                // Singularities update
                if ($article_sophie['singularity_fr'] != "") {
                    $article->singularity_fr = $article_sophie['singularity_fr'];
                } else {
                    $article->singularity_fr = "";
                }
                if ($article_sophie['singularity_lu'] != "") {
                    $article->singularity_lu = $article_sophie['singularity_lu'];
                } else {
                    $article->singularity_lu = "";
                }
                if ($article_sophie['singularity_en'] != "") {
                    $article->singularity_en = $article_sophie['singularity_en'];
                } else {
                    $article->singularity_en = "";
                }
                if ($article_sophie['singularity_de'] != "") {
                    $article->singularity_de = $article_sophie['singularity_de'];
                } else {
                    $article->singularity_de = "";
                }
                if ($article->save()) {
                    echo "<span style='color: green; padding-left: 10px;'>Singularities updated for article ".$article->name."</span><br/>";
                }

                // Care recommendations update
                // if ($article_sophie['no_washing'] == "VRAI") {
                //     $article->care_recommendations()->attach($care_no_washing_id);
                // }
                if ($article_sophie['cold_wash'] == "VRAI") {
                    $article->care_recommendations()->attach($care_wool_id);
                }
                if ($article_sophie['wash_30C'] == "VRAI") {
                    $article->care_recommendations()->attach($care_30deg_id);
                }
                if ($article_sophie['wash_40C'] == "VRAI") {
                    $article->care_recommendations()->attach($care_40deg_id);
                }
                if ($article_sophie['wash_60C'] == "VRAI") {
                    $article->care_recommendations()->attach($care_60deg_id);
                }
                if ($article_sophie['delicate_wash'] == "VRAI") {
                    $article->care_recommendations()->attach($care_delicate_id);
                }
                // if ($article_sophie['hand_wash'] == "VRAI") {
                //     $article->care_recommendations()->attach($care_hand_id);
                // }
                if ($article_sophie['avoid_spinning'] == "VRAI") {
                    $article->care_recommendations()->attach($care_no_spinning_id);
                }
                if ($article_sophie['not_tumble_dry'] == "VRAI") {
                    $article->care_recommendations()->attach($care_no_drying_id);
                }
                if ($article_sophie['dry_low_temp'] == "VRAI") {
                    $article->care_recommendations()->attach($care_low_drying_id);
                }
                if ($article_sophie['dry_medium_temp'] == "VRAI") {
                    $article->care_recommendations()->attach($care_medium_drying_id);
                }
                if ($article_sophie['dry_flat'] == "VRAI") {
                    $article->care_recommendations()->attach($care_flat_drying_id);
                }
                if ($article_sophie['not_iron'] == "VRAI") {
                    $article->care_recommendations()->attach($care_no_iron_id);
                }
                if ($article_sophie['iron_low_temp'] == "VRAI") {
                    $article->care_recommendations()->attach($care_low_iron_id);
                }
                if ($article_sophie['iron_medium_temp'] == "VRAI") {
                    $article->care_recommendations()->attach($care_medium_iron_id);
                }
                if ($article_sophie['iron_high_temp'] == "VRAI") {
                    $article->care_recommendations()->attach($care_high_iron_id);
                }
                echo "<span style='color: green; padding-left: 10px;'>Care recommendations updated for article ".$article->name."</span><br/>";

                // Composition update
                if ($article_sophie['silk'] == "VRAI") {
                    $article->compositions()->attach($compo_silk_id);
                }
                if ($article_sophie['silk_crepe'] == "VRAI") {
                    $article->compositions()->attach($compo_silk_crepe_id);
                }
                if ($article_sophie['cotton'] == "VRAI") {
                    $article->compositions()->attach($compo_cotton_id);
                }
                // if ($article_sophie['cotton_crepe'] == "VRAI") {
                //     $article->compositions()->attach($compo_cotton_crepe_id);
                // }
                if ($article_sophie['jersey'] == "VRAI") {
                    $article->compositions()->attach($compo_jersey_id);
                }
                if ($article_sophie['wool'] == "VRAI") {
                    $article->compositions()->attach($compo_wool_id);
                }
                if ($article_sophie['woven_wool'] == "VRAI") {
                    $article->compositions()->attach($compo_tissed_wool_id);
                }
                if ($article_sophie['viscose'] == "VRAI") {
                    $article->compositions()->attach($compo_viscose_id);
                }
                if ($article_sophie['synt_fibers'] == "VRAI") {
                    $article->compositions()->attach($compo_synthetic_id);
                }
                if ($article_sophie['poly_crepe'] == "VRAI") {
                    $article->compositions()->attach($compo_poly_crepe_id);
                }
                if ($article_sophie['elastane'] == "VRAI") {
                    $article->compositions()->attach($compo_elasthane_id);
                }
                if ($article_sophie['linen'] == "VRAI") {
                    $article->compositions()->attach($compo_linen_id);
                }
                if ($article_sophie['nylon'] == "VRAI") {
                    $article->compositions()->attach($compo_nylon_id);
                }
                if ($article_sophie['corduroy'] == "VRAI") {
                    $article->compositions()->attach($compo_velvet_id);
                }
                if ($article_sophie['velvet'] == "VRAI") {
                    $article->compositions()->attach($compo_smooth_velvet_id);
                }
                if ($article_sophie['denim'] == "VRAI") {
                    $article->compositions()->attach($compo_denim_id);
                }
                if ($article_sophie['acrylic'] == "VRAI") {
                    $article->compositions()->attach($compo_acrylic_id);
                }
                echo "<span style='color: green; padding-left: 10px;'>Compositions updated for article ".$article->name."</span><br/>";
            }
        }
    }
}