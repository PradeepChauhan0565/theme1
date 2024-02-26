<div class="d-block d-lg-none" style="background-color: var(--default-color); width:100%;">
    <div class="" style="width:95%;margin:auto;">
        <div class="row g-2" style="height: 32px;">
            <div class="col-3 d-flex  align-items-center">
                <a href="https://wa.me/{{ $contacts->whatsapp_number }}" style="font-size:13px; color: #fff;"><i
                        class="fab fa-whatsapp text-white mx-2"></i></a>
                <a href="tel:{{ $contacts->mobile_number }}" style="font-size:13px; color: #fff;"><i
                        class="fas fa-phone text-white mx-2"></i></a>
            </div>
            <div class="col-6 d-flex  align-items-center" style="font-size:13px;">
                <marquee behavior="" style="color: #fff;" direction="">
                    Welcome To New Jewelry
                </marquee>
            </div>
            <div class="col-3 d-flex  align-items-center justify-content-end">
                <a href="mailto:sale@gmail.com" style="font-size:13px; color: #fff;"><i
                        class="fas fa-envelope text-white mx-2"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="d-none d-lg-block" style="background-color: var(--default-color); width:100%;">
    <div style="width:95%;margin:auto;">
        <div class="row g-2" style="height: 32px;">
            <div class="col-4 d-flex  align-items-center">
                <a href="https://wa.me/{{ $contacts->whatsapp_number }}" style="font-size:13px; color: #fff;"><i
                        class="fab fa-whatsapp text-white mx-2"></i>Whatsapp</a>
                <a href="tel:{{ $contacts->mobile_number }}" style="font-size:13px; color: #fff;"><i
                        class="fas fa-phone text-white mx-2"></i>{{ $contacts->mobile_number }}</a>
            </div>
            <div class="col-4 d-flex  align-items-center" style="font-size:13px;">
                <marquee behavior="" style="color: #fff;" direction="">
                    Welcome To New Jewelry
                </marquee>
            </div>
            <div class="col-4 d-flex  align-items-center justify-content-end">
                <a href="mailto:{{ $contacts->email }}" style="font-size:13px; color: #fff;"><i
                        class="fas fa-envelope text-white mx-2"></i>{{ $contacts->email }}</a>
            </div>
        </div>
    </div>
</div>

<!-------------------mobile header start-------------->

<div class="d-block d-lg-none shadow"
    style="position: -webkit-sticky; position: sticky; top: 0px; background-color:#fff; z-index: 1001;">
    <div style="width:95%;margin:auto;">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="">
                <a href="{{ asset('/') }}">
                    <img src="{{ asset('images/New Jewelry.png') }}" alt="" style="width:55px;"></a>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="account_menus">
                    <div title="Account">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-person" viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                        </svg>
                    </div>
                    <div class="acount_btn p-3 ">
                        <h6>Your Account @auth <span style="font-size: 12px;"> ( {{ Auth::user()->name }} )
                            </span>@endauth
                        </h6>
                        @guest
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('register') }}"><button class="px-3 py-1  border-0"
                                        style="background-color: var(--default-color); color:#fff;">Sign Up</button></a>
                                <a href="{{ route('login') }}"><button class="px-3 py-1 "
                                        style="border:1px solid var(--default-color);">Login</button></a>
                            </div>
                        @endguest
                        @auth
                            <div class="d-flex justify-content-between   align-items-center">
                                <form action="{{ route('logout') }}" method="post">
                                    <div class="d-flex justify-content-between">
                                        @csrf
                                        <button class="px-3 py-1 "
                                            style="border:1px solid var(--default-color); font-size:14px;">logout</button>
                                    </div>
                                </form>
                                <a href="{{ route('profile') }}"> <button class="px-3 py-1  border-0"
                                        style="background-color: var(--default-color); color:#fff; font-size:14px;">My
                                        Account</button></a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="right_menus">
                    <a href="{{ route('recent-view') }}" title="Recently Viewed" style="color:var(--default-color);">

                        <svg data-name="browseing history" width="20" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24.53 22">
                            <path class="cls-1"
                                d="M13.49,0A10.93,10.93,0,0,0,2.62,9.29H.31c-.31,0-.4.2-.21.44l2.77,3.35a.43.43,0,0,0,.7,0L6.2,9.75c.19-.25.09-.45-.22-.45H3.93a9.72,9.72,0,1,1,2.39,8.24.66.66,0,0,0-.92,0,.65.65,0,0,0,0,.91A11,11,0,1,0,13.49,0Z" />
                            <rect class="cls-1" x="12.84" y="3.88" width="1.29" height="7.76" rx="0.65"
                                ry="0.65" />
                            <rect class="cls-1" x="15.43" y="7.76" width="1.29" height="6.47" rx="0.65"
                                ry="0.65" transform="translate(27.07 -5.07) rotate(90)" />
                        </svg>
                    </a>
                </div>

                <div class="position-relative right_menus"><a href="{{ route('wishlists') }}"
                        style="color:var(--default-color);" title="Wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                    </a>
                    <span
                        style="font-size: 9px;cursor: pointer;  position:absolute; top:11px; left:50%;transform:translate(-50%) ; color:var(--active-color);">
                        @livewire('component.wishlist-count')
                    </span>
                </div>
                <div class=" position-relative right_menus"> <a class="social-icon " href="{{ route('cart') }}"
                        style="color:var(--default-color);" title="Cart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-handbag" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z" />
                        </svg>
                        <span
                            style="font-size: 9px; position:absolute; top:15px; left:50%;transform:translate(-50%); color:var(--active-color);">
                            @livewire('component.cart-count')
                        </span>
                        </i>
                    </a>
                </div>


                <button class="border-0 right_menus" type="button" data-bs-toggle="modal"
                    data-bs-target="#leftModal" style="background-color:transparent;">
                    <svg class="mobmenu position-relative" xmlns="http://www.w3.org/2000/svg" width="30"
                        height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
            </div>
        </div>

        <div>
            <form class="main_search pb-1 position-relative" action="{{ route('search') }}" method="get">
                <input type="text" name="search" placeholder="Search.." class="w-100 py-1 px-4 border  rounded"
                    required>
                <button
                    style=" position: absolute;top: 50%; right: 10px; transform: translate(0,-50%); font-size:20px; color:var(--default-color);"
                    class="border-0 p-1 bg-transparent" title="Search"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</div>


