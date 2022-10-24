<?php

namespace App\Http\Livewire\Filters;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\ModelFilter;

class AllModelsFilter extends Component
{
    public $initial_filters;
    public $filter_names;
    public $family;

    public $active_filters;
    public $sorting_order;

    public $mobile_sort_active;
    public $mobile_filters_active;
    public $mobile_show_families;
    public $mobile_show_types;
    public $mobile_show_categories;
    public $mobile_show_colors;
    public $mobile_show_prices;
    public $mobile_show_shops;
    public $mobile_show_partners;

    protected $queryString = ['family' => ['except' => '']];

    public function mount(Request $request)
    {
        $this->sorting_order = 'asc';

        // Adapt family of products acccording to request
        // if (!isset($request->family) || $request->family == 'clothes') {
        //     $this->family = 'clothes';
        // } elseif (in_array($request->family, ['accessories', 'home'])) {
        //     $this->family = $request->family;
        // }

        $this->active_filters = $this->initial_filters;
        $this->initializeMobileDisplay();
    }

    public function initializeMobileDisplay()
    {
        $this->mobile_sort_active = 0;
        $this->mobile_filters_active = 0;
        $this->initializeFiltersDisplay();
    }

    public function initializeFiltersDisplay()
    {
        $this->mobile_show_families = 0;
        $this->mobile_show_types = 0;
        $this->mobile_show_categories = 0;
        $this->mobile_show_colors = 0;
        $this->mobile_show_prices = 0;
        $this->mobile_show_shops = 0;
        $this->mobile_show_partners = 0;
    }

    public function toggleFilter($filter, $value)
    {
        if ($filter == 'families') {
            if (in_array($value, ['clothes', 'accessories', 'home'])) {
                $this->family = $value;
            }
        } else {
            if ($this->active_filters[$filter][$value] == '0') {
                $this->active_filters[$filter][$value] = 1;
            } else {
                $this->active_filters[$filter][$value] = 0;
            }
        }

        $this->sendFilters();
        $this->initializeMobileDisplay();
    }

    public function updateSorting(string $sort_order)
    {
        if (in_array($sort_order, ['asc', 'desc'])) {
            $this->sorting_order = $sort_order;
            $this->emit('sortUpdated', $this->sorting_order, $this->active_filters);
            $this->initializeMobileDisplay();
        }
    }

    public function sendFilters()
    {
        // Update active filters in DB, to be transferred to specific model page
        $stored_filters = ModelFilter::where('session_id', session('secret_id'))->first();
        $stored_filters->applied_filters = json_encode($this->active_filters);
        $stored_filters->save();

        $this->emit('filtersUpdated', $this->active_filters);
    }

    public function showSortMobileOptions()
    {
        $this->mobile_sort_active = 1;
        $this->mobile_filters_active = 0;
        $this->emit('showSortMobile');
    }

    public function showSortMobileFilters()
    {
        $this->mobile_sort_active = 0;
        $this->mobile_filters_active = 1;
        $this->emit('showFiltersMobile');
    }

    public function resetMobileWindow()
    {
        $this->mobile_sort_active = 0;
        $this->mobile_filters_active = 0;
        $this->emit('resetMobileWindow');
    }

    public function showMobileFilters(string $filter)
    {
        switch ($filter) {
            case 'family':
                $show = 0;
                if (!$this->mobile_show_families) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_families = 1;
                } else {
                    $this->mobile_show_families = 0;
                }
                $this->emit('showFiltersMobile');
                break;

            case 'type':
                $show = 0;
                if (!$this->mobile_show_types) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_types = 1;
                } else {
                    $this->mobile_show_types = 0;
                }
                $this->emit('showFiltersMobile');
                break;

            case 'category':
                $show = 0;
                if (!$this->mobile_show_categories) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_categories = 1;
                } else {
                    $this->mobile_show_categories = 0;
                }
                $this->emit('showFiltersMobile');
                break;

            case 'color':
                $show = 0;
                if (!$this->mobile_show_colors) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_colors = 1;
                } else {
                    $this->mobile_show_colors = 0;
                }
                $this->emit('showFiltersMobile');
                break;

            case 'price':
                $show = 0;
                if (!$this->mobile_show_prices) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_prices = 1;
                } else {
                    $this->mobile_show_prices = 0;
                }
                $this->emit('showFiltersMobile');
                break;

            case 'shop':
                $show = 0;
                if (!$this->mobile_show_shops) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_shops = 1;
                } else {
                    $this->mobile_show_shops = 0;
                }
                $this->emit('showFiltersMobile');
                break;

            case 'partner':
                $show = 0;
                if (!$this->mobile_show_partners) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_partners = 1;
                } else {
                    $this->mobile_show_partners = 0;
                }
                $this->emit('showFiltersMobile');
                break;
            
            default:
                $this->initializeFiltersDisplay();
                break;
        }
    }

    public function render()
    {
        return view('livewire.filters.all-models-filter');
    }
}
