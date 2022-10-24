<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Illuminate\Support\Str;

use App\Models\Creation;
use App\Models\ItemOrder;

use Illuminate\Support\Facades\Auth;

use App\Traits\ArticleAnalyzer;

class SmallItemsSidebar extends Component
{
    use ArticleAnalyzer;

    public $creation_id;
    public $pictures;
    public $creation_name;
    public $creation_price;
    public $status;

    public $items_number;
    public $text_demand;
    public $email;
    public $with_pictures;

    public $singularity_query;

    protected $rules = [
        'items_number' => 'required|integer|max:500',
        'text_demand' => 'nullable|string|max:1000',
        'email' => 'required|email',
        'with_pictures' => 'nullable|boolean'
    ];

    public function mount()
    {
        $this->items_number = 1;
        $this->status = 'pending';
        $this->getCreationData();
        if (Auth::check()) {
            $this->email = Auth::user()->email;
        }
        $this->singularity_query = "singularity_".app()->getLocale();
    }

    public function getCreationData()
    {
        $creation = Creation::find($this->creation_id);
        $this->creation_name = $creation->name;
        $this->creation_price = $creation->price;
    }

    public function updateItemsNumber($direction = "up")
    {
        if ($direction == "up") {
            $this->items_number ++;
        } else {
            if ($this->items_number > 1) {
                $this->items_number --;
            }
        }
        $this->emit('sidebarChange');
    }

    public function submitItemsRequest()
    {
        $this->validate();

        $new_item_order = new ItemOrder();
        $new_item_order->creation_id = $this->creation_id;

        if ($this->items_number >= 1) {
            $new_item_order->requested_number = $this->items_number;
        } else {
            $new_item_order->requested_number = '1';
        }

        if ($this->text_demand != null) {
            $new_item_order->text_demand = $this->text_demand;
        } else {
            $new_item_order->text_demand = "";
        }

        $new_item_order->email = $this->email;

        if ($this->with_pictures != null) {
            $new_item_order->with_pictures = '1';
        } else {
            $new_item_order->with_pictures = '0';
        }

        if ($new_item_order->save()) {
            $this->status = 'sent';
        }
    }

    public function closeSideBar()
    {
        $this->emit('closeSideBar');
        $this->closeItemsSideBar();
    }

    public function closeItemsSideBar()
    {
        $this->emit('closeItemsSideBar');
    }

    public function render()
    {
        return view('livewire.modals.small-items-sidebar');
    }
}
