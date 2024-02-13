<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            color: #071d49;
        }

        th,
        td {
            border-top: 1px solid #9e9d9d;
            border-bottom: 1px solid #9e9d9d;
            padding: 10px;
        }
    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <td style="min-width:390px; border:0; margin:auto;">
                <div style="color:#071d49;">
                    <div style="background-color:#f7fcff;">
                        <div style="padding:10px;">
                            <div style="text-align:center;">
                                <img src="https://www.jewelwebnet.com/img/jewelwebnet-logo.png" alt=""
                                    style="width: 80px;">
                            </div>
                            <h5 style="margin-bottom:10px; font-size: 16px;text-transform: capitalize;">Hello
                                {{ $order->user->name ?? '' }},</h5>
                            <p style="text-align:justify; font-size: 16px;">
                                Your order from New Jewelry has been shipped and will be delivered soon.
                                You can track your shipment using this link:
                                <a href="http://127.0.0.1:8000/tracking/{{ $order->id }}" target="_blank">
                                    http://127.0.0.1:8000/tracking/{{ $order->id }}
                                </a>

                            </p>
                        </div>
                    </div>
                    <div style="text-align:center; font-size: 20px;">
                        <h3 style="padding:6px 0;">Order shipped!</h3>
                        <h5 style="margin-bottom:10px;">Order # {{ $order->id }}</h5>
                    </div>
                    <table style="width: 100%; margin-bottom:6px;">
                        <tr>
                            <th style="text-align: left;">Sku</th>
                            <th style="text-align: left;">Product Name</th>
                            <th style="text-align: left;">Qty</th>
                            <th style="text-align: left;">Total</th>
                        </tr>
                        @php
                            $total = 0;
                            $qty = 0;
                        @endphp

                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td style="border:0;">{{ $item->product->sku ?? '' }}</td>

                                <td style="border:0;">{{ $item->product->name ?? '' }}</td>

                                <td style="border:0;">{{ $item->quantity ?? '' }} </td>

                                <td style="border:0;"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ $item->price ?? '' }}</td>
                            </tr>
                            @php
                                $total += $item->price;
                                $qty += $item->quantity;
                            @endphp
                        @endforeach

                        <tr>
                            <td><b>Total</b></td>
                            <td>
                                @if ($order->discount_amount)
                                    Coupon- {{ $order->remark }}, Discount- <i
                                        class="fa-solid fa-indian-rupee-sign"></i> {{ $order->discount_amount }}
                                @endif
                            </td>
                            <td><b>{{ $qty }}</b></td>
                            <td><b><i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ $total - $order->discount_amount }}</b></td>
                        </tr>
                    </table>
                    <table style="width:100%; background-color:#f7fcff;">
                        <tr style="border:0;">
                            <th style="border:0;text-align: left;">Expected Delivery Date</th>
                            <th style="border:0;text-align: left;">Your order will be send to</th>
                        </tr>
                        <tr style="border:0;">
                            @php
                                $createdAt = \Carbon\Carbon::parse($order->created_at)
                                    ->addDays(15)
                                    ->format('d-m-Y');
                            @endphp
                            <td style="border:0;">
                                {{ $createdAt }}
                            </td>
                            <td style="border:0;">{{ $order->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td style="border:0;"></td>
                            <td style="border:0;">
                                {{ $order->billingAddress->address_line1 }},
                                {{ $order->billingAddress->city }}, {{ $order->billingAddress->state }},
                                {{ $order->billingAddress->pin }},
                                {{ $order->billingAddress->country }}
                            </td>
                        </tr>
                    </table>
                    <div style="text-align:center; margin-top:10px;">
                        <a href="{{ asset('orders') }}" target="_blank">
                            Go to Your Order
                        </a>
                    </div>

                    <div style="text-align:center; margin-top:10px;  border-top:1px solid#071d49; ">
                        <p style="padding-top:6px; color:#071d49;">This email was send from an email address. Please
                            don't reply to this email.</p>
                    </div>
                </div>

            </td>
        </tr>
    </table>



</body>

</html>
