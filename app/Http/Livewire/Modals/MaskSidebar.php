<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Illuminate\Support\Str;

use App\Models\Creation;
use App\Models\MaskOrder;

use Illuminate\Support\Facades\Auth;

use App\Traits\ArticleAnalyzer;

class MaskSidebar extends Component
{
    use ArticleAnalyzer;

    //protected $listeners = ['ArticleModalReady' => "loadArticleDetails"];

    public $age;
    public $creation_id;
    public $pictures;
    public $creation_name;
    public $creation_price;
    public $status;

    public $size;
    public $with_filter;
    public $with_cotton;
    public $masks_number;
    public $text_demand;
    public $email;
    public $with_pictures;

    public $singularity_query;

    protected $rules = [
        'size' => 'nullable|min:4|string',
        'with_filter' => 'nullable|boolean',
        'with_cotton' => 'nullable|boolean',
        'masks_number' => 'required|integer|max:500',
        'text_demand' => 'nullable|string|max:1000',
        'email' => 'required|email',
        'with_pictures' => 'nullable|boolean'
    ];

    public function mount()
    {
        $this->masks_number = 1;
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

    public function updateMasksNumber($direction = "up")
    {
        if ($direction == "up") {
            $this->masks_number ++;
        } else {
            if ($this->masks_number > 1) {
                $this->masks_number --;
            }
        }
        $this->emit('sidebarChange');
    }

    public function submitMasksRequest()
    {
        $this->validate();

        $new_mask_order = new MaskOrder();
        $new_mask_order->creation_id = $this->creation_id;
        if ($this->with_filter != null && in_array($this->with_filter, ['0', '1'])) {
            $new_mask_order->with_filter = $this->with_filter;
        } else {
            $new_mask_order->with_filter = '0';
        }

        if ($this->with_cotton != null && in_array($this->with_cotton, ['0', '1'])) {
            $new_mask_order->with_cotton = $this->with_cotton;
        } else {
            $new_mask_order->with_cotton = '0';
        }

        if ($this->size != null && in_array($this->size, ['small', 'large'])) {
            $new_mask_order->size = $this->size;
        } else {
            $new_mask_order->size = 'small';
        }

        if ($this->masks_number >= 1) {
            $new_mask_order->requested_number = $this->masks_number;
        } else {
            $new_mask_order->requested_number = '1';
        }

        if ($this->text_demand != null) {
            $new_mask_order->text_demand = $this->text_demand;
        } else {
            $new_mask_order->text_demand = "";
        }

        $new_mask_order->email = $this->email;

        if ($this->with_pictures != null) {
            $new_mask_order->with_pictures = '1';
        } else {
            $new_mask_order->with_pictures = '0';
        }

        if ($new_mask_order->save()) {
            $this->status = 'sent';
        }
    }

    public function closeSideBar()
    {
        $this->emit('closeSideBar');
        $this->closeMaskSideBar();
    }

    public function closeMaskSideBar()
    {
        $this->emit('closeMaskSideBar');
    }

    public function render()
    {
        return view('livewire.modals.mask-sidebar');
    }
}
