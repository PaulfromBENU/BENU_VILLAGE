<?php

namespace App\Http\Livewire\Filters;

use Livewire\Component;

use App\Models\Article;

use App\Traits\FiltersGenerator;

class FilteredSoldArticles extends Component
{
    use FiltersGenerator;

    public $initial_filters;
    public $articles;
    public $creation;
    public $size_order;

    protected $listeners = ['filtersUpdated' => 'applyFilters', 'sortUpdated' => 'updateSorting'];

    public function mount()
    {
        // Sort by size
        $this->size_order = ['XS', 'XS-S', 'S', 'M', 'M-L', 'L', 'XL', 'XL-XXL', 'XXL', '3XL', '3XL-5XL', '4XL', '5XL', 50, 52, 54, 55, 56, 58, 60, 62, '62-68', 64, 66, 68, 70, 72, 74, '74-80', 76, 78, 80, 82, 84, 86, '86-92', 88, 90, 92, 94, 96, 98, '98-104', 100, 102, 104, 106, 108, 110, 112, 114, 116, 118, 120, 122, '36min', '13y', 'unique'];

        $this->applyFilters($this->initial_filters);
    }

    public function applyFilters($applied_filters)
    {
        //Initialize filtered models
        $this->articles = collect([]);
        
        // Compute collection of filtered models in FiltersGenerator Trait (required to keep full object relationships)
        $this->articles = $this->getFilteredArticles($this->creation, $applied_filters, 'sold');

        // Procedure for custom sort on collection
        $size_order = $this->size_order;
        $this->articles = $this->articles->sort(function ($a, $b) use ($size_order) {
          $pos_a = array_search($a->size->value, $size_order);
          $pos_b = array_search($b->size->value, $size_order);
          return $pos_a - $pos_b;
        });
    }

    public function updateSorting(string $sort_order, $applied_filters)
    {
        if (in_array($sort_order, ['asc', 'desc'])) {
            $this->sorting_order = $sort_order;
            $this->size_order = array_reverse($this->size_order);
            $this->applyFilters($applied_filters);
        }
    }

    public function render()
    {
        return view('livewire.filters.filtered-sold-articles');
    }
}
