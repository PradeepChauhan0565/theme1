<?php

namespace App\Http\Livewire;

use App\Models\Order;
// use App\Models\GiftCard;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrderComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $order_details;
    public $payment_details;
    public $status = [];
    public $orderItems = [];
    public $payment = [];
    public $cancelMsg = null;
    public $cancelOrderId;

    public function mount()
    {
        $products = Order::all();
        foreach ($products as $product) {
            $this->status[$product->id] = $product->status_id;
        }
    }

    public function cancelOrder($id)
    {
        Order::where('id', $id)->update([
            'status_id' => 3,
            'cancel_note' => 'Order has been cancelled',
        ]);
        $this->cancelOrderId = $id;
        $this->cancelMsg = "Order has been cancelled";
    }

    public function showOrderitems($id)
    {
        $this->order_details = $id;
        $this->orderItems = Order::find($id);
        $this->status[$id];
        $this->dispatchBrowserEvent('livewireOpenModal');
    }

    public function render()
    {
        return view('livewire.user-order-component', [
            'orders' => Order::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->paginate(10),
            // 'gifts' => GiftCard::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->paginate(10),
        ]);
    }
}
