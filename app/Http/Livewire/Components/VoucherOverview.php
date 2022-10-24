<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Models\Article;

use Illuminate\Support\Facades\Auth;

class VoucherOverview extends Component
{
    public $voucher;

    public $is_wishlisted;

    protected $listeners = ['wishlistUpdated' => 'updateWishlist'];

    public function mount()
    {
        if (auth::check()) {
            if (auth::user()->wishlistArticles->contains($this->voucher->id)) {
                $this->is_wishlisted = 1;
            } else {
                $this->is_wishlisted = 0;
            }
        }
    }

    public function toggleWishlist()
    {
        if(auth::check()) {
            if ($this->is_wishlisted == 0) {
                auth::user()->wishlistArticles()->attach($this->voucher->id);
                $this->is_wishlisted = 1;
            } else {
                auth::user()->wishlistArticles()->detach($this->voucher->id);
                $this->is_wishlisted = 0;
            }
        }
    }

    public function updateWishlist($voucher_id)
    {
        if ($this->voucher->id == $voucher_id) {
            $this->toggleWishlist();
        }
    }

    public function triggerSideBar()
    {
        $this->emit('displayVoucher', $this->voucher->id);
    }

    public function render()
    {
        return view('livewire.components.voucher-overview');
    }
}
