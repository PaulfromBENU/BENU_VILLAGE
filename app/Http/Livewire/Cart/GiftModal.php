<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

use App\Models\Article;
use App\Models\Cart;

class GiftModal extends Component
{
    public $cart_id;
    public $article_id;
    public $section;

    public $with_wrapping;
    public $with_card;
    public $card_type;
    public $with_message;
    public $message;

    protected $listeners = ['activateGiftModal' => 'initializeModal'];

    protected $rules = [
        'with_wrapping' => 'nullable|boolean',
        'card_type' => 'nullable|integer',
        'message' => 'nullable|string|max:250',
    ];

    public function mount()
    {
        $this->article_id = 0;
        $this->section = 'wrapping';
    }

    public function initializeModal($article_id)
    {
        if (Cart::where('cart_id', $this->cart_id)->first()->couture_variations->contains($article_id)) {
            $this->article_id = $article_id;
            
            $pivot = Cart::where('cart_id', $this->cart_id)->first()->couture_variations()->find($this->article_id)->pivot;

            $this->with_wrapping = $pivot->with_wrapping;
            $this->with_card = $pivot->with_card;
            $this->card_type = $pivot->card_type;
            $this->with_message = $pivot->with_message;
            $this->message = $pivot->message;
        }
    }

    public function changeSection($section)
    {
        if (in_array($section, ['wrapping', 'card', 'message'])) {
            $this->section = $section;
        }
    }

    public function updateCard($card_type)
    {
        if ($card_type == $this->card_type) {
            $this->card_type = 0;
        } else {
            $this->card_type = $card_type;
        }
    }

    public function updateGiftInfo()
    {
        $this->validate();

        $pivot = Cart::where('cart_id', $this->cart_id)->first()->couture_variations()->find($this->article_id)->pivot;
        // Logic to update gift based on inputs
        if ($this->with_wrapping == true) {
            $pivot->with_wrapping = 1;
        } else {
            $pivot->with_wrapping = 0;
        }

        if (in_array($this->card_type, [1, 2, 3])) {
            $pivot->with_card = 1;
            $pivot->card_type = $this->card_type;
        } else {
            $pivot->with_card = 0;
            $pivot->card_type = 0;
        }
        
        if ($this->message !== null && $this->message !== "") {
            $pivot->with_message = 1;
            $pivot->message = $this->message;
        } else {
            $pivot->with_message = 0;
            $pivot->message = "";
        }

        if ($pivot->save()) {
            $this->emit('giftUpdated');
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        // dd($this->pivot);
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.cart.gift-modal');
    }
}
