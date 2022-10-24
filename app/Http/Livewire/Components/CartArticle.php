<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

use App\Models\Article;
use App\Models\Cart;

class CartArticle extends Component
{

    public $article_id;
    public $is_wishlisted;
    public $is_gift;
    public $max_number;
    public $has_extra_option;
    public $with_extra_option;
    public $number;

    public $gift_price;

    protected $listeners = ['giftUpdated' => 'calculateGiftPrice'];

    public function mount() {
        if (auth()->check()) {
            if (auth()->user()->wishlistArticles->contains($this->article_id)) {
                $this->is_wishlisted = 1;
            } else {
                $this->is_wishlisted = 0;
            }
        }

        $this->calculateGiftPrice();

        if (Article::find($this->article_id) && Article::find($this->article_id)->name == 'voucher') {
            $this->max_number = 100;
        } elseif (Article::find($this->article_id) && Article::find($this->article_id)->pending_shops()->count() > 0 && Article::find($this->article_id)->pending_shops()->first()->pivot->stock > 1) {
            $this->max_number = Article::find($this->article_id)->pending_shops()->first()->pivot->stock;
        } else {
            $this->max_number = 1;
        }

        if (Article::find($this->article_id) && Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->count() > 0) {

            if (Article::find($this->article_id)->name == 'voucher') {
                $this->has_extra_option = 0;
            } else {
                $this->has_extra_option = Article::find($this->article_id)->creation->pillow_option;
            }

            $cart = Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->first();
            $this->number = $cart->pivot->articles_number;
            $this->with_extra_option = $cart->pivot->with_extra_article;
        }
    }

    public function updatedWithExtraOption()
    {
        if (Article::find($this->article_id) && Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->count() > 0) {

            $pivot = Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot;
            $pivot->with_extra_article = $this->with_extra_option;
            if ($pivot->save()) {
                $this->emit('cartSumUpdated');
            }
        }
    }

    public function calculateGiftPrice()
    {
        $pivot = Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->first()->pivot;
        $this->is_gift = $pivot->is_gift;

        $this->gift_price = 0;
        if ($this->is_gift == 1) {
            if ($pivot->with_wrapping == 1) {
                $this->gift_price += 5;
            }
            if ($pivot->with_card == 1) {
                $this->gift_price += 3;
            }
        }
    }

    public function showInfoModal()
    {
        $this->emit('activateInfoModal');
    }

    public function toggleWishlist()
    {
        if(auth()->check()) {
            if ($this->is_wishlisted == 0) {
                auth()->user()->wishlistArticles()->attach($this->article_id);
                $this->is_wishlisted = 1;
            } else {
                auth()->user()->wishlistArticles()->detach($this->article_id);
                $this->is_wishlisted = 0;
            }
        }
    }

    public function updateNumber($direction)
    {
        if ($direction == 'up') {
            $this->number = min($this->max_number, $this->number + 1);
        } else {
            $this->number = max(1, $this->number - 1);
            // if ($this->number - 1 == 0) {
            //     $this->removeItem();
            // } else {
            //     $this->number --;
            // }
        }
        if (Article::find($this->article_id) && Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->count() > 0) {

            $cart = Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->first();
            $cart->pivot->articles_number = $this->number;
            $cart->pivot->save();
        }
        $this->emit('cartSumUpdated');
    }

    public function removeItem()
    {
        $this->emit('articleRemoved', $this->article_id);
    }

    public function updatedIsGift()
    {
        if ($this->is_gift == true) {
            $this->emit('activateGiftModal', $this->article_id);
            Cart::where('carts.cart_id', session('cart_id'))->first()->couture_variations()->updateExistingPivot($this->article_id, [
                'is_gift' => 1,
            ]);
        } else {
            $cart = Article::find($this->article_id)->carts()->where('carts.cart_id', session('cart_id'))->first();
            $cart->pivot->is_gift = 0;

            Cart::where('carts.cart_id', session('cart_id'))->first()->couture_variations()->updateExistingPivot($this->article_id, [
                'is_gift' => 0,
            ]);
            $this->emit('giftUpdated');
        }
    }

    public function render()
    {
        return view('livewire.components.cart-article', [
            'article' => Article::find($this->article_id)
        ]);
    }
}
