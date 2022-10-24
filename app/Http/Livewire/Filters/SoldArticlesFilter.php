<?php

namespace App\Http\Livewire\Filters;

use Livewire\Component;

class SoldArticlesFilter extends Component
{
    public $initial_filters;
    public $filter_names;
    public $sorting_order;

    public $active_filters;

    public function mount()
    {
        $this->sorting_order = 'asc';
        $this->active_filters = $this->initial_filters;
    }

    public function toggleFilter($filter, $value)
    {
        if ($this->active_filters[$filter][$value] == '0') {
            $this->active_filters[$filter][$value] = 1;
        } else {
            $this->active_filters[$filter][$value] = 0;
        }
        $this->sendFilters();
    }

    public function updateSorting(string $sort_order)
    {
        if (in_array($sort_order, ['asc', 'desc'])) {
            $this->sorting_order = $sort_order;
            $this->emit('sortUpdated', $this->sorting_order, $this->active_filters);
        }
    }

    public function sendFilters()
    {
        $this->emit('filtersUpdated', $this->active_filters);
    }

    public function render()
    {
        return view('livewire.filters.sold-articles-filter');
    }
}
