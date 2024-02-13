<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;
use Livewire\Component;

class RecentlyViewComponent extends Component
{

    public function addToWishlist($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                // Session::flash('message', 'Already added to wisglist');
                session()->flash('message', 'Already added to wishlist.');
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdeted');
                session()->flash('message', 'Wishlist added Successfully');
            }
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }

    public function removeToWishlist($productId)
    {
        $data = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->delete();
        $this->emit('wishlistAddedUpdeted');
        session()->flash('message', 'Wishlist removed Successfully');
    }

    public function render()
    {
        $session_id = Session::get('session_id');
        $recentProductIds = DB::table('recently_viewed_products')->orderBy('id', 'desc')->where('session_id', $session_id)->take(4)
            ->pluck('product_id');

        $recentViewedProduct = Product::whereIn('id', $recentProductIds)->get();
        return view('livewire.recently-view-component', [
            'recentProducts' => $recentViewedProduct,
        ]);
    }
}
