    <div>
        <style>
            .nav-link:hover,
            .nav-link {
                color: white;
            }

            table th {
                color: #fff;
            }
        </style>
        <div class="container">
            <nav aria-label="breadcrumb" class="py-1">
                <ol class="breadcrumb" style="margin-bottom: 0rem; font-size:12px;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
            </nav>


            <nav class="d-flex justify-content-center" style="background-color: #bebebe;">
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Product
                        Order</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Gift Card
                        Order</button>
                    <!--<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>-->
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    style="text-align: justify;">
                    <div class="">
                        <div class="row mb-4 " style="">
                            <div class="col-lg-12 " style="overflow-x:auto;">
                                @if (count($orders) > 0)
                                    <table class="table" style="min-width: 1100px;">
                                        <thead>
                                            <tr style="background-color:#071d49;">
                                                <th scope="col">Sr No</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Order Details</th>
                                                <th scope="col">Product Value</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">Order Tracking</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>
                                                        {{ ($orders->currentpage() - 1) * $orders->perpage() + $loop->index + 1 }}
                                                    </td>
                                                    <td style="color:#071d49; font-size:15px;">
                                                        {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d h:i a') }}
                                                    </td>
                                                    <td style="color:#071d49; font-size:15px;">
                                                        <div class="d-flex flex-column">
                                                            <div> Order - {{ $order->id }}</div>
                                                            <div>
                                                                Remark -<br>
                                                                {{ $order->remark }}
                                                            </div>

                                                            <div>
                                                                <button class="border px-2"
                                                                    wire:click="showOrderitems({{ $order->id }})">
                                                                    <strong style="color:#0d6efd;">View order
                                                                        details</strong>
                                                                </button>

                                                                <!-- Modal -->
                                                                <div wire:ignore.self class="modal fade"
                                                                    id="exampleModal" tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">Details
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($payment_details == $order->id)
                                                                                    @if ($payment)
                                                                                        <section>
                                                                                            <div class="mainol"
                                                                                                style="padding: 10px">
                                                                                                <strong>{{ $item->product->name ?? '' }}</strong>
                                                                                                <br>
                                                                                                @if ($item->ring_size)
                                                                                                    Size :
                                                                                                    {{ $item->ring_size }}<br>
                                                                                                @endif
                                                                                            </div>
                                                                                        </section>
                                                                                    @endif
                                                                                @endif
                                                                                {{-- @if ($order_details == $order->id) --}}
                                                                                @if ($orderItems)
                                                                                    @foreach ($orderItems->orderItems as $order_item)
                                                                                        <section>
                                                                                            <div class=""
                                                                                                style="padding: 10px">
                                                                                                @php

                                                                                                    // $ctr = 1;
                                                                                                    // $colorType = 0;
                                                                                                    // $color = 0;
                                                                                                    // $o_color = $colorType;

                                                                                                    // if (!$colorType) {
                                                                                                    //     $o_color = strtolower($item->color[0]);
                                                                                                    // }
                                                                                                @endphp

                                                                                                @if ($order_item->product)
                                                                                                    <img style="width:120px"
                                                                                                        src="{{ asset('storage/' . $order_item->product->image_url ?? '') }}"
                                                                                                        alt="{{ $order_item->product->sku ?? '' }}">
                                                                                                @endif
                                                                                                <div class="mb-2">
                                                                                                    <strong>{{ $order_item->product->name ?? '' }}</strong>
                                                                                                </div>
                                                                                                <div class="mb-2">
                                                                                                    Size :
                                                                                                    {{ $order_item->ring_size }}
                                                                                                </div>
                                                                                                <a target="_blank"
                                                                                                    href="{{ route('single', [$order_item->product->slug ?? '']) }}">
                                                                                                    <button
                                                                                                        class="border px-2">
                                                                                                        Write a
                                                                                                        Review
                                                                                                    </button>
                                                                                                </a>
                                                                                                <a target="_blank"
                                                                                                    href="{{ route('single', [$order_item->product->slug ?? '']) }}">
                                                                                                    <button
                                                                                                        class="border px-2">
                                                                                                        Buy it Agin
                                                                                                    </button>
                                                                                                </a>
                                                                                            </div>
                                                                                        </section>
                                                                                    @endforeach
                                                                                    {{-- @endif --}}
                                                                                @endif

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td style="color:#071d49; font-size:15px;">
                                                        <div>
                                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                                            {{ $order->amount - $order->discount_amount }}
                                                        </div>
                                                    </td>
                                                    <td style="color:#071d49; font-size:15px;">
                                                        <div>
                                                            {{ $order->payment_id == 1 ? 'Paid' : 'Cash on delivery' }}
                                                        </div>
                                                    </td>

                                                    <td style="color:#071d49; font-size:15px;">
                                                        <div class=" ">
                                                            @if ($order->status_id == 1)
                                                                Order has been placed
                                                            @endif
                                                            @if ($order->status_id == 7)
                                                                Order has been shipped
                                                            @endif
                                                            @if ($order->status_id == 2)
                                                                Order has been delivered
                                                            @endif
                                                            @if ($order->status_id == 3)
                                                                Order has been cancelled
                                                            @endif
                                                            @if ($order->status_id == 4)
                                                                Item is being manufactured
                                                            @endif
                                                        </div><br>


                                                        @if ($cancelOrderId == $order->id && $cancelMsg)
                                                            <div>
                                                                <b>Note :</b>
                                                                {{ $cancelMsg }}
                                                            </div>
                                                        @endif


                                                    </td>
                                                    <td>
                                                        <div style=" font-size:15px;"> Tracking No-<br>
                                                            {{ $order->tracking_number }}</div>
                                                        <div><a target="_blank"
                                                                href="{{ asset('tracking/' . $order->id) }}">Track</a>
                                                        </div>

                                                    </td>
                                                    <td class="" style=" font-size:15px;">
                                                        <button class="border w-100 mb-1 px-2 text-white"
                                                            style="background-color: #071d49;">
                                                            <a class="text-white" target="_blank"
                                                                href="{{ route('invoice', [$order->id]) }}">Invoice</a>
                                                        </button><br>
                                                        <!--<div class=" btn0 " style="color:#071d49; font-size:14px;">-->
                                                        <!--    Shipping Carrier-->
                                                        <!--    {{ $order->shipping_carrier }}-->
                                                        <!--</div>-->
                                                        <div>
                                                            @if ($order->status_id == 1 || $order->status_id == 2 || $order->status_id == 5)
                                                                <button class="border w-100  px-2 bg-danger text-white"
                                                                    wire:click="cancelOrder({{ $order->id }})">Cancel
                                                                    Order</button>
                                                            @endif
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="container">
                                        <div style="width:100%;">
                                            {{ $orders->links() }}
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <div class="col-lg-4">
                                            <img style="width: 100%" src="{{ asset('images/order not found.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                style="text-align: justify;">
                <div class=" px-1 px-md-4 pb-5 pt-2 " style="width:90%; margin:auto;overflow-x:auto;">
                    @if (count($gifts) > 0)
                        <table class="table table-striped table-hover" style="min-width: 1100px;">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. No</th>
                                    <th scope="col">Reciver Name</th>
                                    <th scope="col">Cuopon Code</th>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment status</th>
                                    <th scope="col">Buy date</th>
                                    <th scope="col">Valid date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($gifts as $gift)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td style="text-transform: capitalize;">{{ $gift->reciver_name }}</td>
                                        <td>{{ $gift->payment_status ? $gift->coupon_code : '********' }}</td>
                                        <td>{{ $gift->id }}</td>
                                        <td>${{ $gift->amount }}</td>
                                        <td>{{ $gift->payment_status ? 'Done' : 'Pending' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($gift->created_at)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $gift->end_date }}</td>
                                        <td>

                                            <button class="btn " @if ($gift->payment_status) disabled @endif>
                                                <a href="{{ asset('gift-checkout/' . $gift->id) }}"
                                                    style="color:white; background-color:#071d49; padding:10px 20px;border-radius: 5px;">
                                                    Pay </a>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                    @else
                        <div class="container" style="text-align: center; padding: 50px 0px">
                            <img style="width: 400px" src="{{ asset('public/images/no_product.jpeg') }}"
                                alt="">
                        </div>
                    @endif
                </div>
                <!--<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="text-align: justify;">-->


                <!--</div>-->
            </div> --}}
        </div>

    </div>
    <script>
        $(document).ready(function() {
            window.addEventListener('livewireOpenModal', event => {
                $("#exampleModal").modal('show');
            })
            // window.addEventListener('livewireCloseModal', event => {
            //     $("#exampleModal").modal('hide');

            // })
        });
    </script>


    </div>
