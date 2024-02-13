<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Cart;

class CartCount extends Component
{

    public $cartCount;

    protected $listeners = ['cartAddedUpdeted' => 'checkcartCount'];
    public function checkcartCount()
    {
        if (Auth::check()) {
            return $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        } else {
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        $this->cartCount = $this->checkcartCount();
        return view('livewire.component.cart-count', [
            'cartCount' => $this->cartCount,
        ]);
    }
}
