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
    @php
        $contact = App\Models\ContactDetails::first();
        $products = App\Models\Product::whereIn('id', $ids)->get();
    @endphp
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
                            <h5 style="margin-bottom:10px; font-size: 16px;text-transform: capitalize;">
                                Hello {{ Auth::user()->name }},</h5>
                            <p style="margin-bottom:10px;font-size: 16px;">
                                Thank you so much for placing the Order!
                            </p>
                            <p style="font-size: 16px;">
                                We will get started on your order right away. When we ship your order, we will send a
                                notification email. The transit time may vary depending on logistics.
                            </p>
                            <br>
                            <h5>Cheers!</h5>
                            <h4> New Jewelry</h4>
                        </div>
                    </div>
                    <div style="text-align:center; ">
                        <a style="color: #071d49; text-decoration:none; font-size: 22px;" href="{{ asset('orders') }}"
                            target="_blank">
                            Go to Order
                        </a>
                    </div>

                    <div style="text-align:center; font-size: 20px;">
                        <h3 style="padding:10px 0;">Order confirmed!</h3>
                        <h5 style="margin-bottom:16px;">Order # {{ $order_no }}</h5>
                    </div>
                    <table style="width: 100%;">
                        <tr>
                            <th style="text-align: left;">Sku</th>
                            <th style="text-align: left;">Image</th>
                            <th style="text-align: left;">Product Name</th>
                            <th style="text-align: left;">Size</th>
                            <th style="text-align: left;">Qty</th>
                            <th style="text-align: left;">Total</th>
                        </tr>

                        @php
                            $g_total = 0;
                            $g_qty = 0;
                            $sale_discount_price = 0;
                        @endphp
                        @foreach ($products as $item)
                            @php
                                $sale_discount_price = ($item->total * $item->perc_discount) / 100;
                                $metal_wt = 0;
                                $dia_wt = 0;
                                $cs_wt = 0;
                                $img_color = $item->orderItem->where('order_id', $order_no)->first()->color ?? 'y';
                                if ($img_color == 'Yellow') {
                                    $img_color = 'y';
                                }
                                if ($img_color == 'White') {
                                    $img_color = 'w';
                                }
                                if ($img_color == 'Rose') {
                                    $img_color = 'r';
                                }

                                $qty = $item->orderItem->where('order_id', $order_no)->first()->quantity ?? 1;
                                $price = $item->orderItem->where('order_id', $order_no)->first()->price ?? 0;
                                $total = $price * $qty;
                                $g_total = $g_total + $total;
                                $g_qty = $g_qty + $qty;

                                foreach ($item->materials as $material) {
                                    if ($material->material_type_id == 2) {
                                        $metal_wt += $material->material_wt;
                                    }
                                    if ($material->material_type_id == 3) {
                                        $dia_wt += $material->material_wt;
                                    }
                                    if ($material->material_type_id == 4) {
                                        $cs_wt += $material->material_wt;
                                    }
                                }
                            @endphp
                            <tr>
                                <td style="border:0;">{{ $item->sku }}</td>
                                <td style="border:0;">
                                    <img style="width:100px;" src="storage/{{ $item->image_url }}">
                                </td>
                                <td style="border:0;">{{ $item->name }}</td>
                                <td style="border:0;">{{ $item->ringSize->code ?? '' }}</td>
                                <td style="border:0;">{{ $qty }}</td>

                                <td style="border:0;">
                                    <i class="fa-solid fa-indian-rupee-sign"></i> {{ $total }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><b>Total</b></td>

                            <td colspan="2">
                                @if ($coupan_code)
                                    Coupon- {{ $coupan_code }}, Discount- <i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ $coupan_price }}
                                @endif
                            </td>
                            <td>{{ $g_qty }}</td>
                            <td>
                                <b><i class="fa-solid fa-indian-rupee-sign"></i> {{ $g_total - $coupan_price }}</b>
                            </td>
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
