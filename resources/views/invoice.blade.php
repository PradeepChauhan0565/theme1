    @extends('layout')
    @section('content')
        <style>
            table tr,
            th,
            td {
                border: 1px solid #071d49;
                padding: 5px;
            }

            table tr,
            th {
                font-size: 13px;
                color: #fff;
            }

            .fontsize {
                color: #071d49;
                font-size: 14px;
            }
        </style>

        <div class=" py-5" style=" width:70%; margin:auto;">
            <div class="shadow " style="overflow-x:auto; ">
                <div class="p-4 shadow border" style="min-width:750px;">
                    <div class="text-end px-4 ">
                        <a href="{{ asset('invoice-pdf/' . $order->id) }}" title="Download" style="color: #071d49;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                        </a>
                    </div>
                    <div class="d-flex justify-content-between pb-2" style="border-bottom:1px solid #071d49">
                        <div class="  mt-2">
                            <img src="{{ asset('images/New Jewelry.png') }}" alt="" style="width:120px;">
                        </div>

                        <div>
                            <div class="d-flex justify-content-end">
                                <h1 style="font-size:56px;color:#071d49;">INVOICE</h1>
                            </div>

                            <p style="color:#071d49; font-size:14px;">Supply meant for Export under bond or letter of
                                undertaking without payment of IGST.</p>

                        </div>

                    </div>

                    <table class="w-100">
                        <tr class="px-2 py-1" style="background-color: #071d49; ">
                            <th colspan="2 " style=" width:50%;">EXPORTER</th>
                            <th> INVOICE #</th>
                            <th>ORDER NO</th>
                            <th>DATE</th>
                        </tr>
                        <tr class="px-2 py-1">
                            <td colspan="2" style="color:#071d49; width:50%;">COMPANY ADDRESS HERE
                                <br>
                                PHONE : {{ $contacts->phone_number }}
                            </td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order['created_at']->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>CIN : UFRHHT234567565</td>
                            <td>GST : 131XVDVSB2141</td>
                            <th style="background-color: #071d49;">PAYMENT MODE</th>
                            <th style="background-color: #071d49;">PAYMENT STATUS</th>
                            <th style="background-color: #071d49;">PAYMENT ID</th>
                        </tr>
                        <tr>
                            <td>IEC No. 0392345645340</td>
                            <td>ARN : AD22344653666</td>
                            <td> {{ $order->payment_id == 1 ? 'Paid' : 'Cash on delivery' }}</td>
                            <td>
                                {{-- @if ($paymentdetails->status_id == 1 ?? '')
                                    Pending
                                @else
                                    {{ $paymentdetails->status_id }}
                                @endif --}}
                            </td>
                            <td>
                                {{-- @if ($paymentdetails->payment_id == 1)
                                    No Id
                                @else
                                    {{ $paymentdetails->payment_id }}
                                @endif --}}
                            </td>
                        </tr>
                        <tr>
                            <td>PAN : ASFDSG234CDF</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2" style="color:#071d49; width:50%;">Bill To</th>
                            <th colspan="3" style="color:#071d49; width:50%;">Ship To</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="mb-1 fontsize">{{ $order->billingAddress->first_name ?? '' }}
                                    {{ $order->billingAddress->last_name ?? '' }}</p>
                                {{ $order->billingAddress->address_line1 ?? '' }}
                                {{ $order->billingAddress->city ?? '' }},
                                {{ $order->billingAddress->state ?? '' }},
                                {{ $order->billingAddress->pin ?? '' }},
                                {{ $order->billingAddress->country ?? '' }}
                                <br>
                                mobile-
                                {{ $order->billingAddress->phone ?? '' }}
                            </td>
                            <td colspan="3">
                                <p class="mb-1 fontsize">{{ $order->shippingAddress->first_name ?? '' }}
                                    {{ $order->shippingAddress->last_name ?? '' }}</p>
                                {{ $order->shippingAddress->address_line1 ?? '' }},
                                {{ $order->shippingAddress->pin ?? '' }},
                                {{ $order->shippingAddress->country ?? '' }} <br>
                                mobile-
                                {{ $order->billingAddress->phone ?? '' }}
                            </td>
                        </tr>
                    </table>


                    <table class="table">
                        <thead>
                            <tr style="background-color: #071d49; ">
                                <th>STYLE CODE</th>
                                <th>DESCRIPTION</th>
                                <th>UNIT PRICE</th>
                                <th>QTY</th>
                                <th>AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tax = 0;
                                $total = 0;
                                $total_qty = 0;

                            @endphp
                            @foreach ($order->orderItems as $item)
                                @php
                                    $t = ($item->price * 0) / 100;
                                @endphp
                                <tr style="text-align: justify; font-size:15px; color:#071d49;">
                                    <td scope="row">{{ $item->product->sku ?? '' }}</td>
                                    <td>{{ $item->product->name ?? '' }}</td>
                                    <td><i class="fa-solid fa-indian-rupee-sign"></i> {{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><i class="fa-solid fa-indian-rupee-sign"></i>
                                        {{ $item->price * $item->quantity + $t }}</td>
                                </tr>
                                @php
                                    $tax = $tax + $t;
                                    $total = $total + $item->price * $item->quantity + $t;
                                    $total_qty = $total_qty + $item->quantity;
                                @endphp
                            @endforeach
                            <tr style="text-align: justify; font-size:15px; color:#071d49;">
                                <td colspan="2">Value in Words :
                                    @php
                                        $f = new \NumberFormatter(locale_get_default(), \NumberFormatter::SPELLOUT);
                                    @endphp
                                    <span class="text-capitalize"> {{ $f->format($total) }}</span>
                                </td>
                                <td style="background-color: #e5e8eb;">TOTAL</td>
                                <td style="background-color: #e5e8eb;"> {{ $total_qty }}</td>
                                <td style="background-color: #e5e8eb;"><i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ $total }}</td>

                            </tr>
                            <tr>
                                <td colspan="5" class="text-center fst-italic" style="color:#071d49;"><b>Thank you for
                                        your business! </b></td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: justify; font-size:14px; color:#071d49;">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod aliquid voluptatum tenetur
                                    quidem temporibus! Aliquam, quis accusantium qui tempore veritatis molestias. Id illum
                                    eveniet repudiandae atque error inventore debitis ducimus.
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5" style="text-align: justify; color:#071d49;font-size:14px;">
                                    "Declaration : We declare that this Proforma Invoice shows the actual price
                                    of the goods described and that all particulars are true and correct."
                                </td>
                            </tr>
                            <tr style="color:#071d49; font-size:15px;">
                                <td colspan="5">
                                    <div class="row">
                                        <div class="col-8">
                                        </div>
                                        <div class="col-4 fontsize">
                                            FOR COMPANY NAME HERE
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-8">

                                        </div>
                                        <div class="col-4 fontsize">
                                            Authorised Signatory
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="color:#071d49; font-size:14px;">
                                <td colspan="5" class="text-center">If you have any questions about this invoice,
                                    please contact</td>
                            </tr>
                            <tr style="color:#071d49; font-size:14px;">
                                <td colspan="5" class="text-center"><a
                                        href="mailto:{{ $contacts->email }}">{{ $contacts->email }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
