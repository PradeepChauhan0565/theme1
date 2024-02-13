<div>

    <style type="text/css">
        .addressInput {
            display: inline-block;
            padding: 10px;
            margin: 15px 0;
            box-sizing: border-box;
            width: 100%;
            border: 1px solid #bcc4d4;
            border-radius: 9px;
            color: #707275;
        }

        .demo input[type=text] {
            display: inline-block;
            padding: 10px;
            margin: 5px 0;
            width: 49.6%;
            box-sizing: border-box;
            border: 1px solid #bcc4d4;
            border-radius: 9px;
        }

        .demo input[type=password] {
            display: inline-block;
            padding: 10px;
            margin: 5px 0;
            width: 49.6%;
            box-sizing: border-box;
            border: 1px solid #bcc4d4;
            border-radius: 9px;
        }


        .button1 {
            background-color: #071d49;
            border: none;
            color: white;
            margin-top: 5px;
            padding: 10px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 9px;
        }

        .paycent {
            width: 100%;
            height: auto;
            overflow: hidden;
            text-align: center;
            border: 1px solid #dce0e9;
            padding: 20px;
        }

        .paypalimg {
            width: 80px;

        }


        .paydiv {
            background-color: #df9e06;
            color: #fff;
            padding: 5px;
            text-align: center;
            width: 100%;
        }

        .table td {
            padding: 3px 5px;
            font-size: 14px;
        }
    </style>


    <!-- cart main wrapper start -->
    @if (count($cartItems) > 0)
        <div class="cart-main-wrapper">


            <div class="container">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <div class="section-bg-color">
                    <div class="row mt-4" style="text-align: center">
                        <div class="col-lg-4" wire:click="tab(1)" style="cursor: pointer">
                            <h4 class="px-2 py-2"
                                style=" @if ($tab == 1) background-color: #071d49; color:#fff; @else background-color:#F7F7F7 @endif">
                                1. Shipping Details
                            </h4>
                        </div>
                        <div class="col-lg-4" wire:click="tab(2)" style="cursor: pointer">
                            <h4 class=" px-2 py-2"
                                style=" @if ($tab == 2) background-color:#071d49; color:#fff; @else background-color:#F7F7F7 @endif">
                                2. Payment
                            </h4>

                        </div>
                        <div class=" col-lg-4" wire:click="tab(3)" style="cursor: pointer">
                            <h4 class=" px-2 py-2"
                                style=" @if ($tab == 3) background-color:#071d49; color:#fff; @else background-color:#F7F7F7 @endif">
                                3. Placing Order
                            </h4>

                        </div>
                    </div>
                    <div class="row g-3 mb-4">


                        @auth

                            <div class=" col-lg-7 mt-4 order-2 order-lg-1">
                                <form action="" method="post" id="myForm">
                                    @csrf

                                    <div class="border p-3" @if ($tab == 2) style="display: none;" @endif>
                                        <input type="hidden" value="" name="amount">
                                        @csrf
                                        <h4>Shipping Address</h4>
                                        <div class=" d-flex gap-2">
                                            <input class="addressInput" type="text" wire:model="shipping_first_name"
                                                placeholder="First name" value="{{ $shipping_first_name }}"
                                                name="shipping_first_name">
                                            <input class="addressInput" type="text" wire:model="shipping_last_name"
                                                placeholder="Last name" value="{{ $shipping_last_name }}"
                                                name="shipping_last_name">
                                        </div>
                                        @error('shipping_first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('shipping_last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div>
                                            <input class="addressInput" type="text" wire:model="shipping_address"
                                                placeholder="Address" name="shipping_address">
                                        </div>
                                        @error('shipping_address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div>
                                            <select wire:change="CountryChange" name="shipping_country" class="addressInput"
                                                data-region-id="shipping-crs" wire:model="shipping_country"
                                                placeholder="country" data-crs-loaded="true">
                                                <option value="">Select country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('shipping_country')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class=" d-flex gap-2">
                                            <select name="shipping_state" class="addressInput" id="shipping-crs"
                                                wire:model="shipping_state" placeholder="State">
                                                <option value="">Select region</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <select name="shipping_city" class="addressInput" id="shipping-crs"
                                                wire:model="shipping_city" placeholder="State">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" wire:model="shipping_city" placeholder="City"> --}}
                                        </div>
                                        @error('shipping_city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class=" d-flex gap-2">
                                            <input class="addressInput" type="number" wire:model="shipping_postcode"
                                                name="shipping_postcode" placeholder="Zip Code" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==6) return false;">
                                            <input class="addressInput" type="number" wire:model="shipping_telephone"
                                                name="shipping_telephone" placeholder="Telephone Number"
                                                pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==10) return false;">
                                        </div>
                                        @error('shipping_postcode')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('shipping_telephone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div>
                                            <input type="checkbox" class="open-billing toggle-billing"
                                                id="billing_as_shipment" wire:model="same_billing_as_shipment"
                                                name="same_billing_as_shipment" wire:change="mycheck">
                                            <label for="billing_as_shipment" style="font-size: 120%;color: black;">Use
                                                this
                                                address for billing</label>
                                        </div>
                                        <div>
                                            <label for="notes" wire:model="comments"
                                                style="font-size: 120%;color: black;">Order
                                                comments</label>
                                            <input class="addressInput" type="text" id="notes" value=""
                                                wire:model="comments" name="comments" value=""
                                                placeholder="Order Notes if any ">
                                        </div>
                                        @error('comments')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <h5>Billing Address</h5>
                                        <div class=" d-flex gap-2">
                                            <input class="addressInput" type="text" wire:model="billing_first_name"
                                                placeholder="First name" name="billing_first_name">
                                            <input class="addressInput" type="text" wire:model="billing_last_name"
                                                placeholder="Last name">
                                        </div>
                                        @error('billing_first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('billing_last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div>
                                            <input class="addressInput" type="text" wire:model="billing_address"
                                                placeholder="Address" name="billing_address"
                                                value="{{ $billing_address }}">
                                        </div>
                                        @error('billing_address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div>
                                            <select wire:change="billingCountryChange" class="addressInput"
                                                data-region-id="shipping-crs" wire:model="billing_country"
                                                name="billing_country" placeholder="country" data-crs-loaded="true">
                                                <option value="">Select country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('billing_country')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class=" d-flex gap-2">
                                            <select class="addressInput" name="billingstateChange"
                                                wire:change="billingstateChange" id="shipping-crs"
                                                wire:model="billing_state" placeholder="State">
                                                <option value="">Select region</option>
                                                @foreach ($billingStates as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <select name="billing_city" class="addressInput" id="shipping-crs"
                                                wire:model="billing_city" placeholder="State">
                                                <option value="">Select City</option>
                                                @foreach ($billingCities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" wire:model="billing_city" placeholder="City"> --}}
                                        </div>
                                        @error('billing_state')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('billing_city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="d-flex gap-2">
                                            <input class="addressInput" type="number" wire:model="billing_postcode"
                                                name="billing_postcode" value="{{ $billing_postcode }}"
                                                placeholder="Zip Code" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==6) return false;">
                                            <input class="addressInput" type="number" wire:model="billing_telephone"
                                                name="billing_telephone" value="{{ $billing_telephone }}"
                                                placeholder="Telephone Number" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==10) return false;">
                                        </div>
                                        @error('billing_postcode')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('billing_telephone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <center>
                                            <label wire:click="placeOrder" class="button1" style="cursor: pointer;">
                                                Place Oder
                                            </label>
                                        </center>
                                    </div>

                                    {{-- Tab 2 Start --}}

                                    @if ($tab == 2)
                                        <div class="mainpaycont">
                                            <div class="paycent">
                                                <img src="{{ asset('images/payment_image.jpg') }}" alt=""
                                                    style="width: 100%;">
                                                <h1 class="py-4">Payment Options</h1>

                                                <p>Securely
                                                    checkout with Us</p>
                                                {{-- <div class="paydiv" style="cursor: pointer">
                                                    <a href="{{ route('processTransaction') }}"
                                                    rel="noopener noreferrer">

                                                </a> --}}

                                                {{-- <!--<button type="submit">-->
                                                    <!--    <img class="paypalimg"-->
                                                    <!--        src="{{ asset('public/images/paypal_PNG1.png') }}">-->
                                                    <!--</button>--> --}}
                                                {{-- </div> --}}
                                                {{-- <br> --}}
                                                {{-- <div class="paydiv" style="cursor: pointer"
                                                wire:click="paymentMode(2)">
                                                <img class="paypalimg" src="{{asset('public/images/stripe.png')}}">
                                            </div> --}}

                                                {{-- <div class="buy_now1" style="cursor: pointer;">
                                                    <img class="paypalimg" wire:click="makePayment"
                                                        src="{{ asset('public/images/razor_pay.png') }}"
                                                        style="width:350px">
                                                </div>
                                                <br> --}}
                                                <div wire:loading.remove>
                                                    <div class="paydiv" style="cursor: pointer"
                                                        @if (!$disable_payment_button) wire:click="paymentMode(1,1)" @endif>
                                                        <h3>Cash on Delivery</h3>
                                                    </div>
                                                </div>
                                                <div wire:loading>
                                                    <img src="{{ asset('images/Processing.gif') }}" style="width:100%;">
                                                </div>

                                                {{-- <div class="visapay"><img class="paypalimg"
                                                        src="{{ asset('public/images/visa-pay.png') }}"
                                                        style="width:350px">
                                                </div> --}}
                                            </div>
                                        </div>
                                    @endif
                                </form>
                                @if ($tab == 3)
                                    {{-- Tab 2 End --}}

                                    {{-- Tab 3 Start --}}
                                    <div class="container">
                                        <div class="row" style="margin-top: 50px">
                                            <div class="col-12 text-center">
                                                <i style="font-size: 50px; color: #00A982" class="fas fa-certificate"></i>
                                                {{-- <img src="{{asset('public/images/thanks_badge.jpg')}}" alt=""> --}}
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <h3 style="color: #00A982">Order has been place</h3>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <p>
                                                    Your order is confirmed. You will receive an order confirmation
                                                    email
                                                    shortly with the expected delivery date for your items.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12"
                                                style="display: flex; justify-content: center; align-items: center">
                                                <div class="card" style="width: 80%; ">
                                                    <div class="card-body">
                                                        <h6 class="card-title"><button class="btn"
                                                                style="padding: 0px 5px; border-radius: 0px; background-color: #00A982; color:#fff">New</button>
                                                        </h6>
                                                        <p class="card-text"></p>
                                                        <div class="row g-4">
                                                            <div class="col-lg-6">
                                                                <a href="{{ asset('/') }}"
                                                                    class="btn btn-outline-secondary"
                                                                    style="width: 100%">CONTINUE SHOPPING</a>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <a href="{{ asset('orders') }}" class="btn btn-primary"
                                                                    style="width: 100%; background-color: #FF3F6C; border-color: #FF3F6C">VIEW
                                                                    ORDER</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Tab 3 End --}}
                                @endif
                                @if ($tab == 4)
                                    @include('include.stripe')
                                @endif
                            </div>

                        @endauth

                        @guest
                            <div class="col-lg-7 mt-4 order-2 order-lg-1">
                                <div style="width: 50%">
                                    {{-- <form method="POST" action="{{ route('login') }}" class="p-4"> --}}
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" wire:model="email" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            placeholder="Enter email" required>
                                        <small id="emailHelp" class="form-text text-muted">
                                            We'll never share your email with anyone else.
                                        </small>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" wire:model="password" class="form-control"
                                            id="exampleInputPassword1" placeholder="Password" required>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-check">
                                        <input type="checkbox" id="remember_me" name="remember" class="form-check-input"
                                            id="exampleCheck1">
                                        <label class="form-check-label"
                                            for="exampleCheck1">{{ __('Remember me') }}</label>
                                        <label style="float: right" class="form-check-label"
                                            for="exampleCheck1">{{ __('Forget Password') }}
                                        </label>
                                    </div>
                                    <br>
                                    <button type="submit" wire:click="login" class="btn btn-cart2"
                                        style="border-radius: 0px; width: 150px">{{ __('Login') }}
                                    </button>
                                </div>
                                <hr>
                                <div class="shipping">
                                    <input type="hidden" value="" name="amount">
                                    @csrf
                                    <h3>Shipping Address</h3>
                                    <div>
                                        <input class="addressInput" type="text" wire:model="shipping_first_name"
                                            placeholder="First name">
                                        <input class="addressInput" type="text" wire:model="shipping_last_name"
                                            placeholder="Last name">
                                    </div>
                                    @error('shipping_first_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @error('shipping_last_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <input class="addressInput" type="text" wire:model="email"
                                            placeholder="Email">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <input type="password" wire:model="password" placeholder="Password">
                                        <input type="password" wire:model="password_confirmation"
                                            placeholder="Confirm Password">
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <input class="addressInput" type="text" wire:model="shipping_address"
                                            placeholder="Address">
                                    </div>
                                    @error('shipping_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <select wire:change="CountryChange" class="addressInput"
                                            data-region-id="shipping-crs" wire:model="shipping_country"
                                            placeholder="country" data-crs-loaded="true">
                                            <option value="">Select country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('shipping_country')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <select wire:change="stateChange" class="addressInput" id="shipping-crs"
                                            wire:model="shipping_state" placeholder="State">
                                            <option value="">Select region</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        <select class="addressInput" id="shipping-crs" wire:model="shipping_city"
                                            placeholder="State">
                                            <option value="">Select City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" wire:model="shipping_city" placeholder="City"> --}}
                                    </div>
                                    @error('shipping_city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <input class="addressInput" type="text" wire:model="shipping_postcode"
                                            placeholder="Zip Code" maxlength="6">
                                        <input class="addressInput" type="text" wire:model="shipping_telephone"
                                            placeholder="Telephone Number">
                                    </div>
                                    @error('shipping_postcode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @error('shipping_telephone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div>
                                        <input class="addressInput" type="text" wire:model="shipping_remark"
                                            placeholder="Order Remarks">
                                    </div>
                                    @error('shipping_remark')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <center>
                                        <button type="submit" wire:click="register" class="button1">Sign Up</button>
                                    </center>
                                </div>
                                {{--
                                </form> --}}
                            </div>
                        @endguest
                        @if ($tab != 3)
                            <div class="col-lg-5 mt-4 order-1 order-lg-2" style="text-align: center;">
                                <div class="border p-3 " style=" position:sticky; top:100px;">
                                    <h4 style="margin-bottom: 12px;">Order Summary</h4>

                                    @if (count($cartItems) > 0)

                                        @foreach ($cartItems as $cart)
                                            @php
                                                $product = App\Models\Product::find($cart['product_id']);
                                                $metal_purity = App\Models\MetalPurity::where('description', $cart['metal'])->first();

                                            @endphp
                                            <div class="border p-2 my-2">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-3 position-relative">
                                                        <a href="{{ route('single', $product->slug) }}"><img
                                                                src="{{ asset('storage/' . $product->image_url) }}"
                                                                style="width: 100%;"></a>
                                                        <div class="position-absolute top-0 left-0"
                                                            style="background-color:#071d49; color:#fff; border-radius:50%; width:18px; height:18px; font-size: 12px; ">
                                                            {{ $cart['quantity'] }}</div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="">
                                                            <a href="{{ route('single', $product->slug) }}">
                                                                <p style="color:#071d49; font-size: 14px; ">
                                                                    {{ $product->name }}</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">

                                                        <p style="color:#071d49; font-size: 14px; ">
                                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                                            {{ ($product->regular_price - ($product->regular_price * $product->perc_discount) / 100) * $cart['quantity'] }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div>
                                                    <br>
                                                    <table class="table  text-sm" style="text-align: left">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    SKU :
                                                                </td>
                                                                <td style="text-align: right; font-size:14px;">
                                                                    {{ $product->sku }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Metal :</td>
                                                                <td
                                                                    style="text-align: right; width:33%;font-size:14px;">
                                                                    @foreach ($product->materials->where('material_type_id', 2) as $item)
                                                                        {{ $item->metalType->code ?? '' }}
                                                                        {{ $item->metalPurity->code ?? '' }}
                                                                    @endforeach
                                                                </td>
                                                            </tr>

                                                            {{-- @if (count($product->materials->where('material_type_id', 3)) > 0)
                                                                <tr>
                                                                    <td>Total Diamond Wt :</td>
                                                                    <td style="text-align: right;font-size:14px;">
                                                                        @php
                                                                            $totalDiaWt = 0;
                                                                        @endphp
                                                                        @foreach ($product->materials->where('material_type_id', 3) as $item)
                                                                            @php
                                                                                $totalDiaWt += $item->material_wt;
                                                                            @endphp
                                                                        @endforeach
                                                                        {{ $totalDiaWt }} Cts.
                                                                    </td>
                                                                </tr>
                                                            @endif --}}
                                                            {{-- @if (count($product->materials->where('material_type_id', 2)->where('center_stone', 1)) > 0)
                                                                <tr>
                                                                    <td>Center Diamond Qlty-Clr
                                                                        :</td>
                                                                    <td style="text-align: right;font-size:14px;">
                                                                        @foreach ($product->materials->where('material_type_id', 2)->where('center_stone', 1) as $item)
                                                                            {{ $item->diamondQuality->name ?? '' }}
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @if (count($product->materials->where('material_type_id', 2)->where('center_stone', 0)) > 0)
                                                                <tr>
                                                                    <td>Side Diamond Qlty-Clr :
                                                                    </td>
                                                                    <td style="text-align: right;font-size:14px;">
                                                                        @foreach ($product->materials->where('material_type_id', 2)->where('center_stone', 0) as $item)
                                                                            {{ $item->diamondQuality->name ?? '' }}
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @if (count($product->materials->where('material_type_id', 3)) > 0)
                                                                <tr>
                                                                    <td>Color Stone Wt :</td>
                                                                    <td style="text-align: right; font-size:14px;">
                                                                        @php
                                                                            $totalCsWt = 0;
                                                                            $csQuality = null;
                                                                        @endphp
                                                                        @foreach ($product->materials->where('material_type_id', 3) as $item)
                                                                            @php
                                                                                $totalCsWt += $item->material_wt;
                                                                                $csQuality = $item->colorStoneQuality->name ?? null;
                                                                            @endphp
                                                                        @endforeach
                                                                        {{ $totalCsWt }} Cts.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Color Stone Quality
                                                                    </td>
                                                                    <td style="text-align: right; font-size:14px;">
                                                                        {{ $csQuality }}
                                                                    </td>
                                                                </tr>
                                                            @endif --}}

                                                            @if ($cart['ring_size'])
                                                                <tr>
                                                                    <td>
                                                                        Ring Size :
                                                                    </td>
                                                                    <td style="text-align: right; font-size:14px;">
                                                                        {{ $cart['ring_size'] }}
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @php
                                                $coupan_price = 0;
                                                if (session()->has('coupan_price')) {
                                                    $coupan_price = session()->get('coupan_price');
                                                }
                                                $g_total = $g_total + ($product->regular_price - ($product->regular_price * $product->perc_discount) / 100) * $cart['quantity'];
                                            @endphp
                                        @endforeach

                                        <div class="mt-2" style="border-top: 1px solid #071d49;">
                                            <div class="border p-3">
                                                {{-- <div class="row mb-4 ">
                                                <div class="col-12">
                                                    <div style="text-align: left">
                                                        <h5>Offer Code</h5>
                                                    </div>
                                                    <div class="row my-2 px-2">
                                                        <div class="col-8" style="padding:7px;">
                                                            <input wire:model="coupan_code" class="w-100 py-2  px-2"
                                                                type="text" placeholder="Enter your coupon code">
                                                        </div>
                                                        <div class="col-4" style="padding:7px;">
                                                            <button wire:click="coupanCode({{ $product->id }})"
                                                                class=" py-2  w-100"
                                                                style=" background-color:#00263a; color:white; font-size:17px;">
                                                                Apply</button>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    @error('coupan_code')
                                                        <span style="color:red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                                {{-- @if (session()->has('coupan'))
                                                <div class="row mb-4">
                                                    <div class="col-lg-12" style="text-align: left">
                                                        <h6>Coupan code <b>{{ session()->get('coupan') }}</b>, Price of
                                                            ${{ $coupan_price }} has been applied</h6>
                                                    </div>
                                                </div>
                                            @endif --}}
                                                <div class="row  mb-4">
                                                    <div class="col-lg-8" style="text-align: left">
                                                        <h6>Subtotal</h6>
                                                    </div>
                                                    <div class="col-lg-4" style="text-align: right">
                                                        <h6><i class="fa-solid fa-indian-rupee-sign"></i>
                                                            {{ $g_total }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                @if (session()->has('coupan'))
                                                    <div class="row mb-4">
                                                        <div class="col-lg-8" style="text-align: left">
                                                            <h6>Coupan Value</h6>
                                                        </div>
                                                        <div class="col-lg-4" style="text-align: right">
                                                            <h6><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $coupan_price }}</h6>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row mb-4">
                                                    <div class="col-lg-8" style="text-align: left">
                                                        <h6>Shipping</h6>
                                                    </div>
                                                    <div class="col-lg-4" style="text-align: right">
                                                        <h6>Free</h6>
                                                    </div>
                                                </div>
                                                @if ($tab == 2)
                                                    <div class="row mb-4">
                                                        <div class="col-lg-8" style="text-align: left">
                                                            <h6>Tax</h6>
                                                        </div>
                                                        <div class="col-lg-4" style="text-align: right">
                                                            <h6>{{ $tax }}%</h6>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row mb-4">
                                                    <div class="col-lg-8" style="text-align: left">
                                                        <h6>Total <span style="font-size: 13px"> (price exclusive of
                                                                tax)</span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-4" style="text-align: right">
                                                        @if ($tab == 2)
                                                            <h6><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $g_total + ($g_total * $tax) / 100 - $coupan_price }}
                                                            </h6>
                                                        @else
                                                            <h6><i class="fa-solid fa-indian-rupee-sign"></i>
                                                                {{ $g_total - $coupan_price }}</h6>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row" style="text-align: left">
                                                    <div class="col-lg-12">
                                                        <span>
                                                            <i class="fas fa-calendar-alt"></i> Estimated date
                                                        </span>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span>
                                                            @php
                                                                echo date('j M Y D', strtotime(' +15 day'));
                                                            @endphp
                                                        </span>
                                                    </div>
                                                </div>



                                                {{-- <div class="row mt-2" style="text-align: left">
                                                <div class="col-lg-12">
                                                    We Accept<br>
                                                    <img src="{{asset('public/assets/img/card.png')}}" alt="">
                                                </div>
                                            </div> --}}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    <input type="hidden" value="{{ $g_total }}" name="g_total" id="g_total">
                    </form>


                </div>
            </div>
        </div>
    @else
        <div class="container mt-4" style="height-min: 30vh; text-align: center">
            @if ($tab == 3)
                {{-- Tab 2 End --}}

                {{-- Tab 3 Start --}}
                <div class="container">
                    <div class="row" style="margin-top: 50px">
                        <div class="col-12 text-center">
                            {{-- <i style="font-size: 50px; color: #00A982" class="fas fa-certificate"></i> --}}
                            <img src="{{ asset('images/correct.png') }}" alt="" style="width:120px;">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <h3 style="color: #1e81ce">Order has been Confirmed</h3>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <p>
                                Your order is confirmed. You will receive an order confirmation email
                                shortly with the expected delivery date for your items.
                            </p>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-12" style="display: flex; justify-content: center; align-items: center">
                            <div class="card" style="width: 80%; ">
                                <div class="card-body">
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <a href="{{ asset('/') }}" class="btn btn-outline-secondary"
                                                style="width: 100%;">CONTINUE SHOPPING</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="{{ asset('orders') }}" class="btn btn-primary"
                                                style="width:100%; background-color: #071d49; border-color: #071d49">
                                                VIEW ORDER
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tab 3 End --}}
            @else
                <a href="{{ asset('/') }}" class="btn btn-outline-secondary my-4"
                    style=" color:#fff; background-color: #071d49;">
                    CONTINUE SHOPPING
                </a>
            @endif
        </div>

    @endif
    <div class="container">
        <div style="text-align: center; font-weight: 900;">
            <h2>Need assistance?</h2>
        </div>
        <div style="text-align: center">
            <h2>Don’t worry, we have got you covered!</h2>
        </div>

        <div class="row">
            <div class="col-lg-4" style="padding: 20px">
                <a target="blank" style="color:#000000" href="https://wa.me/{{ $contact->whatsapp_number }}">
                    <div class="row" style="background-color: #F7F7F7; padding: 20px">
                        <div class="col-2">
                            <i class="fab fa-whatsapp" style="font-size: 40px"></i>
                        </div>
                        <div class="col-10">
                            <h5>Chat with Us</h5>
                            Don’t hesitate, drop us a message
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4" style="padding: 20px">
                <a href="mailto:{{ $contact->email }}" style="color: #000">
                    <div class="row" style="background-color: #F7F7F7; padding: 20px">
                        <div class="col-2">
                            <i class="fas fa-envelope-open-text" style="font-size: 40px"></i>
                        </div>
                        <div class="col-10">
                            <h5>Email us</h5>
                            {{ $contact->email }}
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4" style="padding: 20px">
                <a style="color: #000" href="tel:{{ $contact->phone_number }}">
                    <div class="row" style="background-color: #F7F7F7; padding: 20px">
                        <div class="col-2">
                            <i class="fas fa-phone" style="font-size: 40px"></i>
                        </div>
                        <div class="col-10">
                            <h5>Call us at</h5>
                            {{ $contact->phone_number }}
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
