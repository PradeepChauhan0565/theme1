<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\ContactDetails;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderItems = [];

    public function invoice($id)
    {
        $contacts = ContactDetails::first();
        $order = Order::where('id', $id)->first();
        $paymentdetails = PaymentDetails::where('id', $order->payment_id)->first();
        return view('invoice', compact('order', 'contacts', 'paymentdetails'));
    }
    public function downloadInvoice($id)
    {
        $contacts = ContactDetails::first();
        $order = Order::where('id', $id)->first();
        $paymentdetails = PaymentDetails::where('id', $order->payment_id)->first();
        $pdf = PDF::loadView('invoice_pdf', compact('order', 'contacts', 'paymentdetails'));
        return $pdf->download('invoice.pdf');
    }

    public function tracking($id)
    {
        $order = Order::where('id', $id)->first();
        $orderItems = Order::find($id);
        // dd( $this->orderItems);
        $order_statuses = OrderStatus::where('order_id', $id)->pluck('status_id')->toArray();
        // dd($order_statuses);
        return view('tracking', compact('order', 'order_statuses', 'orderItems'));
    }
    public function orders()
    {
        return view('order');
    }
}
