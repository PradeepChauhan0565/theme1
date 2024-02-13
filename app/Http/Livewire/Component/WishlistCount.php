<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Wishlist;

class WishlistCount extends Component
{
    public $wishlistCount;

    protected $listeners = ['wishlistAddedUpdeted' => 'checkWishlistCount'];
    public function checkWishlistCount()
    {
        if (Auth::check()) {
            return $this->wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        } else {
            return $this->wishlistCount = 0;
        }
    }
    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();
        return view('livewire.component.wishlist-count', [
            'wishlists' => $this->wishlistCount,
        ]);
    }
}
