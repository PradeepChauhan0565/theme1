<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders ( {{ count($orders) }} )</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input wire:model="search" type="text" name="table_search" class="form-control float-right"
                                placeholder="Search by order no & name ....">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- /.card-header -->

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <tr>
                            <div class="d-flex justify-cuntent-center align-items-center px-4 my-2">
                                <div class="d-flex justify-cuntent-center align-items-center">
                                    <div for="order">From:</div>&nbsp; &nbsp;
                                    <input class="border" style="padding: 2px;" wire:model="from" type="date">
                                </div>
                                <div class="d-flex justify-cuntent-center align-items-center mx-4">
                                    <div for="order">To:</div>&nbsp; &nbsp;
                                    <input class="border " style="padding: 2px;" wire:model="to" type="date">
                                </div>

                                <div> <select class="border p-1" wire:model="orderstatus" wire:change="filterChange">
                                        <option value=""> Search by status</option>
                                        <option value="1"> Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="3">Shipped</option>
                                        <option value="4">Delivered</option>
                                        <option value="6">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </tr>
                        <thead>
                            <tr>
                                <th style="color:#00263a; background-color:#EDEDED; width:60px;">Sr No</th>
                                <th scope="col" style="color:#00263a; background-color:#EDEDED;">Order
                                    Date</th>
                                <th scope="col" style="color:#00263a; background-color:#EDEDED;">Order
                                    Details</th>
                                <th scope="col" style="color:#00263a; background-color:#EDEDED;">
                                    Product
                                    Value</th>
                                <th scope="col" style="color:#00263a; background-color:#EDEDED;">Ship
                                    Details</th>
                                <th scope="col" style="color:#00263a; background-color:#EDEDED;">
                                    Payment
                                    Method</th>
                                <th scope="col" style="color:#00263a; background-color:#EDEDED;">Order
                                    Status</th>
                                <th scope="col" style="color:#00263a; background-color:#EDEDED;">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row" style="color:#00263a;  width:60px;">
                                            {{ ($orders->currentpage() - 1) * $orders->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td style="color:#00263a; font-size:15px;">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d h:i a') }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div>Order - {{ $order->id }}</div>
                                                <div>
                                                    Remark-<br>
                                                    {{ $order->remark }}
                                                </div>

                                                <button class="border" wire:click="showOrderitems({{ $order->id }})"
                                                    style="color:#0d6efd;">View
                                                    order details
                                                </button>
                                                <div wire:ignore.self class="modal fade" id="exampleModal"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Details
                                                                </h5>
                                                                <button wire:click="closeModel()" type="button"
                                                                    class="border-0" data-bs-dismiss="modal"
                                                                    aria-label="Close"><i
                                                                        class="fas fa-times"></i></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($payment_details == $order->id)
                                                                    @if ($payment)
                                                                        <section>
                                                                            <div class="mainol" style="padding: 10px">
                                                                                <strong>{{ $item->product->name ?? '' }}</strong>
                                                                                <br>
                                                                                Size:{{ $item->ring_size }}<br>
                                                                            </div>
                                                                        </section>
                                                                    @endif
                                                                @endif
                                                                {{-- @if ($order_details == $order->id) --}}
                                                                @if ($orderItems)
                                                                    @foreach ($orderItems->orderItems as $item)
                                                                        <section>
                                                                            <div class="d-flex flex-column">
                                                                                @php
                                                                                    $ctr = 1;
                                                                                    $colorType = 0;
                                                                                    $color = 0;
                                                                                    $o_color = $colorType;

                                                                                    if (!$colorType) {
                                                                                        $o_color = strtolower($item->color[0]);
                                                                                    }

                                                                                @endphp
                                                                                <img style="width:120px"
                                                                                    src="{{ asset('storage/' . $item->product->image_url ?? '') }}"
                                                                                    alt="{{ $item->product->sku ?? '' }}">
                                                                                <div>
                                                                                    {{ $item->product->name ?? '' }}
                                                                                </div>
                                                                                <div class="my-2">
                                                                                    {{ $item->product->sku ?? '' }}
                                                                                </div>
                                                                                <div>Size:{{ $item->ring_size }}
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    @endforeach
                                                                @endif
                                                                {{-- @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="fas fa-rupee-sign" style="font-size: 12px;"></i>
                                            {{ $order->amount - $order->discount_amount }}
                                        </td>
                                        <td style="width:150px;">
                                            @php
                                                $address = App\Models\Address::where('user_id', $order->user_id)
                                                    ->where('address_type', 1)
                                                    ->first();
                                            @endphp
                                            <b>{{ $order->user->name ?? '' }}</b>
                                            <br>
                                            {{ $address->address_line1 ?? '' }}
                                            {{ $address->cities->name ?? '' }}, {{ $address->states->name ?? '' }}-
                                            {{ $address->pin ?? '' }}<br>
                                            {{ $address->countries->name ?? '' }}<br>
                                            {{ $address->phone ?? '' }}


                                        </td>
                                        <td>
                                            <div class="mainolhead1">
                                                <div>
                                                    {{ $order->payment_id == 1 ? 'Paid' : 'Cash on delivery' }}
                                                </div>

                                                @if ($order->payment_id != 1)
                                                    <!--<button wire:click="paymentShow({{ $order->id }})" style="color:#0d6efd;">Details</button>-->
                                                @else
                                                    Cash on Delivery
                                                @endif

                                                <!--<select  wire:model="status"-->
                                                <!--    wire:change="statusChange" style="width:100%; border:1px solid #00263a;padding:2.3px;color: #00263a; ">-->
                                                <!--    <option value="1">Paid</option>-->
                                                <!--    <option value="2">Refund in Process</option>-->
                                                <!--    <option value="3">Refunded</option>-->
                                                <!--</select>-->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mainolhead1">

                                                <select wire:model="status.{{ $order->id }}"
                                                    wire:change="statusChange({{ $order->id }})"
                                                    class="border p-1">
                                                    <option value="1"> Pending</option>
                                                    <option value="2">In Process </option>
                                                    <option value="3">Shipped</option>
                                                    <option value="4">Delivered</option>
                                                    <option value="6">Cancelled</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="border p-1" style="background-color: #00263a; ">
                                                <a style="text-decoration:none; color:white; "
                                                    href="{{ route('invoice', [$order->id]) }}">Invoice</a>
                                            </button>
                                            <button class="border px-2"
                                                wire:click="editModal({{ $order->id }})"style="background-color: green; color:white; padding:2.6px;">
                                                Update Track
                                            </button>

                                            <select wire:model="shippingCarrier.{{ $order->id }}"
                                                wire:change="carrierStatusChange({{ $order->id }})"
                                                class="border p-1">
                                                <option value=""> Select Shipping </option>
                                                <option value="DHL">DHL</option>
                                                <option value="USPS">USPS</option>
                                                <option value="UPS">UPS</option>
                                            </select><br>
                                            Tracking No-
                                            <span>{{ $order->tracking_number }}</span><br>
                                            Shipping Contact No-
                                            <span>{{ $order->shipping_carrier_contact }}</span><br>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="container flex justify-center" style=" padding: 50px 0px">
                                    <img style="width: 400px" src="{{ asset('public/images/no_data.png') }}"
                                        alt="">
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- /.card-body -->

            </div>
            <!-- /.card -->
            {{ $orders->links() }}
        </div>
    </div>

    {{-- <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
        Launch demo modal
    </button> --}}

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalTrack" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Tracking Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" wire:model="tracking_number" class="w-100 mb-3"
                        placeholder="Enter tracking Number">
                    <label for="Shipping Contact Number">Shipping Contact Number</label>
                    <input type="number" wire:model="shipping_carrier_contact" class="w-100 "
                        placeholder="Shipping Contact Number" pattern="/^-?\d+\.?\d*$/"
                        onKeyPress="if(this.value.length==10) return false;">
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="updateTracingNumber()" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            window.addEventListener('livewireOpenModal', event => {
                $("#exampleModal").modal('show');
            })
            window.addEventListener('livewireCloseModal', event => {
                $("#exampleModal").modal('hide');

            })
            window.addEventListener('livewireOpenTracking', event => {
                $("#exampleModalTrack").modal('show');
            })
            window.addEventListener('livewireCloseTracking', event => {
                $("#exampleModalTrack").modal('hide');

            })
        });
    </script>
</div>
