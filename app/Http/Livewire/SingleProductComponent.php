<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\ReviewLike;
use App\Models\Size;
use App\Models\ProductReview;
use GuzzleHttp\Promise\Create;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SingleProductComponent extends Component
{
    use WithFileUploads;
    public $product;
    public $product_id;
    public $rating;
    public $title;
    public $review;
    public $image;
    public $user_name;
    public $user_email;
    public $review_id;
    public $ring_size;
    public $product_size_id;
    public function mount($product)
    {
        $this->product = $product;
    }

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

    public function ringSizeClick()
    {
        $this->product_size_id = $this->ring_size;
    }
    public function addToCart($productId)
    {

        if (Auth::check()) {
            $product = Product::find($productId);
            $ring = $this->product->product_size_id;

            if ($ring) {
                $this->validate([
                    'ring_size' => 'required',
                ], [
                    'ring_size.required' => 'Size is required.',
                ]);
            }
            $ring_size = Size::find($this->ring_size);
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId,
                'ring_size' => $ring_size->code ?? null,
                'quantity' => 1,
                'color' => 'y',
                'price' => $product->regular_price,
            ]);
            return redirect(route('cart'));
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }
    public function removepreview()
    {
        $this->image = null;
    }
    public function writeReview()
    {

        $this->validate([
            'rating' => 'required',
            'title' => 'required',
            'review' => 'required',
            'user_name' => 'required',
            'user_email' => 'required|email',
        ], [
            'rating.required' => 'Rating  is required.',
            'title.required' => 'Title is required.',
            'review.required' => 'Review  is required.',
            'user_name.required' => 'Name is required.',
            'user_email.required' => 'Email is required.',
        ]);

        if ($this->image) {
            $image_name = 0;
            $image_name = $this->image->getClientOriginalName();
            $image = $this->image->storeAs('public/ReviewImage', $image_name);
        }
        ProductReview::create([
            'product_id' => $this->product_id,
            'score' => $this->rating,
            'title' => $this->title,
            'review' => $this->review,
            'image' => $image_name ?? null,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
        ]);
        session()->flash('message', 'Review created successfully.');
        $this->dispatchBrowserEvent('livewireCloseModal');
    }
    public function isLike($like, $review_id)
    {
        if (Auth::check()) {
            $exist = ReviewLike::where('user_id', auth()->user()->id)->where('review_id', $review_id)->where('likes', $like)->first();
            if ($exist) {
                $exist->delete();
            } else {
                if (ReviewLike::where('user_id', auth()->user()->id)->where('review_id', $review_id)->first()) {

                    ReviewLike::where('user_id', Auth::user()->id)->where('review_id', $review_id)->update([
                        'dislikes' => null,
                        'likes' => $like,
                    ]);
                } else {
                    ReviewLike::create([
                        'user_id' => auth()->user()->id,
                        'review_id' => $review_id,
                        'likes' => $like,
                        'dislikes' => null
                    ]);
                }
            }
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }
    public function isDislike($dislike, $review_id)
    {
        if (Auth::check()) {
            $exist = ReviewLike::where('user_id', auth()->user()->id)->where('review_id', $review_id)->where('dislikes', $dislike)->first();
            if ($exist) {
                $exist->delete();
            } else {
                if (ReviewLike::where('user_id', auth()->user()->id)->where('review_id', $review_id)->first()) {

                    ReviewLike::where('user_id', Auth::user()->id)->where('review_id', $review_id)->update([
                        'likes' => null,
                        'dislikes' => $dislike,
                    ]);
                } else {
                    ReviewLike::create([
                        'user_id' => auth()->user()->id,
                        'review_id' => $review_id,
                        'likes' => null,
                        'dislikes' => $dislike
                    ]);
                }
            }
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }

    function openModal($product_id)
    {
        $this->product_id = $product_id;
        $this->dispatchBrowserEvent('livewireOpenModal');
    }

    public function render()
    {
        return view('livewire.single-product-component', [
            'ringSizes' => Size::orderBy('code', 'asc')->get(),
        ]);
    }
}
