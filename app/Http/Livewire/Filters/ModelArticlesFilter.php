<?php

namespace App\Http\Livewire\Filters;

use Livewire\Component;

class ModelArticlesFilter extends Component
{
    public $initial_filters;
    public $filter_names;
    public $sorting_order;

    public $active_filters;

    public $mobile_sort_active;
    public $mobile_filters_active;
    public $mobile_show_sizes;
    public $mobile_show_colors;
    public $mobile_show_shops;

    public function mount()
    {
        $this->sorting_order = 'asc';
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
        $this->mobile_show_sizes = 0;
        $this->mobile_show_colors = 0;
        $this->mobile_show_shops = 0;
    }

    public function toggleFilter($filter, $value)
    {
        if ($this->active_filters[$filter][$value] == '0') {
            $this->active_filters[$filter][$value] = 1;
        } else {
            $this->active_filters[$filter][$value] = 0;
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
        $this->emit('filtersUpdated', $this->active_filters);
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

            case 'size':
                $show = 0;
                if (!$this->mobile_show_sizes) {
                    $show = 1;
                }
                // $this->initializeFiltersDisplay();
                if ($show) {
                    $this->mobile_show_sizes = 1;
                } else {
                    $this->mobile_show_sizes = 0;
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
            
            default:
                $this->initializeFiltersDisplay();
                break;
        }
    }

    public function render()
    {
        return view('livewire.filters.model-articles-filter');
    }
}
