<?php

namespace App\Http\Livewire\Header;

use Livewire\Component;

use App\Models\CreationGroup;
use App\Models\Creation;
use App\Traits\ArticleAnalyzer;

class CreationsMenuMobile extends Component
{
    use ArticleAnalyzer;

    public $already_loaded;

    public $unisex_clothes;
    public $unisex_accessories;
    public $adults_clothes;
    public $adults_accessories;
    public $new_adults_clothes;
    public $new_adults_accessories;
    public $ladies_clothes;
    public $ladies_accessories;
    public $gentlemen_clothes;
    public $gentlemen_accessories;
    public $kids_clothes;
    public $kids_accessories;
    public $accessories;
    public $home_creations;

    protected $listeners = ['loadCreationsMobile' => 'computeMenuContent'];

    public function mount()
    {
        $this->already_loaded = 0;

        $this->unisex_clothes = [];
        $this->unisex_accessories = [];
        $this->adults_clothes = [];
        $this->adults_accessories = [];
        $this->new_adults_clothes = [];
        $this->new_adults_accessories = [];
        $this->ladies_clothes = [];
        $this->ladies_accessories = [];
        $this->gentlemen_clothes = [];
        $this->gentlemen_accessories = [];
        $this->kids_clothes = [];
        $this->kids_accessories = [];
        $this->accessories = [];
        $this->home_creations = [];
    }

    public function computeMenuContent()
    {
        if(!$this->already_loaded) {
            $category_query = "name_".app()->getLocale();
            $unisex_id = CreationGroup::where('filter_key', 'unisex')->first()->id;
            $ladies_id = CreationGroup::where('filter_key', 'ladies')->first()->id;
            $gentlemen_id = CreationGroup::where('filter_key', 'gentlemen')->first()->id;
            $kids_id = CreationGroup::where('filter_key', 'kids')->first()->id;
            $home_id = CreationGroup::where('filter_key', 'home')->first()->id;
            $accessories_id = CreationGroup::where('filter_key', 'accessories')->first()->id;

            foreach ($this->getAvailableCreations() as $creation) {
                $filter_key = $creation->creation_category->filter_key;
                $query = $creation->creation_category->$category_query;
                
                // Fill Unisex arrays
                if (!isset($this->unisex_clothes[$query])) {
                    if ($creation->creation_groups->contains($unisex_id) && $creation->is_accessory == '0') {
                        $this->unisex_clothes[$query] = $filter_key;
                    }
                }
                if (!isset($this->unisex_accessories[$query])) {
                    if ($creation->creation_groups->contains($unisex_id) && $creation->is_accessory == '1') {
                        $this->unisex_accessories[$query] = $filter_key;
                    }
                }

                // Fill Ladies arrays
                if (!isset($this->ladies_clothes[$query])) {
                    if ($creation->creation_groups->contains($ladies_id) && $creation->is_accessory == '0') {
                        $this->ladies_clothes[$query] = $filter_key;
                    }
                }
                if (!isset($this->ladies_accessories[$query])) {
                    if ($creation->creation_groups->contains($ladies_id) && $creation->is_accessory == '1') {
                        $this->ladies_accessories[$query] = $filter_key;
                    }
                }

                // Fill Gentlemen arrays
                if (!isset($this->gentlemen_clothes[$query])) {
                    if ($creation->creation_groups->contains($gentlemen_id) && $creation->is_accessory == '0') {
                        $this->gentlemen_clothes[$query] = $filter_key;
                    }
                }
                if (!isset($this->gentlemen_accessories[$query])) {
                    if ($creation->creation_groups->contains($gentlemen_id) && $creation->is_accessory == '1') {
                        $this->gentlemen_accessories[$query] = $filter_key;
                    }
                }

                // Fill Kids arrays
                if (!isset($this->kids_clothes[$query])) {
                    if ($creation->creation_groups->contains($kids_id) && $creation->is_accessory == '0') {
                        $this->kids_clothes[$query] = $filter_key;
                    }
                }
                if (!isset($this->kids_accessories[$query])) {
                    if ($creation->creation_groups->contains($kids_id) && $creation->is_accessory == '1') {
                        $this->kids_accessories[$query] = $filter_key;
                    }
                }

                // Fill Accessories arrays
                if (!isset($this->accessories[$query])) {
                    if ($creation->is_accessory == '1') {
                        $this->accessories[$query] = $filter_key;
                    }
                }

                // Fill Home creations arrays
                if (!isset($this->home_creations[$query])) {
                    if ($creation->creation_groups->contains($home_id)) {
                        $this->home_creations[$query] = $filter_key;
                    }
                }
            }

            $this->adults_clothes = array_merge($this->unisex_clothes, $this->ladies_clothes, $this->gentlemen_clothes);
            $this->adults_accessories = array_merge($this->unisex_accessories, $this->ladies_accessories, $this->gentlemen_accessories);

            ksort($this->unisex_clothes);
            ksort($this->unisex_accessories);
            ksort($this->ladies_clothes);
            ksort($this->ladies_accessories);
            ksort($this->gentlemen_clothes);
            ksort($this->gentlemen_accessories);
            ksort($this->adults_clothes);
            ksort($this->adults_accessories);
            ksort($this->kids_clothes);
            ksort($this->kids_accessories);
            ksort($this->accessories);

            $this->already_loaded = 1;
        }
    }

    public function render()
    {
        return view('livewire.header.creations-menu-mobile');
    }
}
