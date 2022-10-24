<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Models\Article;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

use App\Traits\ArticleAnalyzer;

class VoucherSidebar extends Component
{
    use ArticleAnalyzer;

    public $voucher;
    public $voucher_id;
    public $content;
    public $singularity_query;
    public $is_wishlisted;

    public $voucher_value;
    public $voucher_type;
    public $sent_to_cart;

    protected $listeners = ['VoucherModalReady' => "loadVoucherDetails"];

    protected $rules = [
        'voucher_value' => 'required|integer',
        'voucher_type' => 'required|string',
    ];

    public function mount()
    {
        $this->voucher = collect([]);
        $this->content = 'overview';
        $this->singularity_query = "singularity_".app()->getLocale();
        $this->is_wishlisted = 0;
        $this->voucher_value = 30;
        $this->voucher_type = "pdf";
    }

    public function loadVoucherDetails(int $voucher_id)
    {
        $this->voucher_id = $voucher_id;

        if (Cart::where('cart_id', session('cart_id'))->count() > 0 && Cart::where('cart_id', session('cart_id'))->first()->couture_variations->contains($this->voucher_id)) {
            $this->sent_to_cart = 1;
        } else {
            $this->sent_to_cart = 0;
        }

        if(Article::where('id', $voucher_id)->count() > 0) {
            $this->voucher = Article::find($voucher_id);

            // Load wishlist status
            if (auth::check()) {
                if (auth::user()->wishlistArticles->contains($this->voucher_id)) {
                    $this->is_wishlisted = 1;
                } else {
                    $this->is_wishlisted = 0;
                }
            }

            //Select voucher type
            if ($this->voucher->voucher_type == '1') {
                $this->voucher_type = "fabric";
            } else {
                $this->voucher_type = "pdf";
            }

            // Send loading confirmation to JS
            $this->emit('voucherLoaded');
        }
    }

    public function updateValue($value)
    {
        $value = (int) $value;
        if (in_array($value, [30, 60, 90, 120, 150, 180])) {
            $this->voucher_value = $value;
        }
    }

    public function switchDisplay($action)
    {
        switch ($action) {
            case 'overview':
                $this->content = 'overview';
                break;

            case 'delivery':
                $this->content = 'delivery';
                break;

            case 'more':
                $this->content = 'more';
                break;
            
            default:
                $this->content = 'overview';
                break;
        }
        $this->emit('sidebarChange');
    }

    public function addToCart()
    {
        $this->validate();

        // $cart = Cart::firstOrNew([
        //     'cart_id' => session('cart_id')
        // ]);
        if (Cart::where('cart_id', session('cart_id'))->count() > 0) {
            $cart = Cart::where('cart_id', session('cart_id'))->first();
        } else {
            $cart = new Cart();
        }
        $cart->cart_id = session('cart_id');
        $cart->is_active = 1;
        if (auth()->check()) {
            $cart->user_id = auth()->user()->id;
        }
        $cart->status = 1;// 0 = created, 1 = currently updated, 2 = paying, 3 = paid, 4 = abandoned
        if ($cart->save()) {
            $cart->couture_variations()->attach($this->voucher_id, [
                'value' => $this->voucher_value
            ]);
            $this->sent_to_cart = 1;
            $this->emit('cartUpdated');
        }
    }

    public function closeSideBar()
    {
        $this->emit('closeSideBar');
        $this->closeVoucherSideBar();
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
        $this->emit('wishlistUpdated', $this->voucher->id);
    }

    public function closeVoucherSideBar()
    {
        $this->emit('closeVoucherSideBar');
    }

    public function render()
    {
        return view('livewire.modals.voucher-sidebar');
    }
}
