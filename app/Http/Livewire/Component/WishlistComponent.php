<?php

namespace App\Http\Livewire\Component;

use   App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistComponent extends Component
{
    public function removeToWishlist($wishId)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', auth()->user()->id)->where('id', $wishId)->delete();
            $this->emit('wishlistAddedUpdeted');
            session()->flash('message', 'Wishlist removed Successfully');
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }

    public function render()
    {
        return view('livewire.component.wishlist-component');
    }
}
