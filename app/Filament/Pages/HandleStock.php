<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\FileUpload;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

use App\Models\Article;
use App\Models\CareRecommendation;
use App\Models\Color;
use App\Models\Composition;
use App\Models\Creation;
use App\Models\Photo;
use App\Models\Shop;
use App\Models\Size;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;

use App\Traits\ArticleAnalyzer;
use App\Traits\VariationPhotoHandler;

class HandleStock extends Page
{
    use ArticleAnalyzer;
    use VariationPhotoHandler;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static string $view = 'filament.pages.handle-stock';

    protected static ?string $title = 'Variations Review';
 
    protected static ?string $navigationLabel = 'Variations review';
     
    protected static ?string $slug = 'variation-reviews';

    protected static ?string $navigationGroup = 'Creations & Variations';

    protected static ?int $navigationSort = 3;

    protected static function shouldRegisterNavigation(): bool
    {
        return (auth()->user()->role == 'admin');
    }

    public $all_creations;
    public $all_shops;
    public $computed_variations;
    public $selected_variation;
    public $photos = [];
    public $front_pictures = [];
    public $creation_id;
    public $article_id;
    public $color;
    public $size;
    public $name;
    public $all_sizes = [];
    public $all_colors = [];
    public $all_compos = [];
    public $all_cares = [];
    public $size_id;
    public $color_id;
    public $delivery_size;
    public $compo_ids = [];
    public $care_ids = [];
    public $singularity_fr = [];
    public $singularity_de = [];
    public $singularity_en = [];
    public $singularity_lu = [];

    public function mount()
    {
        $this->loadStaticData();
        $this->computed_variations = collect([]);
        $this->selected_variation = null;
        $this->stock_by_shop = [];
        $this->creation_name = 'none-0';
        $this->variation_name = 'none-0';
        $this->max_items = 1;
        foreach (Size::select('id', 'value')->get() as $size) {
            $this->all_sizes[$size->id] = $size->value;
        }
        foreach (Color::select('id', 'name')->get() as $color) {
            $this->all_colors[$color->id] = $color->name;
        }
        foreach (Composition::select('id', 'fabric_en')->get() as $composition) {
            $this->all_compos[$composition->id] = $composition->fabric_en;
        }
        foreach (CareRecommendation::select('id', 'description_en')->get() as $care) {
            $this->all_cares[$care->id] = $care->description_en;
        }
    }

    public function loadStaticData()
    {
        $this->all_creations = Creation::all()->sortBy('name');
        $this->all_shops = Shop::all();
    }

    public function adaptVariations($creation_id)
    {
        $this->loadStaticData();
        if ($creation_id == '0') {
            $this->computed_variations = collect([]);
        } elseif (Creation::find($creation_id)) {
            $this->computed_variations = Creation::find($creation_id)->articles;
        }
    }

