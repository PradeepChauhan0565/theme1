<div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('../src/jquery.exzoom.js') }}"></script>
    <link href="{{ asset('../src/jquery.exzoom.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* ----------------accrdian css------------- */
        .accordion-title:before {
            float: right !important;
            font-family: FontAwesome;
            content: "\f068";
            padding-right: 5px;
        }

        .accordion-title.collapsed:before {
            float: right !important;
            content: "\f067";
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #d6c3c3;
        }

        .card {
            border: none;
        }

        .collapseborder {
            border-bottom: 1px solid #d6c3c3;
        }

        /* -----------exzoom css---------- */
        #exzoom {
            width: 480px;
        }

        .product_list_ul {
            position: relative;
        }

        .bvideo-wrap {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            transform: translate3d(0px, 0px, 0px);
            width: 100%;
            height: 100%;

        }

        .product_list_ul:hover .bvideo-wrap {
            display: block;
        }

        #share-buttons {
            display: none;
        }

        .share-btn {
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            border-radius: 50px;
            font-size: 20px;
            background-color: #071d49;
            color: #fff;
            margin: 4px;
            cursor: pointer;
        }

        /* ------------review css------- */
        .rating {
            padding-bottom: 30px;
        }

        .rating label {
            float: right;
            position: relative;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }

        .rating label:not(:first-of-type) {
            padding-right: 2px;
        }

        .rating label:before {
            content: "\2605";
            font-size: 42px;
            color: #ccc;
            line-height: 1;
        }

        .rating input {
            display: none;
        }

        .rating input:checked~label:before,
        .rating:not(:checked)>label:hover:before,
        .rating:not(:checked)>label:hover~label:before {
            color: #071d49;
        }

        .fa-thumbs-down {
            transform: rotateY(180deg);
        }

        .zoom_btn {
            height: 30px;
            width: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50px;
        }

        .zoom_btn:hover {
            background-color: #ccc;
            z-index: 9;
        }
    </style>

    <div style="background-color: #fff;">
        <div class="container">
            <div class="row g-4 mt-4">
                <div class="col-lg-6">
                    <div class="exzoom " id="exzoom">
                        <div class="exzoom_img_box ">
                            <ul class='exzoom_img_ul d-flex'>
                                <li class=""><img
                                        src="{{ asset('https://kamajewelry.com/public/storage/products2023/JRZ764410_RXF.jpg') }}"
                                        alt="" style="width: 100%; height:100%" /></li>
                                <li class=""><img
                                        src="{{ asset('https://kamajewelry.com/public/storage/products2023/JRZ76451Q_WXF.jpg') }}"
                                        alt="" style="width: 100%; height:100%" /></li>
                                <li class=""><img
                                        src="{{ asset('https://kamajewelry.com/public/storage/products2023/JRZ764610_YXF.jpg') }}"
                                        alt="" style="width: 100%; height:100%" /></li>
                                <li class=""><img
                                        src="{{ asset('https://kamajewelry.com/public/storage/products2023/JRZ764810_YXF.jpg') }}"
                                        alt="" style="width: 100%; height:100%" /></li>
                                <li class=""><img
                                        src="{{ asset('https://vdjewel.com/wp-content/uploads/2023/05/RE51153WXDDVD.jpg') }}"
                                        alt="" style="width: 100%; height:100%" /></li>
                                <li class=""><img
                                        src="{{ asset('https://vdjewel.com/wp-content/uploads/2023/05/PE51151WXDDVD.jpg') }}"
                                        alt="" style="width: 100%; height:100%" /></li>
                                <li class="btnfornext"><img src="{{ asset('images/Wedding Rings.jpg') }}"
                                        style="width: 100%; height:100%;" /></li>
                                <li class=" product_list_ul"><img src="{{ asset('images/video_icon.png') }}"
                                        style="width: 100%; height:100%;" />
                                    <div class="bvideo-wrap ">
                                        <video
                                            poster="{{ asset('https://www.kamajewelry.com/public/assets/img/logo/main_logo.png') }}}}"
                                            loop controls muted autoplay>
                                            {{-- <source src='{{asset('https://kinvid1.bluestone.com/output/mp4/BINK0421R16-VIDEO-28807.mp4/BINK0421R16-VIDEO-28807.mp4')}}' type='video/mp4'>  --}}
                                            <source src='{{ asset('images/JAE06220Q_1_yo.mp4') }}' type='video/mp4'>
                                        </video>
                                    </div>
                                </li>

                            </ul>
                            <div class=" exzoom_prev_btn"
                                style="position:absolute; top:45%; left:-1px; z-index:1; font-size:20px;  cursor:pointer; ">
                                <div class="zoom_btn">
                                    <i class="fa-solid fa-angle-left"></i>
                                </div>
                            </div>
                            <div class=" exzoom_next_btn"
                                style="position:absolute; top:45%; right:-1px;z-index:1; font-size:20px;  cursor:pointer; ">
                                <div class="zoom_btn">
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </div>

                            <div class="position-absolute   text-2xl " title="Add to wishlist"
                                style="cursor:pointer; left:8px; top:2px; font-size:28px; z-index:99;"><i
                                    class="far fa-heart"></i>
                            </div>


                            <div style="position:absolute; top:3px; right:2px; z-index:9;">
                                <div class="position-relative">
                                    <div onClick="shareFunction()" title="Share">
                                        <i class="fas fa-share-alt share-btn"></i>
                                    </div>

                                    <div id="share-buttons" style="position:absolute; top:45px; right:-5px; z-index:9;">

                                        <!-- facebook -->
                                        <a class="facebook" target="blank"><i class="fab fa-facebook share-btn"></i></a>

                                        <a class="mail" target="blank"><i
                                                class="fa-solid fa-envelope share-btn"></i></a>

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
                                        <a class="pinterest" target="blank"><i
                                                class="fab fa-pinterest share-btn"></i></a>

                                    </div>
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
                <div class="col-lg-6">
                    <div>
                        <h6>
                            Hexa Green Gem Stylish Gold Earring
                        </h6>
                    </div>
                    <div class="mb-3">MU1100032060</div>
                    <div class="mb-3">Price ₹29,851.00</div>
                    <div class="mb-3">
                        <button class="py-2 text-center w-100"
                            style="background-color: #071d49;border:none;border-radius:5px; font-size:22px; color:#fff;">Add
                            to cart</button>
                    </div>
                </div>
            </div>
            <div class="row  py-5">
                <div class="col-lg-4">xdcgvbjmk,</div>
                <div class="col-lg-8 border ">
                    <div id="accordion">

                        <div class="card">
                            <div class="card-header">
                                <a class="card-link accordion-title" data-toggle="collapse" href="#collapseOne"
                                    style="color:#071d49; text-decoration:none;">
                                    PRODUCT DETAILS
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show collapseborder" data-parent="#accordion">
                                <div class="card-body">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto ipsum
                                    voluptates
                                    totam quas obcaecati dolores! Adipisci, dicta inventore. Tenetur porro odio
                                    voluptate
                                    laboriosam facere pariatur aperiam consectetur nihil enim dolor.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                    href="#collapseTwo" style="color:#071d49; text-decoration:none;">
                                    DIAMOND DETAILS
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse collapseborder" data-parent="#accordion">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi adipisci earum
                                    quas
                                    recusandae. Natus voluptates fugit deleniti soluta placeat maxime eveniet impedit
                                    quis
                                    provident a, facere accusamus corrupti. Rem, quidem!
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                    href="#collapseThree" style="color:#071d49; text-decoration:none;">
                                    METAL DETAILS
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse collapseborder" data-parent="#accordion">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero nostrum repellat ex
                                    vitae hic fuga harum cum, numquam nisi temporibus incidunt ea dolore possimus
                                    voluptatibus perspiciatis dolor rem maiores deleniti?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">WRITE A REVIEW</h5>
                            <button type="button" class="close px-2 border" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row ">
                                    <div class="col-12 ">
                                        <input type="hidden" id="rv_id" name="rv_id">
                                        <input type="hidden" id="product_id" name="product_id" value="">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>Rating<span style="font-size:24px;">*</span></div>
                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rating"
                                                        value="5" /><label for="star5"></label>
                                                    <input type="radio" id="star4" name="rating"
                                                        value="4" /><label for="star4"></label>
                                                    <input type="radio" id="star3" name="rating"
                                                        value="3" /><label for="star3"></label>
                                                    <input type="radio" id="star2" name="rating"
                                                        value="2" /><label for="star2"></label>
                                                    <input type="radio" id="star1" name="rating"
                                                        value="1" /><label for="star1"></label>
                                                </div>
                                                @error('rating')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <lable>Add a title <span style="font-size:24px;">*</span></lable>
                                                <br>
                                                <input name="title" class=" mb-2 rounded border py-1 px-2 w-100"
                                                    type="text" value="{{ old('title') }}" required><br>
                                                @error('title')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <lable>Add a review <span style="font-size:24px;">*</span> </lable><br>
                                        <textarea class=" mb-2 rounded border py-1 px-2 w-100" name="review" id="" cols="30" rows="4"
                                            required>{{ old('review') }}</textarea>
                                        @error('review')
                                            <div class="alert alert-danger py-1">{{ $message }}</div>
                                        @enderror
                                        <lable> Add a photo </lable>
                                        <input name="file" class=" mb-2 rounded border py-1 px-4 w-100"
                                            type="file">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <lable>Your name<span style="font-size:24px;">*</span> </lable>
                                                <input name="name"
                                                    class=" mb-2 rounded border py-1 px-2 w-100 text-capitalize"
                                                    type="text" value="{{ old('name') }}" required>
                                                @error('name')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <lable> Email <span style="font-size:24px;">*</span></lable>
                                                <input name="email" class="rounded border mb-2 py-1 px-2 w-100"
                                                    type="text" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="alert alert-danger py-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="button" class="btn btn-secondary mx-4"
                                        data-dismiss="modal">Close</button>
                                    <button
                                        style="background-color:#071d49; color:white; padding:8px 20px;border:none;border-radius:5px; ">POST</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-5">
                <button data-toggle="modal" data-target="#exampleModalLong"
                    style="background-color: #071d49; color:white; padding:8px 20px; border-radius:5px; border:none;">Write
                    A Review</button>
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session('msg') }}
                    </div>
                @endif
                <hr>

            </div>

        </div>
    </div>

    {{-- <div class="d-none d-lg-block" style="margin-bottom: 470px;"></div> --}}

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


</div>