<div class="modal left" id="leftModal" tabindex="-1" aria-labelledby="leftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm w-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leftModalLabel"><a href="{{ asset('/') }}"
                        style="color:var(--default-color);">New Jewelry</a></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="py-2" style="margin: auto">
                    @foreach ($categories as $category)
                        <li class=" mainmenu mb-3 w-100">
                            <a class="{{ request()->is('shop/' . $category->slug) ? 'active2' : '' }} p-2 inline text-capitalize"
                                href="{{ route('products', $category->slug) }}">
                                {{ $category->name }}</a>
                            <ul class="submenus shadow  px-3 py-1">
                                @foreach ($category->categoryType as $ctype)
                                    <li class="mb-3"><a class="p-2 text-capitalize"
                                            style="color:var(--default-color);"
                                            href="{{ route('products', $category->slug . '/' . $ctype->slug) }}">
                                            {{ $ctype->name }} </a>
                                        <ul class="mb-3 py-2">
                                            @foreach ($ctype->subCategory as $item)
                                                <li class="mb-2"><a class="p-2 text-capitalize"
                                                        href="{{ route('products', $category->slug . '/' . $ctype->slug . '/' . $item->slug) }}"
                                                        class="text-capitalize">{{ $item->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


<!-------------------mobile header end-------------->

<div class="d-none d-lg-block shadow"
    style="position: -webkit-sticky; position: sticky; top: 0;background-color:#fff; z-index:999; width:100%;">
    <div class="" style="width:95%;margin:auto;">
        <div class="row d-flex   align-items-center">
            <div class="col-2 d-flex  align-items-center ">
                <a href="{{ asset('/') }}"><img src="{{ asset('images/New Jewelry.png') }}" alt="logo"
                        style="width:90px;"></a>
            </div>
            <div class="col-6">
                <nav class="navbar navbar-expand-lg "style="padding:0px;">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav" style="margin: auto">
                                @foreach ($categories as $category)
                                    <li class="nav-item dropdown has-megamenu">
                                        <a class="nav-link  text-capitalize {{ request()->is('shop/' . $category->slug) ? 'active1' : '' }}"
                                            href="{{ route('products', $category->slug) }}">
                                            {{ $category->name }}</a>
                                        <div class="dropdown-menu megamenu" role="menu">
                                            <div class="row g-3 ">
                                                @foreach ($category->categoryType as $ctype)
                                                    <div class="col-lg-3 col-12">
                                                        <div class="col-megamenu">
                                                            <a
                                                                href="{{ route('products', $category->slug . '/' . $ctype->slug) }}">
                                                                <h6 class="title">{{ $ctype->name }}</h6>
                                                            </a>
                                                            <ul class="list-unstyled">
                                                                @foreach ($ctype->subCategory as $item)
                                                                    <li><a href="{{ route('products', $category->slug . '/' . $ctype->slug . '/' . $item->slug) }}"
                                                                            class="text-capitalize">{{ $item->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div> <!-- navbar-collapse.// -->
                    </div> <!-- container-fluid.// -->
                </nav>
            </div>
            <div class="col-2 d-flex px-3  align-items-center">
                <form action="{{ route('search') }}" method="GET">
                    <div class="wrapper_search">
                        <input type="text" name="search" placeholder="Search.." class="border px-1 py-1"
                            required>
                        <button class="search-btn border px-1 py-1" title="Search"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>

            </div>
            <div class="col-2">
                <div class="d-flex justify-content-between px-3  align-items-center">
                    <div class="account_menus">
                        <div title="Account">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                            </svg>
                        </div>
                        <div class="acount_btn p-3 ">
                            <h6>Your Account @auth<span style="font-size: 12px;"> (
                                    {{ Auth::user()->name }} )</span>@endauth
                            </h6>
                            @guest
                                <div class="d-flex justify-content-between   align-items-center">
                                    <a href="{{ route('register') }}"> <button class="px-3 py-1  border-0"
                                            style="background-color: var(--default-color); color:#fff;">Sign
                                            Up</button></a>
                                    <a href="{{ route('login') }}"> <button class="px-3 py-1  border-0"
                                            style="background-color: #007bff; color:#fff;">Sign In</button></a>

                                </div>
                            @endguest
                            @auth
                                <div class="d-flex justify-content-between   align-items-center">


                                    <form action="{{ route('logout') }}" method="post">
                                        <div class="d-flex justify-content-between">
                                            @csrf
                                            <button class="px-3 py-1 "
                                                style="border:1px solid var(--default-color); font-size:14px;">logout</button>
                                        </div>
                                    </form>
                                    <a href="{{ route('profile') }}"> <button class="px-3 py-1  border-0"
                                            style="background-color: var(--default-color); color:#fff; font-size:14px;">My
                                            Account</button></a>
                                </div>
                            @endauth

                        </div>
                    </div>
                    <div class="right_menus">
                        <a href="{{ route('recent-view') }}" title="Recently Viewed">
                            <svg data-name="browseing history" width="24" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24.53 22">
                                <path class="cls-1"
                                    d="M13.49,0A10.93,10.93,0,0,0,2.62,9.29H.31c-.31,0-.4.2-.21.44l2.77,3.35a.43.43,0,0,0,.7,0L6.2,9.75c.19-.25.09-.45-.22-.45H3.93a9.72,9.72,0,1,1,2.39,8.24.66.66,0,0,0-.92,0,.65.65,0,0,0,0,.91A11,11,0,1,0,13.49,0Z" />
                                <rect class="cls-1" x="12.84" y="3.88" width="1.29" height="7.76" rx="0.65"
                                    ry="0.65" />
                                <rect class="cls-1" x="15.43" y="7.76" width="1.29" height="6.47" rx="0.65"
                                    ry="0.65" transform="translate(27.03 -5.04) rotate(90)" />
                            </svg>
                        </a>
                    </div>

                    <div class="position-relative right_menus"><a href="{{ route('wishlists') }}"
                            style="color:var(--default-color);" title="Wishlist">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>

                            <span
                                style="font-size: 10px;  position:absolute; top:9px; left:50%;transform:translate(-50%); color:var(--active-color);">
                                <livewire:component.wishlist-count />
                            </span>
                        </a>

                    </div>
                    <div class=" position-relative right_menus"> <a class="social-icon " href="{{ route('cart') }}"
                            title="Cart" style="color:var(--default-color);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                fill="currentColor" class="bi bi-handbag" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z" />
                            </svg>
                            <span
                                style="font-size: 10px; position:absolute; top:14px; left:50%;transform:translate(-50%); color:var(--active-color);">
                                @livewire('component.cart-count')
                            </span>

                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


{{-- @livewireScripts --}}


<script>
    $('.mobmenu').click(function() {
        $('.togmenu').toggle();
    });

    $('.submenu1').click(function() {

        let submenu = $(this).val()
        $('.submenu2' + submenu).toggle();
    });

    $('#submenu2').click(function() {
        $('.submenus2').toggle();
    });
</script>
<script>
    $(document).ready(function() {


        $(window).scroll(function() {
            if ($(document).scrollTop() > 50) {
                $(".logowidth").css("width", "70px");
            } else {

                $(".logowidth").css("width", "110px");
            }
        });

    });



    $(document).ready(function() {
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).delay(500).slideDown(
                    "slow");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).delay(500).slideUp(
                    "slow");
                $(this).toggleClass('open');
            }
        );
    });
</script>
