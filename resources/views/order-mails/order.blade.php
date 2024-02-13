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
