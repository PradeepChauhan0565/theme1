    @extends('layout')
    @section('content')
        <style>
            body {
                background-color: #eeeeee;
                font-family: 'Open Sans', serif
            }

            .container {
                margin-top: 50px;
                margin-bottom: 50px
            }

            .card {
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 0.10rem
            }

            .card-header:first-child {
                border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
            }

            .card-header {
                padding: 0.75rem 1.25rem;
                margin-bottom: 0;
                background-color: #fff;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1)
            }

            .track {
                position: relative;
                background-color: #ddd;
                height: 7px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                margin-bottom: 60px;
                margin-top: 50px
            }

            .track .step {
                -webkit-box-flex: 1;
                -ms-flex-positive: 1;
                flex-grow: 1;
                width: 25%;
                margin-top: -23px;
                text-align: center;
                position: relative
            }

            .track .step.trackactive:before {
                background: #071d49;
            }

            .track .step::before {
                height: 7px;
                position: absolute;
                content: "";
                width: 100%;
                left: 0;
                top: 23px;
            }

            .track .step.trackactive .icon {
                background: #071d49;
                color: #fff
            }

            .track .icon {
                display: inline-block;
                width: 50px;
                height: 50px;
                line-height: 55px;
                position: relative;
                border-radius: 100%;
                background: #ddd
            }

            .track .step.trackactive .text {
                font-weight: 400;
                color: #071d49;
            }

            .track .text {
                display: block;
                margin-top: 7px
            }

            .itemside {
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                width: 100%;
            }

            .itemside .aside {
                position: relative;
                -ms-flex-negative: 0;
                flex-shrink: 0;
            }

            .img-sm {
                width: 80px;
                height: 80px;
                padding: 7px;
            }

            ul.row,
            ul.row-sm {
                list-style: none;
                padding: 0;
            }

            .itemside .info {
                padding-left: 15px;
                padding-right: 7px;
            }

            .itemside .title {
                display: block;
                margin-bottom: 5px;
                color: #071d49;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem
            }

            .btn-warnings {
                color: #071d49;
                background-color: #fff;
                border-color: #071d49;
                border-radius: 1px;
            }

            .btn-warnings:hover {
                color: #ffffff;
                background-color: #071d49;
            }

            .btn-warnings:hover i {
                color: #ffffff;
            }

            .step .icon .fa {
                font-size: 24px;
                color: #fff;
            }
        </style>
        <div class="container" style=" overflow-x:auto; ">
            <article class="card" style="min-width: 800px;">
                <header class="card-header"> My Orders / Tracking </header>
                <div class="card-body">
                    <h6>Order ID: {{ $order->id }}</h6>

                    <article class="card">
                        <div class="card-body row">
                            <div class="col"> <strong>Estimated Delivery time:</strong>
                                <br>
                                {{ \Carbon\Carbon::parse($order->created_at)->addDays(15)->format('d/m/Y') }}

                            </div>
                            <div class="col"> <strong>Shipping BY:</strong> <br>
                                @if (empty($order->shipping_carrier))
                                    Awaiting
                                @else
                                    {{ $order->shipping_carrier }}
                                @endif
                                |
                                @if (empty($order->shipping_carrier_contact))
                                    No Contact Number
                                @else
                                    <a href="tel:{{ $order->shipping_carrier_contact }}"><i class="fas fa-phone"></i>
                                        {{ $order->shipping_carrier_contact }}</a>
                                @endif

                            </div>
                            <div class="col"> <strong>Status:</strong> <br>
                                @if ($order->status_id == 1)
                                    Order has been placed
                                @endif
                                @if ($order->status_id == 2)
                                    Item is being manufactured
                                @endif
                                @if ($order->status_id == 3)
                                    Order has been shipped
                                @endif
                                @if ($order->status_id == 4)
                                    Order has been delivered
                                @endif
                                @if ($order->status_id == 6)
                                    Order has been cancelled
                                @endif

                            </div>
                            <div class="col"> <strong>Tracking #:</strong> <br>
                                @if (empty($order->tracking_number))
                                    Awaiting
                                @else
                                    {{ $order->tracking_number }}
                                @endif
                            </div>
                        </div>
                    </article>
                    <div class="track">
                        <div class="step @if (in_array(1, $order_statuses)) trackactive @endif"> <span class="icon"> <i
                                    class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                        <div class="step @if (in_array(2, $order_statuses)) trackactive @endif"> <span class="icon"> <i
                                    class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                        <div class="step @if (in_array(3, $order_statuses)) trackactive @endif"> <span class="icon"> <i
                                    class="fa fa-truck"></i> </span> <span class="text">
                                On the way </span> </div>
                        <div class="step @if (in_array(4, $order_statuses)) trackactive @endif"> <span class="icon"> <i
                                    class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                    </div>
                    <hr>
                    <ul class="row">
                        @if ($orderItems)
                            @foreach ($orderItems->orderItems as $order_item)
                                <li class="col-md-4">
                                    <figure class="itemside mb-3">
                                        <div class="aside"> <img style="width:120px"
                                                src="{{ asset('storage/' . $order_item->product->image_url ?? '') }}"
                                                alt="{{ $order_item->sku }}">
                                        </div>
                                        <figcaption class="info align-self-center">
                                            <p class="title">{{ $order_item->product->name ?? '' }}</p> <span
                                                class="text-muted"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                {{ $order_item->price }} </span>
                                            <div class="text-muted">
                                                @php
                                                    $total_qty = 0;
                                                    $total_qty = $total_qty + $order_item->quantity;
                                                @endphp
                                                Qty- {{ $total_qty }}
                                            </div>
                                        </figcaption>
                                    </figure>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                    <hr>
                    <a href="{{ asset('orders') }}" class="btn btn-warnings" data-abc="true"> <i
                            class="fas fa-angle-left"></i> Back to
                        orders</a>
                </div>
            </article>
        </div>
    @endsection
