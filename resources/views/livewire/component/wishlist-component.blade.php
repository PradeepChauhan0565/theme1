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
            top: -17px;
            left: 50%;
            border: 1px solid #071d49;
            padding: 4px 20px;
            transform: translateX(-50%);
            background-color: #071d49;
        }

        .details {
            display: none;
            transition-delay: 9s;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            transition: all 0.6s ease-out;
            transition-duration: 2s;
        }

        .product:hover .details {
            display: block;
        }
    </style>

    <div class="container">
        <nav aria-label="breadcrumb" class="py-1">
            <ol class="breadcrumb" style="margin-bottom: 0rem; font-size:12px;">
                <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </nav>
        <div class="wishline my-5">
            <span class="wishtag" style="color:#fff;">Your Wishlist</span>
        </div>
        <br>
        <br>
        <br>

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="row mb-5">
            @auth
                @php
                    $wishlistItems = App\Models\Wishlist::where('user_id', auth()->user()->id)->get();
                @endphp
                @if (count($wishlistItems) > 0)
                    @foreach ($wishlistItems as $item)
                        <div class="col-lg-4 ">
                            <div class="position-relative product border">
                                <a href="{{ route('single', [$item->product->slug ?? '']) }}" target="_blank"
                                    style="text-decoration: none;">
                                    <img src="{{ asset('storage/' . $item->product->image_url ?? '') }}" alt=""
                                        style="width: 100%;">
                                    <div class="bg-white  p-2">
                                        <p class="mt-2">{{ $item->product->name ?? '' }} </p>
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                            {{ $item->product->regular_price ?? '' }}
                                        </p>
                                        <div class="text-center "style="background-color: #071d49;"><button
                                                class="p-1 border-0  text-white" style="background-color: #071d49;">Discover
                                                more</button></div>
                                    </div>
                                </a>
                                <div class="position-absolute  text-2xl"
                                    style="right:0px; top:-2px; font-size:24px; z-index:2;">
                                    <button wire:click="removeToWishlist({{ $item->id }})"
                                        class="border-0 px-2 bg-transparent">
                                        <span wire:loading.remove wire:target="removeToWishlist({{ $item->id }})">
                                            <i class="fas fa-times" style="color:red;"></i>
                                        </span>
                                        <span wire:loading wire:target="removeToWishlist({{ $item->id }})">
                                            <div class="spinner-border" role="status" style="font-size:8px;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </span>
                                    </button>
                                </div>
                                {{-- <div class="position-absolute   top-0 left-0">
                                <div class=" details ">
                                    <div class="position-relative">
                                        <div class="productwrapper  transition delay-700 duration-300 ease-in-out">
                                            <div><img src="images/product1.jpg" alt="" style="width: 100%;">
                                            </div>
                                            <div><img src="images/chill2.jpg" alt="" style="width: 100%;">
                                            </div>
                                            <div><img src="images/chill3.jpg" alt="" style="width: 100%;">
                                            </div>
                                            <div><img src="images/chill4.jpg" alt="" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="position-absolute "
                                            style="left:-3px; top: 50%;  transform: translate(-50%);"><a
                                                class=" px-2 py-3" id="next"
                                                style="cursor: pointer; background-color:rgb(226, 230, 230);"><i
                                                    class="fas fa-angle-left"></i></a> </div>
                                        <div class="position-absolute "
                                            style="right:-24px; top: 50%;  transform: translate(-50%);"><a
                                                class=" px-2 py-3" id="prev"
                                                style="cursor: pointer; background-color:rgb(226, 230, 230);"><i
                                                    class="fas fa-angle-right"></i></a> </div>

                                    </div>

                                </div>
                            </div> --}}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center ">
                        <div class="text-center ">
                            <div class="">
                                <img src="images/no-wish.png" alt="" style="width:100%;">
                            </div>
                            <h1 class=" mt-2">Oh ho!</h1>
                            <p class="mt-2 ">Your Wishlist is Empty!</p>
                            <a href="{{ asset('/') }}"><button
                                    class="py-1 px-4 mt-2 border-0"style="background-color: #071d49; color:#fff;">Start
                                    Shopping</button></a>
                        </div>
                    </div>
                @endif
            @endauth

            @guest
                <div class="d-flex justify-content-center ">
                    <div class="text-center ">
                        <div class="">
                            <img src="images/no-wish.png" alt="" style="width:100%;">
                        </div>
                        <h1 class=" mt-2">Oh ho!</h1>
                        <p class="mt-2 ">Your Wishlist is Empty!</p>
                        <a href="{{ asset('/') }}"><button
                                class="py-1 px-4 mt-2 border-0"style="background-color: #071d49; color:#fff;">Start
                                Shopping</button></a>
                    </div>
                </div>
            @endguest

        </div>
    </div>



    {{-- ------------next pre jq-------------------- --}}
    <script>
        $(document).ready(function() {
            $(".productwrapper div").each(function(e) {
                if (e != 0)
                    $(this).hide();
            });

            $("#next").click(function() {
                if ($(".productwrapper div:visible").next().length != 0)
                    $(".productwrapper div:visible").next().show().prev().hide();
                else {
                    $(".productwrapper div:visible").hide();
                    $(".productwrapper div:first").show();
                }
                return false;
            });

            $("#prev").click(function() {
                if ($(".productwrapper div:visible").prev().length != 0)
                    $(".productwrapper div:visible").prev().show().next().hide();
                else {
                    $(".productwrapper div:visible").hide();
                    $(".productwrapper div:last").show();
                }
                return false;
            });
        });
    </script>
</div>
