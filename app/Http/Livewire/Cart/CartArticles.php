<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

use App\Models\Article;
use App\Models\Cart;

class CartArticles extends Component
{
    public $cart_id;
    public $couture_articles;

    protected $listeners = ['articleRemoved' => 'removeArticle'];

    public function mount()
    {
        $this->loadArticles();
    }

    public function loadArticles()
    {
        $cart = Cart::where('cart_id', $this->cart_id)->first();
        $this->couture_articles = $cart->couture_variations;
    }

    public function removeArticle($article_id)
    {
        if (Article::find($article_id)) {
            Article::find($article_id)->carts()->detach(Cart::where('cart_id', $this->cart_id)->first()->id);

            if (Article::find($article_id)->name !== 'voucher') {
                $pivot = Article::find($article_id)->pending_shops()->first()->pivot;
                $pivot->increment('stock');
                $pivot->decrement('stock_in_cart');
            }

            if (Cart::where('cart_id', $this->cart_id)->first()->couture_variations()->count() == 0) {
                $cart = Cart::where('cart_id', $this->cart_id)->first();
                if ($cart->order()->count() > 0) {
                    $cart->order->delete();
                }
                $cart->delete();
                return redirect()->route('cart-'.app()->getLocale());
            }

            $this->loadArticles();
            $this->emit('cartUpdated');
            $this->emit('cartSumUpdated');
        }
    }

    public function render()
    {
        return view('livewire.cart.cart-articles', [
            'couture_articles' => $this->couture_articles,
        ]);
    }
}
