<div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .details {
            display: none;
            transition-delay: 9s;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            transition: all 6s ease-out;
            transition-duration: 2s;
        }

        .product:hover .details {
            display: block;
        }

        #next:hover .fa-angle-left,
        #prev:hover .fa-angle-right {
            transform: rotate(360deg);
            transition: 1s;
        }

        .wrapper {
            width: 400px;
            background: #fff;
            border-radius: 10px;
            padding: 2px 15px 30px;
        }

        header h2 {
            font-size: 24px;
            font-weight: 600;
        }

        header p {
            margin-top: 5px;
            font-size: 16px;
        }

        .price-input {
            width: 100%;
            display: flex;
            margin: 30px 0 35px;
        }

        .price-input .field {
            display: flex;
            width: 100%;
            height: 45px;
            align-items: center;
        }

        .field input {
            width: 100%;
            height: 100%;
            outline: none;
            font-size: 19px;
            margin-left: 12px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #999;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .price-input .separator {
            width: 130px;
            display: flex;
            font-size: 19px;
            align-items: center;
            justify-content: center;
        }

        .slider {
            height: 5px;
            position: relative;
            background: #ddd;
            border-radius: 5px;
        }

        .slider .progress {
            height: 100%;
            left: 0%;
            right: 0%;
            position: absolute;
            border-radius: 5px;
            background: #071d49;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            top: -5px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        input[type="range"]::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #071d49;
            pointer-events: auto;
            -webkit-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        input[type="range"]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #071d49;
            pointer-events: auto;
            -moz-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }


        .btn-secondary {
            color: #fff;
            background-color: #071d49;
            border-color: #071d49;
        }

        .ft-toolbar {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 9;
            /* overflow-x: auto;
                                                                                                                                                                                                                                                                                                                                                                          overflow-y: hidden; */
            -webkit-overflow-scrolling: touch;
            padding: 5px;
            /* height: 55px; */
            background-color: #fff;
            box-shadow: 0 2px 20px 0 rgba(0, 0, 0, 0.2), 0 10px 20px 0 rgba(0, 0, 0, 0.19);
        }

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

        .form-check-input:checked {
            background-color: #071d49;
            border-color: #071d49;
        }

        .form-check label,
        .form-check-input {
            cursor: pointer;
        }

        .modal-sort {
            position: fixed;
            bottom: 0;
            left: 0%;
            right: 0%;
            transform: translate(-50%, -50%);
        }
    </style>


    <div>
        <img src="{{ asset('images/Pendant-Desktop-listing-page.webp') }}" alt="" style="width:100%;">
    </div>


    <div class="mx-auto " style="width:90%;padding-bottom: 40px; padding-top:20px;">
        <div class="d-none d-lg-block">
            <div class="row mb-5 g-3 ">
                <div class="col-lg-10">
                    <h6 class="text-xl mb-3">FILTER BY</h6>
                    <div class="row g-2">
                        <div class="col-lg-3">
                            <div class="dropdown ">
                                <button class="btn w-100 btn-secondary dropdown-toggle" type="button"
                                    style="text-align: left;" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Price
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="wrapper ">
                                        <div class="price-input">
                                            <div class="field">
                                                <span>Min</span>
                                                <input type="number" class="input-min" value="0">
                                            </div>
                                            <div class="separator">-</div>
                                            <div class="field">
                                                <span>Max</span>
                                                <input type="number" class="input-max" value="10000">
                                            </div>
                                        </div>
                                        <div class="slider">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <input type="range" class="range-min" min="0" max="10000"
                                                value="0" step="100">
                                            <input type="range" class="range-max" min="0" max="10000"
                                                value="10000" step="100">
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
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Gold</a>
                                    <a class="dropdown-item" href="#">Platinum</a>
                                    <a class="dropdown-item" href="#">Silver</a>
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
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">14 kt</a>
                                    <a class="dropdown-item" href="#">18 kt</a>
                                    <a class="dropdown-item" href="#">22 Kt</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="dropdown ">
                                <button class="btn w-100 btn-secondary dropdown-toggle" type="button"
                                    style="text-align: left;" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Gender
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Male</a>
                                    <a class="dropdown-item" href="#">Female</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2">
                    <h6 class="text-xl mb-3">SORT BY</h6>
                    <div>
                        <select name="" id="" class="btn w-100 btn-secondary dropdown-toggle"
                            style="text-align: left;">
                            <option value=""> Sort by</option>
                            <option value="">Hign to Low</option>
                            <option value="">Low to Hight</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ">
                <div class="position-relative product border">
                    <a href="{{ route('single') }}" target="_blank" style="text-decoration: none;"><img
                            src="{{ asset('images/chill1.jpg') }}" alt="" style="width: 100%;">
                        <div class="bg-white text-black p-2">
                            <p>Jewellery-dropdown-panel </p>
                            <p>Rs.18000</p>
                            <div class="text-center "style="background-color: #071d49;"><button
                                    class="p-1 border-0  text-white" style="background-color: #071d49;">Discover
                                    more</button></div>
                        </div>
                    </a>
                    <div class="position-absolute  text-2xl" style="left:8px; top:2px; font-size:28px;"><i
                            class="far fa-heart"></i></div>
                    <div class="position-absolute   top-0 left-0">
                        <div class=" details ">
                            <div class="position-relative">
                                <div class="productwrapper  transition delay-700 duration-300 ease-in-out">
                                    <div><img src="{{ asset('images/product1.jpg') }}" alt=""
                                            style="width: 100%;"> </div>
                                    <div><img src="{{ asset('images/chill2.jpg') }}" alt=""
                                            style="width: 100%;"> </div>
                                    <div><img src="{{ asset('images/chill3.jpg') }}" alt=""
                                            style="width: 100%;"> </div>
                                    <div><img src="{{ asset('images/chill4.jpg') }}" alt=""
                                            style="width: 100%;"> </div>
                                </div>
                                <div class="position-absolute "
                                    style="left:-3px; top: 50%;  transform: translate(-50%);"><a class=" px-2 py-3"
                                        id="next"
                                        style="cursor: pointer; background-color:rgb(226, 230, 230);"><i
                                            class="fas fa-angle-left"></i></a> </div>
                                <div class="position-absolute "
                                    style="right:-24px; top: 50%;  transform: translate(-50%);"><a class=" px-2 py-3"
                                        id="prev"
                                        style="cursor: pointer; background-color:rgb(226, 230, 230);"><i
                                            class="fas fa-angle-right"></i></a> </div>
                                <div class="position-absolute   text-2xl " title="Add to wishlist"
                                    style="cursor:pointer; left:8px; top:2px; font-size:28px;"><i
                                        class="far fa-heart"></i></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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

        </div>
        <div class="ft-toolbar d-lg-none">
            <div class="row ">
                <div class="py-2 col-6 d-flex justify-content-center align-items-center " data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop" style="cursor: pointer;">

                    <i class="fa-solid fa-filter mx-1"></i>FILTER

                </div>
                <div class=" col-6 d-flex justify-content-center align-items-center" data-toggle="modal"
                    data-target=".bs-example-modal-lg" style="cursor: pointer;"><i
                        class="fa-solid fa-sort mx-1"></i>SORT BY</div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade d-lg-none" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-lg-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn -mr-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-arrow-left" style="font-size: 20px;"></i> </button>
                            <h5 class="modal-title" id="staticBackdropLabel">Filters</h5>
                        </div>

                        <button type="button" class="btn bg-secondary text-white">Reset</button>
                    </div>
                    <div class="modal-body">
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
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck1" style="cursor: pointer">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Default checkbox
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="defaultCheck2">
                                            <label class="form-check-label" for="defaultCheck2">
                                                Disabled checkbox
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                        href="#collapseTwo" style="color:#071d49; text-decoration:none;">
                                        METAL
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse collapseborder" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Default radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Default checked radio
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link accordion-title" data-toggle="collapse"
                                        href="#collapseThree" style="color:#071d49; text-decoration:none;">
                                        GOLD PURITY
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse collapseborder" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault3">
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                Default radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault4" checked>
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                Default checked radio
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary w-100"
                            style="background-color: #071d49;color:#fff;">Apply</button>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel">
            <div class="modal-sort modal-dialog modal-lg">
                <div class="modal-content pb-3">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Sort By</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true"></span></button>
                    </div>
                    <div class="dropdown-item">Hign to Low</div>
                    <div class="dropdown-item">Low to Hight</div>
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
        let priceGap = 100;

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
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>


</div>
