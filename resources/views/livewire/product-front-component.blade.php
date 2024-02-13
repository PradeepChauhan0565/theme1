<div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <div>
        <img src="{{ asset('images/2.png') }}" alt="" style="width:100%;">
    </div>


    <div class="mx-auto " style="width:90%;padding-bottom: 30px; padding-top:20px;">
        <div class="row mb-4 g-3 ">
            <div class="col-lg-10">
                <div class="d-none d-lg-block">
                    <h6 class="text-xl mb-3">FILTER BY</h6>

                    <div class="row g-2 ">
                        <div class="col-lg-3">
                            <div class="dropdown">
                                <button class="btn w-100 btn-secondary dropdown-toggle" type="button"
                                    style="text-align: left;" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Price
                                </button>
                                <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton">
                                    <div>
                                        {{-- 
                                                <div class="form-check">
                                                    <input wire:change="filter" class="form-check-input" type="checkbox"
                                                        wire:model="priceAll" value="0-10000000" id="priceAll">
                                                    <label class="form-check-label" for="priceAll">
                                                        All
                                                    </label>
                                                </div> --}}

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="price.1"
                                                value="0-10000" id="customCheckPrice1">
                                            <label class="form-check-label" for="customCheckPrice1">
                                                Below - <i class="fa-solid fa-indian-rupee-sign"></i> 10000
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="price.2"
                                                value="10000-20000" id="customCheckPrice2">
                                            <label class="form-check-label" for="customCheckPrice2">
                                                <i class="fa-solid fa-indian-rupee-sign"></i> 10000 - <i
                                                    class="fa-solid fa-indian-rupee-sign"></i> 20000
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="price.3"
                                                value="20000-30000" id="customCheckPrice3">
                                            <label class="form-check-label" for="customCheckPrice3">
                                                <i class="fa-solid fa-indian-rupee-sign"></i> 20000 - <i
                                                    class="fa-solid fa-indian-rupee-sign"></i> 30000
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="price.4"
                                                value="30000-40000" id="customCheckPrice4">
                                            <label class="form-check-label" for="customCheckPrice4">
                                                <i class="fa-solid fa-indian-rupee-sign"></i> 30000 - <i
                                                    class="fa-solid fa-indian-rupee-sign"></i> 40000
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="price.5"
                                                value="40000-10000000" id="customCheckPrice5">
                                            <label class="form-check-label" for="customCheckPrice5">
                                                <i class="fa-solid fa-indian-rupee-sign"></i> 40000 - And Above
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="dropdown ">
                                <button class="btn w-100 btn-secondary dropdown-toggle" type="button"
                                    style="text-align: left;" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Metal
                                </button>
                                <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton">
                                    @foreach ($metal as $metal_key => $metal_item)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:change="filter"
                                                wire:model="metalType.{{ $metal_key }}" value="{{ $metal_key }}"
                                                id="flexCheckDefault{{ $metal_key }}">
                                            <label class="form-check-label" for="flexCheckDefault{{ $metal_key }}">
                                                {{ $metal_item }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="dropdown ">
                                <button class="btn w-100 btn-secondary dropdown-toggle" type="button"
                                    style="text-align: left;" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Gold Purity
                                </button>
                                <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton">
                                    @foreach ($metalPurities as $p_key => $item)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:change="filter"
                                                wire:model="purities.{{ $p_key }}" value="{{ $p_key }}"
                                                id="flexCheckDefaultt{{ $p_key }}">
                                            <label class="form-check-label"
                                                for="flexCheckDefaultt{{ $p_key }}">
                                                {{ $item }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">

                            <div class="dropdown " data-bs-toggle="offcanvas" data-bs-target="#filterDrawer"
                                aria-controls="filterDrawer">
                                <button class="btn w-100 btn-secondary " type="button" style="text-align: left;"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    More Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="align-items-center py-1" style="display:flex; flex-wrap: wrap;">
                    <div style="font-size:12px;">Filtered By : </div>
                    @php
                        $f_ctr = 0;
                    @endphp
                    {{-- @foreach ($categories as $f_key => $fc)
                                @php
                                    if ($fc == false) {
                                        continue;
                                    }
                                    $f_ctr++;
                                @endphp
                                <button wire:click="resetFilter({{ $f_key }},'category')"
                                    class="border px-2 mx-2 d-flex align-items-center"
                                    style="font-size:12px; color:#071d49;">{{ $f_sub_categories[$f_key] }} <span
                                        style="font-size:12px; padding-left:4px;color:red;">&#10005;</span></button>
                            @endforeach --}}

                    {{-- @foreach ($stoneShapes as $shape_key => $shape)
                                @php
                                    if (!$shape) {
                                        continue;
                                    }
                                    $f_ctr++;
                                @endphp
                                <button wire:click="resetFilter({{ $shape_key }},'shape')"
                                    class="border px-2 mx-2 d-flex align-items-center"
                                    style="font-size:12px; color:#071d49;">
                                    {{ $dstoneShapes[$shape_key] }}
                                    <span style="font-size:12px; padding-left:4px;color:red;">&#10005;</span>
                                </button>
                            @endforeach --}}
                    @if ($price)
                        @foreach ($price as $price_key => $price)
                            @php
                                if (!$price) {
                                    continue;
                                }
                                $f_ctr++;
                            @endphp
                            <button wire:click="resetFilter({{ $price_key }},'price')"
                                class="border px-2 m-2 d-flex align-items-center"
                                style="font-size:14px; color:#071d49;">
                                {{ $price }}
                                <span style="font-size:12px; padding-left:4px;color:red;">&#10005;</span>
                            </button>
                        @endforeach
                    @endif

                    @foreach ($metalType as $mtl_key => $mtl)
                        @php
                            if (!$mtl) {
                                continue;
                            }
                            $f_ctr++;
                        @endphp
                        <button wire:click="resetFilter({{ $mtl_key }},'metal')"
                            class="border px-2 m-2 d-flex align-items-center" style="font-size:12px; color:#071d49;">
                            {{ $metal[$mtl_key] }}
                            <span style="font-size:12px; padding-left:4px;color:red;">&#10005;</span>
                        </button>
                    @endforeach

                    @foreach ($purities as $prty_key => $prty)
                        @php
                            if (!$prty) {
                                continue;
                            }
                            $f_ctr++;
                        @endphp
                        <button wire:click="resetFilter({{ $prty_key }},'kt')"
                            class="border px-2 m-2 d-flex align-items-center" style="font-size:12px; color:#071d49;">
                            {{ $metalPurities[$prty_key] }}
                            <span style="font-size:12px; padding-left:4px;color:red;">&#10005;</span>
                        </button>
                    @endforeach
                    @php
                        $color_type_array = ['w' => 'White', 'y' => 'Yellow', 'r' => 'Rose'];
                    @endphp
                    @if ($colorType)
                        <button wire:click="resetFilter('{{ $colorType }}','metal_color')"
                            class="border px-2 m-2 d-flex align-items-center" style="font-size:14px; color:#071d49;">
                            {{ $color_type_array[$colorType] ?? '' }}
                            <span style="font-size:12px; padding-left:4px;color:red;">&#10005;</span>
                        </button>
                    @endif

                    {{-- @foreach ($diamond as $diamond_key => $dia)
                                @php
                                    if (!$dia) {
                                        continue;
                                    }
                                    $f_ctr++;
                                @endphp
                                <button wire:click="resetFilter({{ $diamond_key }},'dia')"
                                    class="border px-2 mx-2 d-flex align-items-center"
                                    style="font-size:12px; color:#071d49;">
                                    {{ $dia }}
                                    <span style="font-size:12px; padding-left:4px;color:red;">&#10005;</span>
                                </button>
                            @endforeach --}}
                    {{-- <button class="border px-2 mx-2 d-flex align-items-center"
                                style="font-size:12px; color:#071d49;">
                               
                                <span style="font-size:12px; padding-left:4px;color:red;">&#10005;</span>
                            </button> --}}
                    @if ($f_ctr > 1)
                        <button class="border px-2 m-2  d-flex align-items-center"
                            style="font-size:12px; color:#071d49;" wire:click="resetFilterAll()">Clear all
                            <span style="font-size:12px; padding-left:4px; color:red;">&#10005;</span></button>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 d-none d-lg-block">
                <h6 class="text-xl mb-3 ">SORT BY</h6>
                <div class="dropdown">
                    <select name="" wire:model="sortBy" wire:change="filter" class="btn w-100 btn-secondary "
                        style="text-align: left;">
                        <option value="" style="color: #fff;"> Sort by</option>
                        <option value="highest" style="color: #fff;">High to Low</option>
                        <option value="lowest" style="color: #fff;">Low to High</option>
                        <option value="newToOld" style="color: #fff;">New to Old</option>
                        <option value="oldToNew" style="color: #fff;">Old to New</option>
                        <option value="aToZ" style="color: #fff;">A to Z Alphabeticaly </option>
                        <option value="zToA" style="color: #fff;">Z to A Alphabeticaly </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row position-relative g-4">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div style="position:absolute; top: 50%;  left: 50%;  transform: translate(-50%, -50%); z-index:999999;"
                class="text-center" wire:loading>
                <div>
                    <img src="{{ asset('images/loading.gif') }}" style="width:50px; height:50px;">
                </div>
            </div>
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 g-4">
                        <div class="position-relative product border">
                            <a wire:click="recentView({{ $product->id }})"
                                href="{{ route('single', [$product->slug]) }}" target="_blank"
                                style="text-decoration: none;">
                                @if (empty($product->image_url))
                                    <img src="{{ asset('images/noimage.jpg') }}" alt=""
                                        style="width: 100%;">
                                @else
                                    <img src="{{ asset('storage/' . $product->image_url) }}" alt=""
                                        style="width: 100%;">
                                @endif

                                <div class="bg-white text-black p-2">
                                    <p>{{ $product->name }} </p>
                                    <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $product->regular_price }}</p>
                                    <div class="text-center "style="background-color: #071d49;"><button
                                            class="p-1 border-0  text-white"
                                            style="background-color: #071d49;">Discover
                                            more</button></div>
                                </div>
                            </a>
                            {{-- <div class="position-absolute   top-0 left-0">
                                <div class=" details ">
                                    <div class="position-relative">
                                        <div class="productwrapper  transition delay-700 duration-300 ease-in-out">
                                            <div><img src="{{ asset('images/new_ring.png') }}" alt=""
                                                    style="width: 100%;"> </div>

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

                            @auth
                                @if (App\Models\Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product->id)->exists())
                                    <div class="position-absolute  text-2xl"
                                        style="left:2px; top:2px; font-size:28px; z-index:2;">
                                        <button wire:click="removeToWishlist({{ $product->id }})"
                                            title="Remove to wishlist" class="border-0 px-2 bg-transparent">
                                            <span wire:loading.remove wire:target="removeToWishlist({{ $product->id }})">
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
                                        style="cursor:pointer; left:2px; top:2px; font-size:28px;z-index:2;">
                                        <span wire:loading.remove wire:target="addToWishlist({{ $product->id }})"><i
                                                class="far fa-heart"></i></span>
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
                                    class="position-absolute border-0 px-2 bg-transparent  text-2xl "
                                    title="Add to wishlist"
                                    style="cursor:pointer; left:2px; top:2px; font-size:28px;z-index:2;">
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
                @endforeach
            @else
                {{-- <div class="relative product">
                <img src="images/chill1.jpg" alt="" style="width: 100%;">
                <div class="absolute border border-black z-10 top-0 left-0">
                    <div class="grid-cols-4 details">
                        <div><img src="images/product1.jpg" alt="" style="width: 100%;"> </div>
                        <div class="bg-white p-2">
                            <p class="pb-2">Jewellery-dropdown-panel </p>
                            <p class="pb-2">Rs.18000</p>
                            <div class="text-center  text-white bg-black"><button class="p-1">Discover more</button></div>
                        </div>                        
                    </div>              
                </div>
            </div>   --}}
                <div class="text-center">
                    <img src="{{ asset('images/product not found.jpg') }}" alt="" style="width:200px;">
                </div>

            @endif


        </div>
        <div class="d-flex justify-content-end mt-4">
            {{ $products->links() }}
        </div>
        <div class="ft-toolbar d-lg-none">
            <div class="d-flex justify-content-between ">
                <div class="py-2 col-6 d-flex justify-content-center align-items-center " data-bs-toggle="offcanvas"
                    data-bs-target="#filterDrawer" aria-controls="filterDrawer"style="cursor: pointer;">

                    <i class="fa-solid fa-filter mx-1"></i>FILTER

                </div>
                <div class=" col-6 d-flex justify-content-center align-items-center" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom"style="cursor: pointer;"><i
                        class="fa-solid fa-sort mx-1"></i>SORT
                    BY
                </div>
            </div>
        </div>



        <div wire:ignore class="offcanvas offcanvas-start" tabindex="-1" id="filterDrawer"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">FILTER BY</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link accordion-title" data-toggle="collapse" href="#collapseOne"
                                style="color:#071d49; text-decoration:none;">
                                PRICE
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show collapseborder" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="price.1"
                                        value="0-10000" id="customCheckPrice1">
                                    <label class="form-check-label" for="customCheckPrice1">
                                        Below - <i class="fa-solid fa-indian-rupee-sign"></i> 10000
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="price.2"
                                        value="10000-20000" id="customCheckPrice2">
                                    <label class="form-check-label" for="customCheckPrice2">
                                        <i class="fa-solid fa-indian-rupee-sign"></i> 10000 - <i
                                            class="fa-solid fa-indian-rupee-sign"></i> 20000
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="price.3"
                                        value="20000-30000" id="customCheckPrice3">
                                    <label class="form-check-label" for="customCheckPrice3">
                                        <i class="fa-solid fa-indian-rupee-sign"></i> 20000 - <i
                                            class="fa-solid fa-indian-rupee-sign"></i> 30000
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="price.4"
                                        value="30000-40000" id="customCheckPrice4">
                                    <label class="form-check-label" for="customCheckPrice4">
                                        <i class="fa-solid fa-indian-rupee-sign"></i> 30000 - <i
                                            class="fa-solid fa-indian-rupee-sign"></i> 40000
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="price.5"
                                        value="40000-10000000" id="customCheckPrice5">
                                    <label class="form-check-label" for="customCheckPrice5">
                                        <i class="fa-solid fa-indian-rupee-sign"></i> 40000 - And Above
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseTwo"
                                style="color:#071d49; text-decoration:none;">
                                PRODUCT TYPE
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse collapseborder" data-parent="#accordion">
                            <div class="card-body">
                                @if ($category)
                                    <div class="sidebar-single" style="padding-top: 12px">
                                        <div class="sidebar-body">
                                            <ul class="checkbox-container categories-list">
                                                @foreach ($category->categoryTypes as $item)
                                                    <h6 class="mb-3" style="cursor: pointer"
                                                        wire:click="showCategory({{ $item->id }})">
                                                        {{ $item->name }}</h6>
                                                    @foreach ($item->subCategory as $sb)
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                wire:model="categories.{{ $sb->id }}"
                                                                wire:change="filter" class="custom-control-input"
                                                                id="flexCheckCategory{{ $sb->id }}"
                                                                name="category" value="{{ $sb->id }}">

                                                            <label class="form-check-label"
                                                                for="flexCheckCategory{{ $sb->id }}">
                                                                {{ $sb->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                href="#collapseThree" style="color:#071d49; text-decoration:none;">
                                METAL
                            </a>
                        </div>
                        <div id="collapseThree" class="collapse collapseborder" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($metal as $metal_key => $metal_item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:change="filter"
                                            wire:model="metalType.{{ $metal_key }}" value="{{ $metal_key }}"
                                            id="flexCheckDefault{{ $metal_key }}">
                                        <label class="form-check-label" for="flexCheckDefault{{ $metal_key }}">
                                            {{ $metal_item }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                href="#collapseFour" style="color:#071d49; text-decoration:none;">
                                METAL COLOR
                            </a>
                        </div>
                        <div id="collapseFour" class="collapse collapseborder" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:change="filter"
                                        wire:model="colorType" value="y" name="metalColor"
                                        name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Yellow
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:change="filter"
                                        wire:model="colorType" value="w" name="metalColor"
                                        name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        White
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:change="filter"
                                        wire:model="colorType" value="r" name="metalColor"
                                        name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Rose
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                href="#collapseFive" style="color:#071d49; text-decoration:none;">
                                GOLD PURITY
                            </a>
                        </div>
                        <div id="collapseFive" class="collapse collapseborder" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($metalPurities as $p_key => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:change="filter"
                                            wire:model="purities.{{ $p_key }}" value="{{ $p_key }}"
                                            id="flexCheckDefaultt{{ $p_key }}">
                                        <label class="form-check-label" for="flexCheckDefaultt{{ $p_key }}">
                                            {{ $item }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseSix"
                                style="color:#071d49; text-decoration:none;">
                                DIAMOND
                            </a>
                        </div>
                        <div id="collapseSix" class="collapse  collapseborder" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="diamond.1"
                                        value="0-1" id="customCheckdiamond1">
                                    <label class="form-check-label" for="customCheckdiamond1">
                                        Below - 1
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="diamond.2"
                                        value="2-3" id="customCheckdiamond2">
                                    <label class="form-check-label" for="customCheckdiamond2">
                                        2 - 3
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="diamond.3"
                                        value="4-5" id="customCheckdiamond3">
                                    <label class="form-check-label" for="customCheckdiamond3">
                                        4 - 5
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="diamond.4"
                                        value="6-7" id="customCheckdiamond4">
                                    <label class="form-check-label" for="customCheckdiamond4">
                                        6 - 7
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="diamond.5"
                                        value="8-100" id="customCheckdiamond5">
                                    <label class="form-check-label" for="customCheckdiamond5">
                                        8 - And Above
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                href="#collapseSeven" style="color:#071d49; text-decoration:none;">
                                STONE SHAPE
                            </a>
                        </div>
                        <div id="collapseSeven" class="collapse collapseborder" data-parent="#accordion">
                            <div class="card-body">
                                @foreach ($dstoneShapes as $p_key => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:change="filter"
                                            wire:model="stoneShapes.{{ $p_key }}" value="{{ $p_key }}"
                                            id="flexCheckShape{{ $p_key }}">
                                        <label class="form-check-label" for="flexCheckShape{{ $p_key }}">
                                            {{ $item }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="row g-2">
                        <div class="col-6">
                            @if ($f_ctr > 1)
                                <button data-bs-dismiss="offcanvas" aria-label="Close" type="button"
                                    class="btn bg-secondary text-white w-100" wire:click="resetFilterAll()">Clear
                                    all
                                </button>
                            @endif
                        </div>
                        <div class="col-6">
                            <button data-bs-dismiss="offcanvas" aria-label="Close" type="button"
                                class="btn btn-primary w-100" style="background-color: #071d49;color:#fff;">Show
                                Results</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-bottom d-lg-none" tabindex="-1" id="offcanvasBottom"
            aria-labelledby="offcanvasBottomLabel" wire:ignore>
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Sort By</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <select wire:ignore.self name="" wire:model="sortBy" wire:change="filter"
                    class="btn w-100 btn-secondary " style="text-align: left;">
                    <option value="" style="color: #fff;"> Sort by</option>
                    <option value="highest" style="color: #fff;">High to Low</option>
                    <option value="lowest" style="color: #fff;">Low to High</option>
                    <option value="newToOld" style="color: #fff;">New to Old</option>
                    <option value="oldToNew" style="color: #fff;">Old to New</option>
                    <option value="aToZ" style="color: #fff;">A to Z Alphabeticaly </option>
                    <option value="zToA" style="color: #fff;">Z to A Alphabeticaly </option>
                </select>
                <div class="d-flex justify-content-end mt-5">
                    <button data-bs-dismiss="offcanvas" aria-label="Close" type="button"
                        class="btn btn-primary w-50" style="background-color: #071d49;color:#fff;">Show
                        Results</button>
                </div>
            </div>
        </div>

    </div>




    <script>
        // ------------next pre jq--------------------

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


    {{-- ---------------range filter jq------------ --}}

    <script>
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 0;
        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);
                if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                    @this.emit('priceRange', minPrice + '_' + maxPrice);
                }
            });
        });
        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);
                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    console.log(minVal);
                    console.log(maxVal);
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                    @this.emit('priceRange', minVal + '_' + maxVal);
                }
            });
        });
    </script>


</div>
