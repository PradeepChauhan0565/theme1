<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
                            <p style="margin-bottom:10px;font-size: 16px;">
                                Your package has been delivered!
                            </p>
                            <p style="font-size: 16px;">
                                We'd love to hear your feedback! Please let us know your feedback here:
                            </p>
                        </div>
                    </div>
                    <div style="text-align:center; ">
                        <a style="color: rgb(236, 203, 15); text-decoration:none; font-size: 22px;"
                            href="{{ asset('orders') }}" target="_blank">
                            &#9734; &#9734; &#9734; &#9734; &#9734;
                        </a>
                    </div>

                    <div style="text-align:center; font-size: 20px;">
                        <h3 style="padding:10px 0;">Order delivered!</h3>
                        <h5 style="margin-bottom:16px;">Order # {{ $order->id }}</h5>
                    </div>
                    <table style="width: 100%;">
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

                                <td style="border:0;">${{ $item->price ?? '' }}</td>
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
                </div>
                <div style="text-align:center; margin-top:15px; border-top:1px solid#071d49;">
                    <p style="padding-top:6px; color:#071d49;">This email was send from an email address. Please
                        don't reply to this email.</p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
