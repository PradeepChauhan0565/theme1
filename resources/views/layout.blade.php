<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- ---------------font-awesome------------ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- ---------------font-family------------ --}}
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@200;300;400;500&display=swap"
        rel="stylesheet">

    {{-- ---------------jquery------------ --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

    {{-- ---------------toastr------------ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- ---------------bootstrap------------ --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrapm.css') }}">

    {{-- ---------------Style------------ --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/allstyle.css') }}">

    {{-- ---------------livewire------------ --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    @livewireStyles
    @stack('scripts')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
            /* font-family:  Helvetica Neue,Helvetica,Arial,sans-serif; */
            font-family: 'Public Sans', sans-serif;
        }

        :root {
            --default-color: #071d49;
            --active-color: #00CFFF;
        }
    </style>
</head>



<body>

    @php
        $contacts = App\Models\ContactDetails::first();
        $categories = App\Models\Category::orderBy('order_by', 'asc')->where('status', 1)->get();
        $socials = App\Models\SocialMedia::orderBy('order_by', 'asc')->where('status', 1)->get();
    @endphp

    @include('header')
    @yield('content')
    @include('footer')
    @livewireScripts

    {{-- ---------------popup------------ --}}

    @if (!session()->has('popup'))
        <div id="popupModal" class="modal fade bd-example-modal" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                <div class="modal-content" style=" border:none; border-radius:0;">
                    <div class="modal-body position-relative" style="padding: 0;">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset('images/Silver_Jewellery.jpg') }}" alt=""
                                    style="width: 100%; height:100%;">
                            </div>
                            <div class="col-lg-6  d-flex justify-content-center align-items-center position-relative"
                                style=" color:#071d49;">

                                <div class="">
                                    <div>
                                        <div class="text-center">
                                            <img src="{{ asset('public/assets/img/logo/kama-logo-blue.png') }}"
                                                alt="" style="width: 250px;">
                                        </div>

                                        <div class="text-center my-4 ">
                                            <h2 style=" color:#071d49; padding-bottom:16px;">Sign up and receive
                                                10% off on your first order</h2>
                                            <p style="font-size:20px;">& exclusive access to new launches</p>
                                        </div>
                                        <form action="" method="post">
                                            @csrf
                                            <div class="d-flex justify-content-center">
                                                <div class="col-9 ">
                                                    <input class="px-3 py-1 my-2 w-100" type="email" name="email"
                                                        placeholder="Email address " style=" color:#00263a;" required>
                                                    <!--<input class="pop-btn py-1 my-4 w-100" type="submit" value="Continue">-->
                                                    <button class="pop-btn py-1 my-4 w-100 border-0"
                                                        style=" background-color:#00263a; color:#fff;">Unlock
                                                        Offer</button>
                                                </div>
                                            </div>

                                        </form>

                                        <div class="px-5">
                                            <p class="text-center" style="font-size:13px;">Check your email to
                                                know your unique code after signing up.</p>
                                            <p class="text-center px-5" style="font-size:13px;"><b> *Note:</b> The
                                                code will be Valid for 30 days from the date of sign up.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="close position-absolute " data-bs-dismiss="modal"
                            style="top:0px; right:0; cursor: pointer; font-size:24px; padding:0px 13px; background-color:#071d49;"
                            aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @php
        session()->put('popup', 'accepted');
    @endphp
    {{-- ---------------scrollToTop------------ --}}
    <button id="scroll_top" onclick="scrollToTop()" class="position-fixed"
        style="display: none; z-index:99;bottom:50px; right:10px; border-radius:50%; font-size: 22px; width:50px; height:50px; background-color:#071d49; border:none;">
        <i class="fa-solid fa-arrow-up text-white"></i>
    </button>



    {{-- ---------------toastr------------ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- ---------------bootstrap------------ --}}
    <script src="{{ asset('js/bootstrapm.js') }}"></script>

    <script>
        function scrollToTop() {
            window.scrollTo(0, 0);
        }
        var $logo = $('#scroll_top');
        $(document).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('#scroll_top').css("display", "block");
            } else {
                $('#scroll_top').css("display", "none");
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#popupModal').modal('show');
            }, 10000);

            isPrevented = false;
            toastr.options = {
                closeButton: true,
                "progressBar": true,
                onHidden: () => {
                    if (isPrevented) {
                        return false;
                    } else {
                        //Sent result to server;
                    }
                },
                onCloseClick: () => {
                    isPrevented = true
                }
            }

            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif
            @if (Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
            @if (Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}");
            @endif
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        });
    </script>

    <style>
        .toast-success {
            /* color: #fff;s */
            background-color: #61cc41 !important;
        }
    </style>
    <script>
        // Toastify({
        //     text: 'testing succesfull tested this',
        //     duration: 3000,
        //     style: {
        //         background: "linear-gradient(to right, #5e82b8,#41cc77)"
        //     }

        // }).showToast();


        // @if (Session::has('alert-success'))
        //     Toastify({
        //         text: "Session::get('alert-success')",
        //         duration: 3000,
        //         style: {
        //             background: "linear-gradient(to right, #00b09b,#96c93d)"
        //         }
        //     }).showToast();
        // @elseif (Session::has('alert-warnnig'))
        //     Toastify({
        //         text: "Session::get('alert-success')",
        //         duration: 3000,
        //         style: {
        //             background: "linear-gradient(to right, #00b09b,#96c93d)"
        //         }
        //     }).showToast();
        // @endif
    </script>
</body>

</html>
