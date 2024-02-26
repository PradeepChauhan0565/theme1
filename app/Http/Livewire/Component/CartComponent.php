<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartItems;
    public $sub_total = 0;
    public $total = 0;
    public $tax = 0;

    public function render()
    {
        if (Auth::check()) {
            $this->cartItems = Cart::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->get();
            $this->sub_total = 0;
            $this->total = 0;
            $this->tax = 0;
            foreach ($this->cartItems as $item) {
                $this->sub_total += $item->product->regular_price * $item->quantity;
            }
            $this->total = $this->sub_total - $this->tax;
        }

        return view('livewire.component.cart-component');
    }
    public function removeToCart($cartId)
    {
        if (Auth::check()) {
            Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->delete();
            $this->emit('cartAddedUpdeted');
            session()->flash('message', ' Product removed from cart Successfully');
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }

    public function moveToWishlist($cartId)
    {

        if (Auth::check()) {
            $productId = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->pluck('product_id');
            if (Wishlist::where('user_id', auth()->user()->id)->whereIn('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist.');
                Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->delete();
                $this->emit('cartAddedUpdeted');
            } else {
                foreach ($productId as $p_id) {
                    Wishlist::create([
                        'user_id' => auth()->user()->id,
                        'product_id' => $p_id
                    ]);
                }
                session()->flash('message', 'Move wishlist  Successfully');
                Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->delete();
                $this->emit('wishlistAddedUpdeted');
            }
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }

    public function incrementQty($productId)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->where('id', $productId)->first();
            $cart->quantity += 1;
            $cart->save();
            session()->flash('message', ' Product quantity updated Successfully');
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }

    public function decrementQty($productId)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->where('id', $productId)->first();
            if ($cart->quantity > 1) {
                $cart->quantity -= 1;
                $cart->save();
                session()->flash('message', ' Product quantity updated Successfully');
            } else {
                session()->flash('message', ' You can not have less than one quantity');
            }
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }
}
