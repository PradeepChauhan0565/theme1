<div>
    <style>
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
    </style>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-3">Hi, {{ Auth::user()->name }}</h2>
            </div>
            <div title="Setting" style="font-size: 24px; cursor: pointer;"><i class="fa-solid fa-gear"></i></div>
        </div>
        <p>Welcome to your Account</p>
        <div class="row g-3 mt-4">
            <div class="col-lg-4">
                <div class="border rounded p-3 d-flex">
                    <div><img src="{{ asset('images/order.png') }}" alt="" style="width:70px;"></div>
                    <div class="mx-2">
                        <h5>Your Orders</h5>
                        <a href="{{ asset('orders') }}">
                            <button class="px-3 py-1 border-0"Pho>View Orders</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border rounded p-3 d-flex">
                    <div><img src="{{ asset('images/wishlist.png') }}" alt="" style="width:70px;"></div>
                    <div class="mx-2">
                        <h5>Your Wish List</h5>
                        <a href="{{ asset('wishlist') }}">
                            <button class="px-3 py-1 border-0">View Wishlist</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border rounded p-3 d-flex">
                    <div><img src="{{ asset('images/map.png') }}" alt="" style="width:70px;"></div>
                    <div class="mx-2">
                        <h5>Your Address</h5>

                        <button id="addressToggle" class="px-3 py-1 border-0"
                            wire:click="editAddress('edit',{{ Auth::user()->id }})">View Address</button>

                    </div>
                </div>
            </div>

        </div>

        <br>
        <br>


        @if ($action == 'edit')
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="border p-3">
                        <div class="text-center mb-4">
                            <h4>Shipping Address</h4>
                        </div>
                        <div class="demo d-flex gap-2">
                            <input class="addressInput" type="text" wire:model="shipping_first_name"
                                placeholder="First name" value="{{ $shipping_first_name }}" name="shipping_first_name">
                            <input class="addressInput" type="text" wire:model="shipping_last_name"
                                placeholder="Last name" value="{{ $shipping_last_name }}" name="shipping_last_name">
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
                            <select class="addressInput" wire:change="CountryChange" name="shipping_country"
                                style="" class="crs-country" data-region-id="shipping-crs"
                                wire:model="shipping_country" placeholder="country" data-crs-loaded="true">
                                <option value="">Select country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('shipping_country')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="demo3 d-flex gap-2">
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

                        </div>
                        @error('shipping_city')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class=" d-flex gap-2">
                            <input class="addressInput" type="number" wire:model="shipping_postcode"
                                name="shipping_postcode" placeholder="Zip Code" pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==6) return false;">
                            <input class="addressInput" type="number" wire:model="shipping_telephone"
                                name="shipping_telephone" placeholder="Telephone Number" pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==10) return false;">
                        </div>
                        @error('shipping_postcode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('shipping_telephone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="d-flex justify-content-end my-3">
                            <button wire:click="back()" type="button" class="btn btn-danger">Close</button> &nbsp;
                            &nbsp; &nbsp;<button wire:click="updateAdress()" class="btn btn-success px-5">
                                Update</button>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <br>
            <br>
            <br>
        @endif
    </div>

    <script>
        $("#addressToggle").click(function() {
            $("#address").toggle();
        });
    </script>
</div>