    public function loadVariationData()
    {
        if (Article::where('name', $this->variation_name)->count() > 0) {
            // Define chosen variation as object
            $this->selected_variation = Article::where('name', $this->variation_name)->first();

            // Fetch variation information
            $this->size_id = $this->selected_variation->size->id;
            $this->color_id = $this->selected_variation->color->id;
            $this->delivery_size = $this->selected_variation->size_category;
            foreach ($this->all_compos as $compo_id => $fabric) {
                if ($this->selected_variation->compositions->contains($compo_id)) {
                    $this->compo_ids[$compo_id] = true;
                } else {
                    $this->compo_ids[$compo_id] = false;
                }
            }

            foreach ($this->all_cares as $care_id => $desc) {
                if ($this->selected_variation->care_recommendations->contains($care_id)) {
                    $this->care_ids[$care_id] = true; 
                } else {
                    $this->care_ids[$care_id] = false;
                }
            }

            $this->singularity_de = $this->selected_variation->singularity_de;
            $this->singularity_lu = $this->selected_variation->singularity_lu;
            $this->singularity_en = $this->selected_variation->singularity_en;
            $this->singularity_fr = $this->selected_variation->singularity_fr;

            // Initialize front pictures status
            foreach ($this->selected_variation->photos()->get() as $photo) {
                $this->front_pictures[$photo->id] = $photo->is_front;
            }

            // Fetch stocks in each shop
            foreach ($this->all_shops as $shop) {
                $this->stock_by_shop[$shop->filter_key] = 0;
                if ($shop->articles()->where('name', $this->variation_name)->count() > 0) {
                    $this->stock_by_shop[$shop->filter_key] = $shop->articles()->where('name', $this->variation_name)->first()->pivot->stock;
                }
            }
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photos.*' => 'image|max:6144', // 6MB Max
        ]);
    }

    public function clearUploadPictures()
    {
        $this->photos = [];
    }

    public function loadPictures()
    {
        $saved_pictures_count = 0;
        $photo_counter = $this->selected_variation->photos()->count() + 1;
        foreach ($this->photos as $photo) {
            $random_counter = rand(100, 999);
            $img = Image::make($photo);
            $creation_name = $this->selected_variation->creation->name;
            $article_name = $this->selected_variation->name;
            if($this->savePhotoWithWatermark($img, $creation_name, $article_name, $photo_counter, $random_counter)) {
                $new_photo = new Photo();
                $new_photo->file_name = 'processed/'.$creation_name.'/'.$article_name.'-'.$random_counter.$photo_counter.'.png';
                $new_photo->use_for_model = 1;
                if (strpos($photo->getClientOriginalName(), 'front') !== false) {
                    $new_photo->is_front = 1;
                } else {
                    $new_photo->is_front = 0;
                }
                $new_photo->title = $creation_name.' by BENU COUTURE - Variation '.$article_name;
                $new_photo->author = "BENU Village Esch asbl";
                if ($new_photo->save()) {
                    $this->selected_variation->photos()->attach($new_photo->id);
                    $saved_pictures_count ++;
                    $photo_counter ++;
                }
            }
        }
        if ($saved_pictures_count == count($this->photos)) {
            $this->loadVariationData();
            $this->clearUploadPictures();
        } else {
            $this->notify('danger', 'An error occured, we could not save all the pictures... Please check all files are pictures and contact an administrator if the problem is still present.');
        }
    }

    public function deletePhoto($photo_id)
    {
        if (Photo::find($photo_id)) {
            $article = $this->selected_variation;
            $photo = Photo::find($photo_id);
            $article->photos()->detach($photo_id);
            File::delete(public_path('images/pictures/articles/'.$photo->file_name));
            $this->notify('success', 'Photo deleted!');
            $this->loadVariationData();
            $this->clearUploadPictures();
        }
    }

    public function saveVariation()
    {
        if ($this->selected_variation !== null) {

            // Update stock
            foreach ($this->stock_by_shop as $shop => $stock) {
                if (Article::where('name', $this->variation_name)->first()->shops()->where('shops.filter_key', $shop)->count() > 0) {
                    $pivot = Article::where('name', $this->variation_name)->first()->shops()->where('shops.filter_key', $shop)->first()->pivot;
                    $pivot->stock = $stock;
                    $pivot->save();
                } else {
                    $shop_id = Shop::where('filter_key', $shop)->first()->id;
                    $this->selected_variation->shops()->attach($shop_id, ['stock' => $stock]);
                }
            }

            // Update pictures
            foreach ($this->front_pictures as $picture_id => $is_front) {
                $updated_photo = Photo::find($picture_id);
                $updated_photo->is_front = $is_front;
                $updated_photo->save();
            }

            // Update Size
            $this->selected_variation->size_id = $this->size_id;

            // Update Color
            $this->selected_variation->color_id = $this->color_id;

            // Update Size Category
            $this->selected_variation->size_category = $this->delivery_size;

            // Update Composition
            $this->selected_variation->compositions()->detach();
            foreach ($this->compo_ids as $compo_id => $value) {
                if ($value) {
                    $this->selected_variation->compositions()->attach($compo_id);
                }
            }

            // Update Care Recommendations
            $this->selected_variation->care_recommendations()->detach();
            foreach ($this->care_ids as $care_id => $value) {
                if ($value) {
                    $this->selected_variation->care_recommendations()->attach($care_id);
                }
            }

            // Update Singularities
            if ($this->singularity_de !== null) {
                $this->selected_variation->singularity_de = $this->singularity_de;
            } else {
                $this->selected_variation->singularity_de = "";
            }
            if ($this->singularity_fr !== null) {
                $this->selected_variation->singularity_fr = $this->singularity_fr;
            } else {
                $this->selected_variation->singularity_fr = "";
            }
            if ($this->singularity_lu !== null) {
                $this->selected_variation->singularity_lu = $this->singularity_lu;
            } else {
                $this->selected_variation->singularity_lu = "";
            }
            if ($this->singularity_en !== null) {
                $this->selected_variation->singularity_en = $this->singularity_en;
            } else {
                $this->selected_variation->singularity_en = "";
            }
            
            if ($this->selected_variation->save()) {
                $this->notify('success', 'Data for variation '.$this->variation_name.' was correctly updated in the database :)');

                // Reset data
                $this->selected_variation = null;
                $this->creation_name = "none-0";
                $this->variation_name = "none-0";
            }
        } else {
            $this->notify('danger', 'An error occured, please check the content or contact the administrator.');
        }
    }
}
