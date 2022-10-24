<?php

namespace App\Http\Livewire\Filters;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Creation;

use App\Traits\FiltersGenerator;

class FilteredModels extends Component
{
    use FiltersGenerator;

    public $initial_filters;
    public $sections_number;
    public $filtered_models;
    public $displayed_models;
    public $sort_direction;
    public $initial_load;
    public $applied_filters;
    public $family;

    // Required to persist filters in the URL dynamically
    public $types;
    public $categories;
    public $colors;
    public $prices;
    public $shops;

    public $paginate_pages_count;
    public $paginate_page;

    protected $queryString = [
        'paginate_page'  => ['except' => 1, 'as' => 'page'],
        'types'  => ['except' => ''],
        'categories'  => ['except' => ''],
        'colors'  => ['except' => ''],
        'prices'  => ['except' => ''],
        'shops'  => ['except' => ''],
    ];

    protected $listeners = ['filtersUpdated' => 'resetPagination', 'sortUpdated' => 'changeSorting'];

    public function mount(Request $request)
    {
        $this->sort_direction = 'asc';
        if (isset($request->page)) {
            $this->paginate_page = intval($request->page);
        } else {
            $this->paginate_page = 1;
        }
        $this->adaptQueryFilters($this->initial_filters);
        $this->applyFilters($this->initial_filters);
        $this->initial_load = 1;
    }

    public function applyFilters($applied_filters)
    {
        $this->applied_filters = $applied_filters;

        $this->adaptQueryFilters($this->applied_filters);

        //Initialize filtered models
        $this->filtered_models = collect([]);
        
        // Compute collection of filtered models in FiltersGenerator Trait (required to keep full object relationships)
        $this->filtered_models = $this->getFilteredCreations($applied_filters, $this->family);

        $this->paginate_pages_count = intval(floor($this->filtered_models->count() / 12) + 1);
        // Check paginate_page value in case request has wrong data
        if ($this->paginate_page < 1 || $this->paginate_page > $this->paginate_pages_count) {
            $this->paginate_page = 1;
        }
        
        $this->sortAndDivide();
    }

    public function resetPagination($applied_filters)
    {
        $this->paginate_page = 1;
        $this->applyFilters($applied_filters);
    }

    public function changeSorting(string $sort_dir, $applied_filters)
    {
        $this->paginate_page = 1;

        if ($sort_dir == 'desc') {
            $this->sort_direction = 'desc';
        } else {
            $this->sort_direction = 'asc';
        }

        $this->applyFilters($applied_filters); //Necessary to avoid models conversion to array
    }

    public function sortAndDivide()
    {   

        //Count number of required sections based on total number of creations
        //$this->sections_number = floor($this->filtered_models->count() / 6) + 1;

        $this->sections_number = 1;
        if ($this->paginate_page < $this->paginate_pages_count || fmod($this->filtered_models->count(), 12) > 6) {
            $this->sections_number = 2;
        }

        for ($i=0; $i < $this->sections_number; $i++) { 
            if ($this->sort_direction == 'desc') {
                $this->displayed_models[$i] = $this->filtered_models->sortByDesc(function($creation){
                    return $creation->price;
                })->slice(($this->paginate_page - 1) * 12 + $i * 6, 6)->values();
                // $this->filtered_models = $this->filtered_models->slice(($this->paginate_page - 1) * 12, 12);
            } else {
                $this->displayed_models[$i] = $this->filtered_models->sortBy(function($creation){
                    return $creation->price;
                })->slice(($this->paginate_page - 1) * 12 + $i * 6, 6)->values();
            }
        }
    }

    public function changePage($page = "1")
    {
        if ($page == "" || $page == 'next') {
            if ($this->paginate_page < $this->paginate_pages_count) {
                $this->paginate_page ++;
            }
        } elseif ($page == 'previous') {
            if ($this->paginate_page > 0) {
                $this->paginate_page --;
            }
        } else {
            $this->paginate_page = intval($page);
        }

        $this->applyFilters($this->applied_filters); //Necessary to avoid models conversion to array
        $this->emit('pageChanged');
    }

    public function adaptQueryFilters($filters)
    {
        // Updates the URL according to the applied filters, so the same filters and pagination will remain available when coming back to the page
        $this->categories = '';
        $this->types = '';
        $this->colors = '';
        $this->sizes = '';
        $this->prices = '';
        $this->shops = '';

        foreach ($filters['categories'] as $category => $value) {
            if ($value == 1) {
                $this->categories .= $category.'*';
            }
        }
        if (substr($this->categories, -1) == "*") {
            $this->categories = substr($this->categories, 0, -1);
        }

        foreach ($filters['types'] as $type => $value) {
            if ($value == 1) {
                $this->types .= $type.'*';
            }
        }
        if (substr($this->types, -1) == "*") {
            $this->types = substr($this->types, 0, -1);
        }

        foreach ($filters['colors'] as $color => $value) {
            if ($value == 1) {
                $this->colors .= $color.'*';
            }
        }
        if (substr($this->colors, -1) == "*") {
            $this->colors = substr($this->colors, 0, -1);
        }

        foreach ($filters['prices'] as $price => $value) {
            if ($value == 1) {
                $this->prices .= $price.'*';
            }
        }
        if (substr($this->prices, -1) == "*") {
            $this->prices = substr($this->prices, 0, -1);
        }

        foreach ($filters['shops'] as $shop => $value) {
            if ($value == 1) {
                $this->shops .= $shop.'*';
            }
        }
        if (substr($this->shops, -1) == "*") {
            $this->shops = substr($this->shops, 0, -1);
        }
    }

    public function render()
    {
        return view('livewire.filters.filtered-models');
    }
}
