<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Forms\Components\TextInput;
use Filament\Form\Components;
use Filament\Forms\Components\FileUpload;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

use App\Models\Article;
use App\Models\Color;
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

class PhotoImport extends Page
{
    use ArticleAnalyzer;
    use VariationPhotoHandler;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-photograph';

    protected static string $view = 'filament.pages.photo-import';

    protected static ?string $title = 'New variation - Import pictures';
 
    protected static ?string $navigationLabel = 'New variation - Photo import';
     
    protected static ?string $slug = 'importation-photo';

    protected static ?string $navigationGroup = 'Creations & Variations';

    protected static ?int $navigationSort = 3;

    public $all_creations;
    public $existing_variations;
    public $photos = [];
    public $creation_id;
    public $article_id;
    public $color;
    public $size;
    public $name;
    public $is_new_article;
    public $all_sizes;
    public $all_colors;
    public $all_shops;
    public $size_id;
    public $color_id;
    public $article_creation_date;
    public $shop_id;

    public function mount()
    {
        $this->all_creations = Creation::all()->sortBy('name');//$this->getAvailableCreations()->sortBy('name');
        $this->existing_variations = collect([]);
        $this->is_new_article = 1;
        $this->all_sizes = [];
        $this->all_colors = [];
        $this->all_shops = [];
        $this->article_creation_date = "01.01.2022";
        $this->article_id = 0;
    }

    public function adaptVariations()
    {
        // $this->clearItem();
        if ($this->creation_id == '0') {
            $this->existing_variations = collect([]);
        } elseif (Creation::find($this->creation_id)) {
            $this->existing_variations = $this->getAvailableArticles(Creation::find($this->creation_id));
        }
        $this->getSizeandColor();
    }

    public function getSizeandColor()
    {
        if ($this->article_id == 0) {
            $this->is_new_article = 1;
            $this->all_sizes = [];
            $this->all_colors = [];
            foreach (Size::select('id', 'value')->get() as $size) {
                $this->all_sizes[$size->id] = $size->value;
            }
            foreach (Color::select('id', 'name')->get() as $color) {
                $this->all_colors[$color->id] = $color->name;
            }
            foreach (Shop::select('id', 'name')->get() as $shop) {
                $this->all_shops[$shop->id] = $shop->name;
            }
            $this->size_id = 0;
            $this->color_id = 0;
            $this->article_creation_date = "dd.mm.yyyy";
            $this->shop_id = 1;
        } elseif ($this->article_id == -1) {
            $this->all_sizes = [];
            $this->all_colors = [];
            $this->all_shops = [];
            $this->size_id = 0;
            $this->color_id = 0;
            $this->article_creation_date = "01.01.2022";
            $this->shop_id = 0;
        } else {
            $this->is_new_article = 0;
            $article = Article::find($this->article_id);
            $this->all_sizes = [];
            $this->all_sizes[$article->size()->first()->id] = $article->size()->first()->value;
            $this->all_colors = [];
            $this->all_colors[$article->color()->first()->id] = $article->color()->first()->name;
            $this->all_shops = [];
            foreach (Shop::select('id', 'name')->get() as $shop) {
                $this->all_shops[$shop->id] = $shop->name;
            }
            $this->shop_id = $article->available_shops()->first()->id;

            $this->size_id = $article->size()->first()->id;
            $this->color_id = $article->color()->first()->id;

            $this->article_creation_date = $article->creation_date;
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photos.*' => 'image|max:6144', // 6MB Max
        ]);
    }

    public function clearAllFields()
    {
        $this->all_creations = $this->getAvailableCreations()->sortBy('name');
        $this->existing_variations = collect([]);
        $this->is_new_article = 1;
        $this->all_sizes = [];
        $this->all_colors = [];
        $this->article_creation_date = "dd.mm.yyyy";
        $this->photos = [];
        $this->creation_id = 0;
        $this->article_id = 0;
        $this->size_id = 0;
        $this->color_id = 0;
    }

    public function savePhoto()
    {
        $saved_pictures_count = 0;
        // Validation
        $form_check_ok = 0;
        if (Creation::find($this->creation_id)
            && count($this->photos) > 0
            && Shop::find($this->shop_id)) {
            $form_check_ok = 1;
        }

        if ($form_check_ok == 1) {
            $photo_counter = 1;
            $creation_name = Creation::find($this->creation_id)->name;
            $all_clear = 0;

            if ($this->is_new_article == 0) {
                if (Article::find($this->article_id) 
                    && Creation::find($this->creation_id)->articles()->where('id', $this->article_id)->count() > 0) {
                    $article_name = Article::find($this->article_id)->name;
                    $photo_counter = Article::find($this->article_id)->photos()->count() + 1;
                    $article_index = Creation::find($this->creation_id)->articles()->count();
                    $all_clear = 1;
                } else {
                    $this->notify('danger', 'An error occured, article could not be found...');
                    $this->photos = collect([]);
                }
            } else {
                $article_index = Creation::find($this->creation_id)->articles()->count() + 1;
                $article_name = ucfirst(strtolower($creation_name)).'-'.str_pad($article_index, 3, '0', STR_PAD_LEFT);

                $new_article = new Article();
                $new_article->name = $article_name;
                $new_article->creation_id = Creation::find($this->creation_id)->id;
                $new_article->size_id = $this->size_id;
                $new_article->color_id = $this->color_id;
                $new_article->secondary_color = "Not defined";
                $new_article->third_color = "Not defined";
                $new_article->translation_key = "article.singularity-".strtolower($article_name);
                $new_article->creation_date = $this->article_creation_date;
                if ($new_article->save()) {
                    $all_clear = 1;
                    $this->article_id = $new_article->id;
                }
            }

            if ($all_clear == 1) {
                $updated_article = Article::find($this->article_id);
                $updated_article->update(['checked' => '0']);
                if (!($updated_article->available_shops()->get()->contains($this->shop_id))) {
                    $updated_article->shops()->attach($this->shop_id, [
                        'stock' => 1,
                    ]);
                }
                foreach ($this->photos as $photo) {
                    $random_counter = rand(100, 999);
                    $img = Image::make($photo);
                    if($this->savePhotoWithWatermark($img, $creation_name, $article_name, $photo_counter, $random_counter)) {
                        $new_photo = new Photo();
                        $new_photo->file_name = 'processed/'.$creation_name.'/'.$article_name.'-'.$random_counter.''.$photo_counter.'.png';
                        $new_photo->use_for_model = 1;
                        if (strpos($photo->getClientOriginalName(), 'front') !== false) {
                            $new_photo->is_front = 1;
                        } else {
                            $new_photo->is_front = 0;
                        }
                        $new_photo->title = $creation_name.' by BENU COUTURE - Variation '.$article_index;
                        $new_photo->author = "BENU Village Esch Asbl";
                        if ($new_photo->save()) {
                            $updated_article->photos()->attach($new_photo->id);
                            $saved_pictures_count ++;
                            $photo_counter ++;
                        }
                    }
                }
                
                if ($saved_pictures_count == count($this->photos)) {
                    $this->notify('success', 'All photos imported, article updated in the database :)');
                    $this->clearAllFields();
                } else {
                    $this->notify('danger', 'An error occured, we could not save all the pictures... Please check all fields and contact an administrator if the problem is still present.');
                }
            }
        } else {
            $this->notify('danger', 'Importation could not be performed. Please check that a creation has been selected and that photos have been added.');
        }
    }
}
