<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Models\Article;
use App\Models\CareRecommendation;
use App\Models\Composition;
use App\Models\Shop;

class ValidateArticles extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static string $view = 'filament.pages.validate-articles';

    protected static ?string $title = 'Validate new variations';
 
    protected static ?string $navigationLabel = 'New Variation - Validation';
     
    protected static ?string $slug = 'validate-articles';

    protected static ?string $navigationGroup = 'Creations & Variations';

    protected static ?int $navigationSort = 5;

    public $variations_to_validate;
    public $all_shops = [];
    public $all_compos = [];
    public $all_cares = [];
    public $stocks;
    public $compo_ids = [];
    public $care_ids = [];
    public $singularities_fr = [];
    public $singularities_de = [];
    public $singularities_en = [];
    public $singularities_lu = [];

    public function mount()
    {
        foreach (Shop::select('id', 'name')->get() as $shop) {
            $this->all_shops[$shop->id] = $shop->name;
        }
        foreach (Composition::select('id', 'fabric_en')->get() as $composition) {
            $this->all_compos[$composition->id] = $composition->fabric_en;
        }
        foreach (CareRecommendation::select('id', 'description_en')->get() as $care) {
            $this->all_cares[$care->id] = $care->description_en;
        }

        $this->initializeVariations();
    }

    public function initializeVariations()
    {
        $this->variations_to_validate = Article::where('to_be_validated', '1')->where('checked', '0')->orderBy('created_at', 'desc')->get();
        foreach ($this->variations_to_validate as $article) {
            $this->stocks[$article->id] = [];

            foreach ($this->all_shops as $shop_id => $shop_name) {
                if ($article->shops->contains($shop_id)) {
                    $this->stocks[$article->id][$shop_id] = $article->shops()->where('shops.id', $shop_id)->first()->pivot->stock;
                } else {
                    $this->stocks[$article->id][$shop_id] = 0;
                }
            }

            foreach ($this->all_compos as $compo_id => $fabric) {
                if ($article->compositions->contains($compo_id)) {
                    $this->compo_ids[$article->id][$compo_id] = true; // $article->compositions()->where('compositions.id', $compo_id)->first()->id;
                } else {
                    $this->compo_ids[$article->id][$compo_id] = false;
                }
            }

            foreach ($this->all_cares as $care_id => $desc) {
                if ($article->care_recommendations->contains($care_id)) {
                    $this->care_ids[$article->id][$care_id] = true; // $article->care_recommendations()->where('care_recommendations.id', $care_id)->first()->id;
                } else {
                    $this->care_ids[$article->id][$care_id] = false;
                }
            }

            $this->singularities_de[$article->id] = $article->singularity_de;
            $this->singularities_lu[$article->id] = $article->singularity_lu;
            $this->singularities_en[$article->id] = $article->singularity_en;
            $this->singularities_fr[$article->id] = $article->singularity_fr;
        }
    }

    public function validateVariation($variation_id)
    {
        if (Article::find($variation_id)) {
            $variation_to_validate = Article::find($variation_id);
            $variation_to_validate->checked = 1;
            $variation_to_validate->save();
            $this->initializeVariations();
            $this->notify('success', 'Variation '.$variation_to_validate->name.' has been validated and is now visible on the website!');
        }
    }

    public function refuseVariation($variation_id)
    {
        if (Article::find($variation_id)) {
            $variation_to_validate = Article::find($variation_id);
            $variation_to_validate->to_be_validated = 0;
            $variation_to_validate->checked = 0;
            $variation_to_validate->save();
            $this->initializeVariations();
            $this->notify('success', 'Variation '.$variation_to_validate->name.' has been refused and is back to the previous step.');
        }
    }
}
