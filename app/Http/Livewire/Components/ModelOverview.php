<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

use App\Traits\ArticleAnalyzer;

class ModelOverview extends Component
{
    use ArticleAnalyzer;

    public $model;
    public $model_category;
    public $available_colors;
    public $pictures;
    public $current_picture_index;
    public $available_articles_count;
    public $filters_color_link;
    public $filters_shop_link;
    
    //protected $listeners = ['updateLinksWithFilters' => 'addFiltersToLinks'];

    public function mount()
    {
        $this->current_picture_index = 0;

        $this->initializeData();
    }

    public function initializeData()
    {
        $this->available_colors = [];
        $this->pictures = collect([]);

        // Model category with localized translation
        $localized_category_query = 'name_'.app()->getLocale();
        $this->model_category = $this->model->creation_category->$localized_category_query;

        $this->available_articles_count = 0;

        // Get all available colors from available articles
        foreach ($this->getAvailableArticles($this->model) as $article) {
            if (!isset($this->available_colors[$article->color->id])) {
                $this->available_colors[$article->color->id] = $article->color->name;
            }
            // Front pictures used when available, otherwise other pictures
            if ($article->photos()->where('is_front', '1')->count() > 0) {
                $this->pictures->push($article->photos()->where('is_front', '1')->first()->file_name);
            } elseif ($article->photos()->count() > 0) {
                $this->pictures->push($article->photos()->first()->file_name);
            } else {
                // Use default picture?
            }

            // Compute available articles count
            $this->available_articles_count ++;
        }

        // Sort colors by chromatic order
        $unsorted_colors = $this->available_colors;
        $this->available_colors = [];
        $sorted_colors = [
            'white', 'beige', 'yellow', 'orange', 'red', 'pink', 'purple', 'blue', 'green', 'brown', 'grey', 'black', 'multicolored'
        ];

        foreach ($sorted_colors as $sorted_color) {
            if (($index = array_search($sorted_color, $unsorted_colors)) !== false) {
                array_push($this->available_colors, $unsorted_colors[$index]);
            }
        }
    }

    public function changePicture(string $side)
    {
        $pictures_number = $this->pictures->count();
        if ($side == 'left') {
            if ($this->current_picture_index == 0) {
                $this->current_picture_index = $pictures_number - 1;
            } else {
                $this->current_picture_index --;
            }
        } else {
            if ($this->current_picture_index == $pictures_number - 1) {
                $this->current_picture_index = 0;
            } else {
                $this->current_picture_index ++;
            }
        }
    }

    public function render()
    {
        return view('livewire.components.model-overview');
    }
}
