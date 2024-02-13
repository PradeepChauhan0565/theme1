<div>
    <style>
        .wishline {
            position: relative;
        }

        .wishline::before {
            content: '';
            background-color: #071d49;
            width: 100%;
            height: 1px;
            position: absolute;
            right: 0;
            top: 0;
        }

        .wishtag {
            position: absolute;
            top: -18px;
            left: 50%;
            border: 1px solid #071d49;
            padding: 4px 10px;
            transform: translateX(-50%);
            background-color: #071d49;
        }

        table,
        td {
            padding: 5px 0;
        }
    </style>


    <div class="container">
        <nav aria-label="breadcrumb" class="py-1">
            <ol class="breadcrumb" style="margin-bottom: 0rem; font-size:12px;">
                <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        <div class="wishline mt-5">
            <span class="wishtag" style="color: #fff;">Your Shopping Cart</span>
        </div>
        <br>
        <br>
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="row g-4 mb-5">
            @auth
                @php
                    $cartItems = App\Models\Cart::orderBy('id', 'DESC')
                        ->where('user_id', auth()->user()->id)
                        ->get();
                @endphp

                @if (count($cartItems) > 0)
                    <div class="col-lg-8 pt-4">
                        @foreach ($cartItems as $cartItem)
                            @php
                                $product = App\Models\Product::find($cartItem->product_id);
                            @endphp
                            <div class="border p-3  mb-3">
                                <div class="row ">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="mr-3 ">
                                            <div class=" border ">
                                                <img src="{{ asset('storage/' . $cartItem->product->image_url ?? '') }}"
                                                    alt="" style="width: 100%; height:100%; ">
                                            </div>
                                            <div class=" d-flex justify-content-between my-4" style="font-size: 13px;">


                                                <button wire:click="removeToCart({{ $cartItem->id }})" class="border px-1">
                                                    <span wire:loading.remove
                                                        wire:target="removeToCart({{ $cartItem->id }})">
                                                        Remove
                                                    </span>
                                                    <span wire:loading wire:target="removeToCart({{ $cartItem->id }})">
                                                        <div class="spinner-border" role="status" style="font-size:8px;">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </span>
                                                </button>
                                                <button wire:click="moveToWishlist({{ $cartItem->id }})"
                                                    class="border px-1">
                                                    <span wire:loading.remove
                                                        wire:target="moveToWishlist({{ $cartItem->id }})">
                                                        Move To Wishlist
                                                    </span>
                                                    <span wire:loading wire:target="moveToWishlist({{ $cartItem->id }})">
                                                        <div class="spinner-border" role="status" style="font-size:8px;">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <div>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td class=" h6">{{ $cartItem->product->name ?? '' }}</td>
                                                    <td style="text-align:right;"><i
                                                            class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ $cartItem->product->regular_price * $cartItem->quantity }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px;">SKU:{{ $cartItem->product->sku ?? '' }}
                                                    </td>
                                                    <td style="text-align:right;">
                                                        <div class="d-flex justify-content-end">
                                                            <button wire:click="decrementQty({{ $cartItem->id }})"
                                                                class="border"style="width: 30px;"><i
                                                                    class="icon fas fa-minus"></i></button>
                                                            <div class="border text-center" style="width: 30px;">
                                                                {{ $cartItem->quantity }}</div>
                                                            <button wire:click="incrementQty({{ $cartItem->id }})"
                                                                class="border"style="width: 30px;"><i
                                                                    class="icon fas fa-plus"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    @if ($cartItem->ring_size != 0)
                                                        <td style="font-size: 14px;">Size: {{ $cartItem->ring_size }}</td>
                                                        <td style="text-align:right;">
                                                        </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class=" h6 " style="border-bottom: 1px solid rgb(245, 239, 239);">
                                                        Product
                                                        Details</td>
                                                    <td
                                                        style="text-align:right; border-bottom: 1px solid rgb(245, 239, 239);">
                                                    </td>
                                                </tr>
                                                @if (count($product->materials->where('material_type_id', 2)) > 0)
                                                    @foreach ($product->materials->where('material_type_id', 2) as $metal)
                                                        <tr>
                                                            <td style="font-size: 14px;">Metal :</td>
                                                            <td style="text-align:right;font-size: 14px;">
                                                                {{ $metal->metalPurity->code ?? '' }}
                                                                {{ $metal->metalColor->code ?? '' }}
                                                                {{ $metal->metalType->code ?? '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; border-bottom: 1px solid rgb(245, 239, 239);">
                                                                Weight :</td>
                                                            <td
                                                                style="font-size: 14px; text-align:right; border-bottom: 1px solid rgb(245, 239, 239);">
                                                                {{ $metal->weight }} gram</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                @if (count($product->materials->where('material_type_id', 3)) > 0)
                                                    @foreach ($product->materials->where('material_type_id', 3) as $diamonds)
                                                        <tr>
                                                            <td style="font-size: 14px;">Diamond :</td>
                                                            <td style="text-align:right;font-size: 14px;">
                                                                {{ $diamonds->qty }} Diamond,
                                                                {{ $diamonds->diadondQuality->code ?? '' }},
                                                                {{ $diamonds->diadondColor->code ?? '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; border-bottom: 1px solid rgb(245, 239, 239);">
                                                                Weight :</td>
                                                            <td
                                                                style="font-size: 14px; text-align:right; border-bottom: 1px solid rgb(245, 239, 239);">
                                                                {{ $diamonds->qty * $diamonds->weight }} Ct</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                @if (count($product->materials->where('material_type_id', 4)) > 0)
                                                    @foreach ($product->materials->where('material_type_id', 4) as $colorStone)
                                                        <tr>
                                                            <td style="font-size: 14px;">Color Stone :</td>
                                                            <td style="text-align:right;font-size: 14px;">
                                                                {{ $colorStone->qty }} Stone,
                                                                {{ $colorStone->colorStoneName->code ?? '' }},
                                                                {{ $colorStone->colorStoneColor->code ?? '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; border-bottom: 1px solid rgb(245, 239, 239);">
                                                                Weight :</td>
                                                            <td
                                                                style="font-size: 14px; text-align:right; border-bottom: 1px solid rgb(245, 239, 239);">
                                                                {{ $colorStone->qty * $colorStone->weight }}
                                                                Ct</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4 pt-4">
                        <div class="w-100 border p-3" style=" position: -webkit-sticky; position: sticky; top: 0;">
                            <div class="h4 pb-2 text-center ">Order Summary</div>
                            {{-- <div class="d-flex justify-content-between  ">
                            <div>
                                <div>Total Items</div>
                            </div>
                            <div>

                                1
                            </div>
                        </div> --}}

                            <div class="d-flex justify-content-between mt-3  ">
                                <div>
                                    <div>Subtotal</div>
                                </div>
                                <div>
                                    <td style="text-align:right;"><i class="fa-solid fa-indian-rupee-sign"></i>
                                        {{ $sub_total }}
                                </div>
                            </div>
                            {{-- <div class="d-flex justify-content-between mt-3  ">
                            <div>
                                <div>You Saved</div>
                            </div>
                            <div>
                                - Rs:1000
                            </div>
                        </div> --}}

                            <div class="d-flex justify-content-between my-3  ">
                                <div>
                                    <div>Delivery Charge</div>
                                </div>
                                <div>
                                    Free
                                </div>
                            </div>
                            <div class="d-flex justify-content-between my-3  ">
                                <div>
                                    <div>Sales Tax</div>
                                </div>
                                <div>
                                    {{ $tax }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between my-3  ">
                                <div>
                                    <div><i class="fas fa-calendar-alt"></i> Estimated date</div>
                                </div>
                                <div>
                                    @php
                                        echo date('j M Y D', strtotime(' +15 day'));
                                    @endphp
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mt-1 ">
                                <div>
                                    <div class="h5">Order Total</div>
                                </div>
                                <div class="h5"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ $total }}
                                </div>
                            </div>


                            <a href="{{ asset('cart/checkout') }}"><button class="mt-4 w-100 rounded-full border-0 py-1"
                                    style="background-color: #071d49; color:#fff;">
                                    Secure Checkout</button></a>
                        </div>

                    </div>
            </div>
        @else
            <div class="d-flex justify-content-center pb-3 mb-4">
                <div class="text-center ">
                    <div class="">
                        <img src="images/no-product.png" alt="" style="width:100%;">
                    </div>
                    <h1 class=" mt-2">Oh ho!</h1>
                    <p class="mt-2 ">Your Cart is Empty!</p>
                    <a href="{{ asset('/') }}"><button
                            class="py-1 px-4 mt-2 border-0"style="background-color: #071d49; color:#fff;">Start
                            Shopping</button></a>
                </div>
            </div>
            @endif

        @endauth

        @guest
            <div class="d-flex justify-content-center pb-3 mb-4">
                <div class="text-center ">
                    <div class="">
                        <img src="images/no-product.png" alt="" style="width:100%;">
                    </div>
                    <h1 class=" mt-2">Oh ho!</h1>
                    <p class="mt-2 ">Your Cart is Empty!</p>
                    <a href="{{ asset('/') }}"><button
                            class="py-1 px-4 mt-2 border-0"style="background-color: #071d49; color:#fff;">Start
                            Shopping</button></a>
                </div>
            </div>
        @endguest
    </div>





</div>
