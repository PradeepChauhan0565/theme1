<?php

namespace App\Http\Livewire;

use App\Models\Order as ModelsOrder;
use App\Models\OrderStatus;
use App\Models\Status;
use App\Models\PaymentDetails;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;

class AdminOrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $order_details;
    public $payment_details;
    public $status = [];
    public $shippingCarrier = [];
    public $orderItems = [];
    public $payment = [];
    public $trackingNumber = [];
    public $search;
    public $from;
    public $to;
    public $orderstatus;
    public $order_id;
    public $editModalAll = false;
    public $tracking_number;
    public $shipping_carrier_contact;
    public $filter_date = null;
    public function mount()
    {
        $products = ModelsOrder::all();
        foreach ($products as $product) {
            $this->status[$product->id] = $product->status_id;
            $this->shippingCarrier[$product->id] = $product->shipping_carrier;
        }
    }
    public function editModal($id)
    {
        $this->order_id = $id;

        $tracks = ModelsOrder::find($id);
        $this->tracking_number = $tracks->tracking_number;
        $this->shipping_carrier_contact = $tracks->shipping_carrier_contact;
        $this->dispatchBrowserEvent('livewireOpenTracking');
    }
    // public function updateTracking()
    // {
    //     ModelsOrder::find($this->order_id)->update([
    //         'tracking_number' => $this->tracking_number,
    //     ]);
    //     $this->editModalAll = false;
    // }


    public function updateTracingNumber()
    {
        ModelsOrder::find($this->order_id)->update([
            'tracking_number' => $this->tracking_number,
            'shipping_carrier_contact' => $this->shipping_carrier_contact,
        ]);
        $this->dispatchBrowserEvent('livewireCloseTracking');
    }
    public function paymentShow($id)
    {
        $this->payment_details = $id;
    }

    public function showOrderitems($id)
    {
        $this->order_details = $id;
        $this->orderItems = ModelsOrder::find($id);
        $this->dispatchBrowserEvent('livewireOpenModal');
    }
    public function closeModel()
    {
        $this->dispatchBrowserEvent('livewireCloseModal');
    }

    public function statusChange($id)
    {
        //  dd($this->status[$id]);
        $data = null;
        $order = ModelsOrder::find($id);
        $payment = PaymentDetails::find($order->payment_id);
        $payment_id = $payment->payment_id;
        $amount = $order->amount - $order->discount_amount;
        if ($this->status[$id] == 7) {
            $api = new Api('rzp_live_yluxOgpCMoickH', 'IaeLN6SxbZd7zlKARjTQrzz9');
            // $api = new Api('rzp_test_SlC7r3VbQGzjQD', '2afZeFcLUQHoyX13tsm7Aqrz');
            $payment_details = $api->payment->fetch($payment_id);

            if ($payment_details->status == 'captured') {
                $refund_data = [
                    "amount" => $amount,
                    "speed" => "normal",
                    "notes" => [
                        "notes_key_1" => "order canceled",
                        "notes_key_2" => "Engage"
                    ],
                    "receipt" => "123"
                ];
                $data = $payment_details->refund($refund_data);
            }
        }
        if ($this->status[$id] == 3) {
            $user = User::find($order->user_id);
            ModelsOrder::where('id', $id)->update([
                'status_id' => $this->status[$id],
                'cancel_note' => $data->id ?? null,
            ]);

            $details = [
                'id' => $id,
                'title' => 'shipped',
                'body' => 'Your order has been shipped!',
            ];
            Mail::to($user->email)->send(new \App\Mail\SendMail($details));
        }

        if ($this->status[$id] == 4) {

            $user = User::find($order->user_id);
            ModelsOrder::where('id', $id)->update([
                'status_id' => $this->status[$id],
                'cancel_note' => $data->id ?? null,

            ]);

            $referd_user = User::find($user->referd_by);

            if ($referd_user) {
                $referd_user->fill([
                    'referral_amount' => 10,
                ]);
                $referd_user->save();

                $user->update(['referd_by' => null]);
            }

            $details = [
                'id' => $id,
                'title' => 'delivered',
                'body' => 'Your order has been delivered!',
            ];
            Mail::to($user->email)->send(new \App\Mail\SendMail($details));
        }

        if ($this->status[$id] == 6) {
            $user = User::find($order->user_id);
            ModelsOrder::where('id', $id)->update([
                'status_id' => $this->status[$id],
                'cancel_note' => $data->id ?? null,
            ]);
            $details = [
                'id' => $id,
                'title' => 'cancelled',
                'body' => 'Your order has been cancelled!',
            ];
            Mail::to($user->email)->send(new \App\Mail\SendMail($details));
        }

        if ($this->status[$id] == 1) {
            ModelsOrder::where('id', $id)->update([
                'status_id' => $this->status[$id],
                'cancel_note' => $data->id ?? null,

            ]);
            OrderStatus::create([
                'order_id' => $id,
                'status_id' => $this->status[$id],
            ]);
        }
        ModelsOrder::where('id', $id)->update([
            'status_id' => $this->status[$id],
            'cancel_note' => $data->id ?? null,

        ]);
        OrderStatus::create([
            'order_id' => $id,
            'status_id' => $this->status[$id],
        ]);
    }

    public function carrierStatusChange($id)
    {
        ModelsOrder::where('id', $id)->update([
            'shipping_carrier' => $this->shippingCarrier[$id],

        ]);
    }

    public function filterChange()
    {
    }

    public function render()
    {

        return view(
            'livewire.admin-order-component',
            [

                'orders' => ModelsOrder::orderBy('id', 'desc')
                    ->when($this->search, function ($qs) {
                        $qs->where('id', 'LIKE', '%' . $this->search . '%');
                        $qs->orWhere(function ($q) {
                            $q->whereHas('user', function ($q) {
                                $q->where('name', 'LIKE', '%' . $this->search . '%');
                            });
                        });
                    })

                    ->when($this->from, function ($q) {
                        $q->whereDate('created_at', '>=', $this->from);
                    })
                    ->when($this->to, function ($q) {
                        $q->whereDate('created_at', '<=', $this->to);
                    })

                    ->when(
                        $this->orderstatus,
                        function ($q) {
                            $q->where('status_id', $this->orderstatus);
                        }
                    )

                    ->paginate(20),
            ]
        );
    }
}
