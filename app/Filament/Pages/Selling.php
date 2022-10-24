<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Actions\ButtonAction;

use App\Models\Article;
use App\Models\Creation;
use App\Models\Shop;

use App\Traits\ArticleAnalyzer;

class Selling extends Page
{
    use ArticleAnalyzer;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static string $view = 'filament.pages.selling';

    protected static ?string $title = 'Sell a variation';
 
    protected static ?string $navigationLabel = 'Sale interface';
     
    protected static ?string $slug = 'sale-interface';

    protected static ?string $navigationGroup = 'Seller & Sales';

    protected static ?int $navigationSort = 1;

    protected static function shouldRegisterNavigation(): bool
    {
        return (auth()->user()->role == 'deactivated');
    }

    public $lines_number;
    public $articles_sold;
    public $all_creations;
    public $computed_variations;
    public $available_shops;
    public $max_items;
    public $total_price;
    public $creation_name;
    public $variation_name;
    public $shop_name;
    public $articles_number;
    public $item_price;
    public $show_modal;


    public function mount()
    {
        $this->lines_number = 1;
        $this->all_creations = $this->getAvailableCreations()->sortBy('name');
        $this->total_price = 0;
        $this->computed_variations = collect([]);
        $this->available_shops = collect([]);
        $this->creation_name = 'none-0';
        $this->variation_name = 'none-0';
        $this->shop_name = 'none-0';
        $this->articles_number = 1;
        $this->item_price = 0;
        $this->show_modal = 0;
        $this->max_items = 1;
    }

    public function addArticle()
    {
        $this->lines_number ++;
    }

    public function adaptVariations($creation_id)
    {
        $this->clearItem();
        if ($creation_id == '0') {
            $this->computed_variations = collect([]);
        } elseif (Creation::find($creation_id)) {
            $this->computed_variations = $this->getAvailableArticles(Creation::find($creation_id));
        }
    }

    public function adaptShops($variation_id)
    {
        if ($variation_id == '0') {
            $this->available_shops = collect([]);
        } elseif (Article::find($variation_id)) {
            $this->available_shops = Article::find($variation_id)->available_shops()->get();
        }
    }

    public function adaptStock($shop_id)
    {
        if ($shop_id == '0') {
            $this->max_items = 1;
            $this->item_price = 0;
        } elseif (Shop::find($shop_id)) {
            $this->max_items = Article::where('name', $this->variation_name)->first()->shops()->where('shops.id', $shop_id)->first()->pivot->stock;
            $this->calculateItemPrice();
        }
    }

    public function calculateItemPrice()
    {
        if (Shop::where('filter_key', $this->shop_name)->count() > 0) {
            $this->item_price = round(Creation::where('name', $this->creation_name)->first()->price * $this->articles_number, 2);
            $this->total_price = $this->item_price;
        }
    }

    public function clearItem()
    {
        $this->variation_name = 'none-0';
        $this->shop_name = 'none-0';
        $this->computed_variations = collect([]);
        $this->available_shops = collect([]);
        $this->item_price = 0;
        $this->total_price = 0;
    }

    public function openConfirmationModal()
    {
        $this->show_modal = 1;
    }

    public function closeModal()
    {
        $this->show_modal = 0;
    }

    public function saveSell()
    {
        if (Creation::where('name', $this->creation_name)->count() > 0
            && Article::where('name', $this->variation_name)->count() > 0
            && Shop::where('filter_key', $this->shop_name)->count() > 0
            && Article::where('name', $this->variation_name)->first()->shops()->where('shops.filter_key', $this->shop_name)->first()->pivot->stock >= $this->articles_number) {

            Article::where('name', $this->variation_name)->first()->shops()->where('shops.filter_key', $this->shop_name)->first()->pivot->decrement('stock', $this->articles_number);

            // Reset data
            $this->creation_name = 'none-0';
            $this->clearItem();
            $this->notify('success', 'The sale was taken into account in the database :)');
        } else {
            $this->notify('danger', 'An error occured, please check the content or contact the administrator.');
        }
    }

    protected function getActions(): array
    {
        if ($this->articles_number == 1) {
            $subtitle = "1 article sera vendu, pour la somme de ".$this->total_price."€";
        } elseif ($this->articles_number > 1) {
            $subtitle = $this->articles_number." articles seront vendus, pour la somme de ".$this->total_price."€";
        }

        if ($this->total_price > 0) {
            return [
                ButtonAction::make('sell')
                    ->label('Confirmer Vente')
                    ->requiresConfirmation()
                    ->modalHeading('Confirmer la vente ?')
                    ->modalSubheading($subtitle)
                    ->action('saveSell')
                    ->color('success'),
            ];
        } else {
            return [];
        }
    }
}
