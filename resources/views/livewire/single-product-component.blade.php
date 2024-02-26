<div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('../src/jquery.exzoom.js') }}"></script>
    <link href="{{ asset('../src/jquery.exzoom.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* ----------------accrdian css------------- */
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #d6c3c3;
        }

        .card {
            border: none;
        }

        table tr td {
            padding: 5px 0;
            font-size: 15px;
        }

        .add_color {
            border: 1px solid var(--default-color);
        }
    </style>
    <div style="background-color: #fff;">
        <div class="container">
            <nav aria-label="breadcrumb" class="py-1">
                <ol class="breadcrumb" style="margin-bottom: 0rem; font-size:12px;">
                    <li class="breadcrumb-item"><a href="{{ asset('/') }}"
                            style="color:var(--default-color);">Home</a></li>
                    @if ($product != null)
                        <li class="breadcrumb-item text-capitalize" aria-current="page"
                            style="color:var(--default-color);">Details / {{ $product->name }}
                        </li>
                    @endif
                </ol>
            </nav>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>


            <div class="row g-lg-5 mt-0">
                <div class="col-lg-6 mt-4">
                    <div class=" position-relative">
                        <div id="colorBody">
                            <div class="exzoom " id="exzoom">
                                <div class="exzoom_img_box " wire:ignore>
                                    <ul class='exzoom_img_ul d-flex' style="padding-left: 0rem;">
                                        @if (count($product->images) > 0)
                                            @foreach ($product->images as $image1)
                                                <li wire:ignore.self class="btnfornext"><img
                                                        src="{{ asset('storage/' . $image1->url) }}"
                                                        style="width: 100%; height:100%;" /></li>

                                                @if ($image1->is_video != null)
                                                    <li class=" product_list_ul"><img
                                                            src="{{ asset('images/play.png') }}"
                                                            style="width: 100%; height:100%;" />
                                                        <div class="bvideo-wrap ">
                                                            <video width="100%" height="100%" poster="" loop
                                                                controls muted autoplay>
                                                                <source
                                                                    src='{{ asset('storage/' . $image1->is_video) }}'
                                                                    type='video/mp4'>
                                                            </video>
                                                        </div>
                                                    </li>
                                                    @php
                                                        break;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif

                                    </ul>
                                    <div class=" exzoom_prev_btn"
                                        style="position:absolute; top:45%; left:-1px; z-index:9; font-size:20px;  cursor:pointer; ">
                                        <div class="zoom_btn">
                                            <i class="fa-solid fa-angle-left"></i>
                                        </div>
                                    </div>
                                    <div class=" exzoom_next_btn"
                                        style="position:absolute; top:45%; right:-1px;z-index:9; font-size:20px;  cursor:pointer; ">
                                        <div class="zoom_btn">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="exzoom_nav"></div>
                                {{-- <p class="exzoom_btn">
                                        <a href="javascript:void(0);" class="exzoom_prev_btn">
                                            &#129168; </a>
                                                <a href="javascript:void(0);" class="exzoom_next_btn"> &#129170; </a>
                                    </p> --}}
                            </div>
                        </div>
                        <div style="position:absolute; top:3px; right:2px; z-index:9;">
                            <div class="position-relative shares">
                                <div onClick="shareFunction()" title="Share">
                                    <i class="fas fa-share-alt share-btn"></i>
                                </div>

                                <div id="share-buttons" style="position:absolute; top:45px; right:-5px; z-index:9;">

                                    <!-- facebook -->
                                    <a class="facebook" target="blank"><i class="fab fa-facebook share-btn"></i></a>

                                    <a class="mail" target="blank"><i class="fa-solid fa-envelope share-btn"></i></a>

                                    <!-- twitter -->
                                    <a class="twitter" target="blank"><i class="fab fa-twitter share-btn"></i></a>

                                    <!-- linkedin -->
                                    <a class="linkedin" target="blank"><i class="fab fa-linkedin share-btn"></i></a>

                                    <!-- reddit -->
                                    <a class="reddit" target="blank"><i class="fab fa-reddit share-btn"></i></a>

                                    <!-- whatsapp-->
                                    <a class="whatsapp" target="blank"><i class="fab fa-whatsapp share-btn"></i></a>

                                    <!-- telegram-->
                                    <a class="telegram" target="blank"><i class="fab fa-telegram share-btn"></i></a>
                                    <a class="pinterest" target="blank"><i class="fab fa-pinterest share-btn"></i></a>

                                </div>
                            </div>
                        </div>
                        @auth
                            @if (App\Models\Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product->id)->exists())
                                <div class="position-absolute  text-2xl"
                                    style="left:2px; top:2px; font-size:28px; z-index:9; ">
                                    <button wire:click="removeToWishlist({{ $product->id }})" title="Remove to wishlist"
                                        class="border-0 px-2 bg-transparent">
                                        <span wire:loading.remove wire:target="removeToWishlist({{ $product->id }})"
                                            style="color:var(--default-color);">
                                            <i class="fas fa-heart"></i>
                                        </span>
                                        <span wire:loading wire:target="removeToWishlist({{ $product->id }})">
                                            <div class="spinner-border" role="status" style="font-size:8px;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </span>
                                    </button>
                                </div>
                            @else
                                <button wire:click="addToWishlist({{ $product->id }})"
                                    class="position-absolute border-0 px-2 bg-transparent  text-2xl "
                                    title="Add to wishlist"
                                    style="cursor:pointer; left:2px; top:2px; font-size:28px;z-index:9;">
                                    <span wire:loading.remove wire:target="addToWishlist({{ $product->id }})"
                                        style="color:var(--default-color);"><i class="far fa-heart"></i></span>
                                    <span wire:loading wire:target="addToWishlist({{ $product->id }})">
                                        <div class="spinner-border" role="status" style="font-size:8px;">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                                </button>
                            @endif
                        @endauth

                        @guest
                            <button wire:click="addToWishlist({{ $product->id }})"
                                class="position-absolute border-0 px-2 bg-transparent  text-2xl " title="Add to wishlist"
                                style="cursor:pointer; left:2px; top:2px; font-size:28px;z-index:9; color:var(--default-color);">
                                <span wire:loading.remove wire:target="addToWishlist({{ $product->id }})"><i
                                        class="far fa-heart"></i></span>
                                <span wire:loading wire:target="addToWishlist({{ $product->id }})">
                                    <div class="spinner-border" role="status" style="font-size:8px;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </span>
                            </button>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="mb-3">
                        <h4 style="color:var(--default-color);">
                            {{ $product->name }}
                        </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3" style="color:var(--default-color);">{{ $product->sku }}</div>
                            <div class="mb-3" style="color:var(--default-color);"><i
                                    class="fa-solid fa-indian-rupee-sign"></i>
                                {{ $product->regular_price }}
                            </div>
                            <div class="mb-3" style="color:var(--default-color);">
                                @php
                                    $reviews = \App\Models\ProductReview::where('product_id', $product->id)
                                        ->orderBy('created_at', 'desc')
                                        ->count();
                                    $scores = \App\Models\ProductReview::where('product_id', $product->id)->sum('score');
                                @endphp
                                @if ($reviews > 0)
                                    @php
                                        $ratings = $scores / $reviews;
                                    @endphp
                                    <div class="d-flex align-items-center">

                                        <div>
                                            @for ($i = 1; $i <= $ratings; $i++)
                                                <span style="font-size:22px;">&#9733;</span>
                                            @endfor
                                        </div>
                                        <a class="mx-2" style="color: var(--default-color);" href="#review">
                                            {{ $reviews }}
                                            Review</a>

                                    </div>
                                @else
                                    <div class="d-flex align-items-center">

                                        <div>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span style="font-size:22px;">&#9734;</span>
                                            @endfor
                                        </div>
                                        <a class="mx-2" style="color: var(--default-color);" href="#review"> No
                                            Review</a>
                                    </div>
                                @endif
                            </div>

                            @if ($product->product_size_id)
                                <div class="mb-3">
                                    Size <select wire:change="ringSizeClick" wire:model="ring_size"
                                        class="px-2 py-1">
                                        <option value="">Select Size</option>
                                        @foreach ($ringSizes as $item)
                                            <option value="{{ $item->id }}"> {{ $item->code }}</option>
                                        @endforeach
                                    </select>
                                    @error('ring_size')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <h6 style="color:var(--default-color);"><i class="fa-solid fa-location-dot"></i> Verify
                                Delivery Pincode</h6>
                            <div class="d-flex">
                                <input class="w-100 px-2" type="number" wire:model="pincode"
                                    placeholder="Enter your Pincode" pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if(this.value.length==6) return false;">
                                <button class="px-2" wire:click="pincode()"
                                    style="background-color:var(--default-color); color:#fff;">Verify</button>
                            </div>
                            @error('pincode')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div>
                                @if (session()->has('verify'))
                                    <div class="alert alert-success">
                                        {{ session('verify') }}
                                    </div>
                                @endif
                                @if (session()->has('notverify'))
                                    <div class="alert alert-danger">
                                        {{ session('notverify') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex my-4">

                        @php
                            $color = [];
                            foreach ($product->images as $item) {
                                $color[] = $item->image_color_id;
                            }
                            $colors = array_unique($color);
                        @endphp
                        @if (count($colors) > 0)
                            @foreach ($colors as $item)
                                @if ($item == 'y')
                                    <div id="current_y" onclick="productColor('{{ $item }}')"
                                        style="padding: 5px;  height: 35px; width: 35px; text-align: center; margin-right: 10px;cursor: pointer; 
                                    @if ($item == 'y') background-color:#e0c689; @endif">
                                    </div>
                                @elseif($item == 'w')
                                    <div id="current_w" onclick="productColor('{{ $item }}')"
                                        style="padding: 5px;  height: 35px; width: 35px; text-align: center; margin-right: 10px;cursor: pointer; 
                                     @if ($item == 'w') background-color:#DEDEDE; @endif ">
                                    </div>
                                @else
                                    <div id="current_r" onclick="productColor('{{ $item }}')"
                                        style="padding: 5px;  height: 35px; width: 35px; text-align: center; margin-right: 10px;cursor: pointer; 
                                     @if ($item == 'r') background-color:#F0BD9E; @endif ">
                                    </div>
                                @endif
                                {{-- <button id="current_color" onclick="productColor('{{ $item }}')"
                                    style="padding: 5px;  height: 35px; width: 35px; text-align: center; margin-right: 10px; 
                                    @if ($item == 'y') background-color:#e0c689; @endif @if ($item == 'w') background-color:#DEDEDE; @endif
                                @if ($item == 'r') background-color:#F0BD9E; @endif">
                                </button> --}}
                            @endforeach
                        @endif
                        <input type="hidden" value="{{ $product->id }}" id="product_id">
                        <input type="hidden" value="{{ asset('image') }}" id="url">
                    </div>
                    <div class="mb-3">
                        {{ $product->short_desc }}
                    </div>
                    <div class="mb-3">
                        <button wire:click="addToCart({{ $product->id }})"
                            class="py-2 text-center w-100 border-0 rounded"
                            style="background-color: var(--default-color);">
                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})"
                                style="background-color: var(--default-color);border:none;border-radius:5px; font-size:22px; color:#fff;">
                                Add to cart
                            </span>
                            <span wire:loading wire:target="addToCart({{ $product->id }})">
                                <span class="spinner-border" role="status" style="font-size:8px;  color:#fff;">
                                    <span class="sr-only">Loading...</span>
                                </span>
                            </span>
                        </button>
                    </div>

                    @if ($product->long_desc)
                        <h6>Description</h6>
                        <div>
                            {{ $product->long_desc }}
                        </div>
                    @endif
                </div>
            </div>

            @php
                $metal_Price = 0;
                $diamond_Price = 0;
                $colorStone_Price = 0;
                $total_product_wt = 0;
                $matal_wt = 0;
                $total_diamond_wt = 0;
                $colorStone_wt = 0;
            @endphp
            @if (count($product->materials->where('material_type_id', 3)) > 0)
                @foreach ($product->materials->where('material_type_id', 3) as $diamonds)
                    @php
                        $diamond_Price = $diamonds->qty * $diamonds->amount;
                        $total_diamond_wt = $diamonds->qty * $diamonds->weight;
                    @endphp
                @endforeach
            @endif
            @if (count($product->materials->where('material_type_id', 2)) > 0)
                @foreach ($product->materials->where('material_type_id', 2) as $metal)
                    @php
                        $metal_Price = $metal->amount;
                        $matal_wt = $metal->weight;
                    @endphp
                @endforeach
            @endif
            @if (count($product->materials->where('material_type_id', 4)) > 0)
                @foreach ($product->materials->where('material_type_id', 4) as $colorStone)
                    @php
                        $colorStone_Price = $colorStone->amount;
                        $colorStone_wt = $colorStone->weight;
                    @endphp
                @endforeach
            @endif
            @php
                $total_product_wt = $matal_wt + $total_diamond_wt + $colorStone_wt;

            @endphp

            <div class="row g-lg-5 py-5">
                <div class="col-lg-4 mt-4">
                    <img src="{{ asset('images/single -pages-image.jpg') }}" alt="" style="width:100%;">
                </div>
                <div class="col-lg-8  mt-4">
                    <div class="border">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link accordion-title" data-toggle="collapse" href="#collapseOne"
                                        style="color:var(--default-color); text-decoration:none;">
                                        PRODUCT DETAILS
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse show collapseborder">
                                    {{-- data-parent="#accordion"  add in top --}}
                                    <div class="card-body">
                                        <table class="w-100">
                                            <tr>
                                                <td>Product SKU</td>
                                                <td class="text-end">{{ $product->sku }}</td>
                                            </tr>
                                            <tr>
                                                <td>Product Weight </td>
                                                <td class="text-end">{{ $total_product_wt }} gram</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @if (count($product->materials->where('material_type_id', 3)) > 0)
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                            href="#collapseTwo"
                                            style="color:var(--default-color); text-decoration:none;">
                                            DIAMOND DETAILS
                                        </a>
                                    </div>

                                    <div id="collapseTwo" class="collapse collapseborder">
                                        <div class="card-body">
                                            <table class="w-100">
                                                @foreach ($product->materials->where('material_type_id', 3) as $diamonds)
                                                    <tr>
                                                        <td>Total Weight </td>
                                                        <td class="text-end">
                                                            {{ $diamonds->qty * $diamonds->weight }}
                                                            Ct
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Diamonds </td>
                                                        <td class="text-end">{{ $diamonds->qty }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Quality </td>
                                                        <td class="text-end">
                                                            {{ $diamonds->diadondQuality->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Color </td>
                                                        <td class="text-end">
                                                            {{ $diamonds->diadondColor->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shape </td>
                                                        <td class="text-end">
                                                            {{ $diamonds->diamondShape->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Size </td>
                                                        <td class="text-end">
                                                            {{ $diamonds->diamondSize->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Setting Type </td>
                                                        <td class="text-end">
                                                            {{ $diamonds->diamondSetting->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (count($product->materials->where('material_type_id', 4)) > 0)
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                            href="#collapseFive"
                                            style="color:var(--default-color); text-decoration:none;">
                                            COLOR STONE DETAILS
                                        </a>
                                    </div>

                                    <div id="collapseFive" class="collapse collapseborder">
                                        <div class="card-body">
                                            <table class="w-100">
                                                @foreach ($product->materials->where('material_type_id', 4) as $colorStone)
                                                    <tr>
                                                        <td>Total Weight </td>
                                                        <td class="text-end">
                                                            {{ $colorStone->qty * $colorStone->weight }}
                                                            Ct
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ColorStone Color</td>
                                                        <td class="text-end">
                                                            {{ $colorStone->colorStoneColor->code ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total colorStone </td>
                                                        <td class="text-end">{{ $colorStone->qty }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shape </td>
                                                        <td class="text-end">
                                                            {{ $colorStone->colorStoneShape->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Size </td>
                                                        <td class="text-end">
                                                            {{ $colorStone->colorStoneSize->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ColorStone Name </td>
                                                        <td class="text-end">
                                                            {{ $colorStone->colorStoneName->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Setting Type </td>
                                                        <td class="text-end">
                                                            {{ $colorStone->colorStoneSetting->code ?? '' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count($product->materials->where('material_type_id', 2)) > 0)
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                            href="#collapseThree"
                                            style="color:var(--default-color); text-decoration:none;">
                                            METAL DETAILS
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse collapseborder">
                                        <div class="card-body">
                                            <table class="w-100">
                                                @foreach ($product->materials->where('material_type_id', 2) as $metal)
                                                    <tr>
                                                        <td>Metal Type </td>
                                                        <td class="text-end">{{ $metal->metalPurity->code ?? '' }}
                                                            {{ $metal->metalColor->code ?? '' }}
                                                            {{ $metal->metalType->code ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Weight </td>
                                                        <td class="text-end">{{ $metal->weight }} gram</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                        href="#collapseFour" style="color:var(--default-color); text-decoration:none;">
                                        PRICE
                                    </a>
                                </div>
                                <div id="collapseFour" class="collapse collapseborder">
                                    <div class="card-body">
                                        <table class="w-100">
                                            @if ($metal_Price > 0)
                                                <tr>
                                                    <td>Metal Price </td>
                                                    <td class="text-end"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ $metal_Price }}</td>
                                                </tr>
                                            @endif
                                            @if ($diamond_Price > 0)
                                                <tr>
                                                    <td>Diamond Price</td>
                                                    <td class="text-end"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ $diamond_Price }}</td>
                                                </tr>
                                            @endif
                                            @if ($colorStone_Price > 0)
                                                <tr>
                                                    <td>Color Stone Price</td>
                                                    <td class="text-end"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ $colorStone_Price }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-2">
                <button id="review" wire:click="openModal({{ $product->id }})"
                    style="background-color: var(--default-color); color:white; padding:8px 20px; border-radius:5px; border:none;">Write
                    A Review</button>
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session('msg') }}
                    </div>
                @endif
                <hr>


                <!-- Modal -->
                <div wire:ignore.self class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">WRITE A REVIEW</h5>
                                <button wire:click="closeModal()" type="button" class="close px-2 border"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row ">
                                    <div class="col-12 ">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>Rating<span style="font-size:24px;">*</span></div>
                                                <div class="rating">
                                                    <input type="radio" id="star5" wire:model="rating"
                                                        value="5" /><label for="star5"></label>
                                                    <input type="radio" id="star4" wire:model="rating"
                                                        value="4" /><label for="star4"></label>
                                                    <input type="radio" id="star3" wire:model="rating"
                                                        value="3" /><label for="star3"></label>
                                                    <input type="radio" id="star2" wire:model="rating"
                                                        value="2" /><label for="star2"></label>
                                                    <input type="radio" id="star1" wire:model="rating"
                                                        value="1" /><label for="star1"></label>
                                                </div>
                                                @error('rating')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <lable>Add a title <span style="font-size:24px;">*</span>
                                                </lable>
                                                <br>
                                                <input class=" mb-2 rounded border py-1 px-2 w-100" type="text"
                                                    wire:model="title" required><br>
                                                @error('title')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <lable>Add a review <span style="font-size:24px;">*</span> </lable><br>
                                        <textarea class=" mb-2 rounded border py-1 px-2 w-100" wire:model="review" cols="30" rows="4" required></textarea>
                                        @error('review')
                                            <div class="alert alert-danger py-1">{{ $message }}</div>
                                        @enderror
                                        <lable> Add a photo </lable>
                                        <input wire:model="image" class=" mb-2 rounded border py-1 px-4 w-100"
                                            type="file">
                                        <div wire:loading wire:target="image"><i
                                                class="fa fa-spinner fa-spin mt-2 ml-2"></i>Uploading...</div>

                                        @if ($image)
                                            Photo Preview:

                                            <div class="position-relative m-2">
                                                <img style="width:100px" src="{{ $image->temporaryUrl() }}">

                                                <div class="position-absolute" style="top:2px; right:0px;"
                                                    title="Remove" wire:click.prevent="removepreview()"><i
                                                        class="fas fa-times " style=" cursor:pointer; color:red"></i>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <lable>Your name<span style="font-size:24px;">*</span> </lable>
                                                <input wire:model="user_name"
                                                    class=" mb-2 rounded border py-1 px-2 w-100 text-capitalize"
                                                    type="text" required>
                                                @error('user_name')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <lable> Email <span style="font-size:24px;">*</span></lable>
                                                <input wire:model="user_email"
                                                    class="rounded border mb-2 py-1 px-2 w-100" type="email"
                                                    required>
                                                @error('user_email')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button wire:click="closeModal()" type="button" class="btn btn-secondary mx-4"
                                        data-dismiss="modal">Close</button>
                                    <button wire:click="writeReview()"
                                        style="background-color:var(--default-color); color:white; padding:8px 20px;border:none;border-radius:5px; ">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $productReview = \App\Models\ProductReview::where('product_id', $product->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
                $liks = \App\Models\ReviewLike::all();
            @endphp
            <h3> Reviews ({{ count($productReview) }})</h3>
            @foreach ($productReview as $item)
                <div class="d-flex border-bottom mb-4">
                    <div>
                        <div class="text-uppercase"
                            style="width:40px; height:40px; border-radius:50%; background-color:var(--default-color); color:#fff; line-height:40px; text-align:center; margin-right:10px;">
                            {{ substr($item->user_name, 0, 1) }}
                        </div>
                    </div>

                    <div class="w-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="text-capitalize">{{ $item->user_name }}</h5>
                            </div>
                            <div style="color: #bbb8b8">{{ $item->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="d-flex">
                            @for ($i = 1; $i <= $item->score; $i++)
                                <span style="font-size:22px;">&#9733;</span>
                            @endfor
                        </div>
                        <h6>{{ $item->title }}</h6>
                        <p style="color: #bbb8b8">{{ $item->review }}</p>
                        <img src="{{ asset('storage/ReviewImage/' . $item->image) }}" alt=""
                            style="width: 200px;" />
                        <div class="d-flex align-items-center justify-content-end w-100">
                            <div class="d-flex align-items-center">
                                <div class="mx-2 d-flex align-items-center">
                                    <button class="border-0 bg-transparent"
                                        wire:click="isLike('like',{{ $item->id }})" class="mx-1">
                                        <i class="like_btn fas fa-thumbs-up"></i>
                                    </button>&nbsp;
                                    <span>{{ count($liks->where('likes', 'like')->where('review_id', $item->id)) }}</span>
                                </div>
                            </div>

                            <div class="mx-2 d-flex align-items-center">
                                <button class="border-0 bg-transparent"
                                    wire:click="isDislike('dislike',{{ $item->id }})" class="mx-1 ">
                                    <i class="fas fa-thumbs-down pt-2"></i>
                                </button>&nbsp;
                                <span>{{ count($liks->where('dislikes', 'dislike')->where('review_id', $item->id)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>


@push('scripts')
    <script>
        function productColor(colour) {
            var p_id = $('#product_id').val();
            var color_id = colour;

            var url = $('#url').val();
            $.ajax({
                url: url + "/" + p_id + "/" + color_id,
                data: "",
                dataType: "html",
                success: function(strdata) {
                    console.log(strdata);
                    $('#colorBody').html(strdata)
                    // alert('success')
                }
            });
            if (color_id == "y") {
                $('#current_y').addClass("add_color")
                $('#current_w').removeClass("add_color")
                $('#current_r').removeClass("add_color")
                // $('#current_color1').text(" Yellow Gold")
                // $('#current_color').css('color', '#EFD9A7')
            }
            if (color_id == "w") {
                $('#current_w').addClass("add_color")
                $('#current_y').removeClass("add_color")
                $('#current_r').removeClass("add_color")
            }
            if (color_id == "r") {
                $('#current_r').addClass("add_color")
                $('#current_y').removeClass("add_color")
                $('#current_w').removeClass("add_color")
            }
        }
    </script>
@endpush



<script>
    const link = encodeURI(window.location.href);
    const msg = encodeURIComponent('Hey, I found this product');
    const title = encodeURIComponent('');

    const fb = document.querySelector('.facebook');
    fb.href = `https://www.facebook.com/share.php?u=${link}`;

    const mail = document.querySelector('.mail');
    mail.href = ` mailto:?subject= ${link}`;

    const twitter = document.querySelector('.twitter');
    twitter.href = `http://twitter.com/share?&url=${link}&text=${msg}&hashtags=javascript,programming`;

    const linkedIn = document.querySelector('.linkedin');
    linkedIn.href = `https://www.linkedin.com/sharing/share-offsite/?url=${link}`;

    const reddit = document.querySelector('.reddit');
    reddit.href = `http://www.reddit.com/submit?url=${link}&title=${title}`;

    const whatsapp = document.querySelector('.whatsapp');
    whatsapp.href = `https://api.whatsapp.com/send?text=${msg}: ${link}`;

    const telegram = document.querySelector('.telegram');
    telegram.href = `https://telegram.me/share/url?url=${link}&text=${msg}`;
    const pinterest = document.querySelector('.pinterest');
    pinterest.href = `https://www.pinterest.com/pin/create/button/?url=${link}&text=${msg}`;


    function shareFunction() {

        var x = document.getElementById("share-buttons");

        if (x.style.display == "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>
<script type="text/javascript">
    $('.container').imagesLoaded(function() {
        $("#exzoom").exzoom({
            autoPlay: true,
        });
        $("#exzoom").removeClass('hidden')
    });
</script>

<!-- Reviews end -->
<script>
    $(document).ready(function() {
        $("#reviewbtn").click(function() {
            $(".reviewform").toggle();
        });
    });


    const allStars = document.querySelectorAll('.star');
    allStars.forEach((star, i) => {
        star.onclick = function() {
            let current_star_level = i + 1;
            allStars.forEach((star, j) => {
                if (current_star_level >= j + 1) {
                    star.innerHTML = '&#9733';
                } else {
                    star.innerHTML = '&#9734';
                }
            })
        }
    });
</script>
<script>
    $(document).ready(function() {
        window.addEventListener('livewireOpenModal', event => {
            $("#exampleModalLong").modal('show');
        })
        window.addEventListener('livewireCloseModal', event => {
            $("#exampleModalLong").modal('hide');

        })
    });
</script>

</div>
