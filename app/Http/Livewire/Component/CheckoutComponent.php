<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\ContactDetails;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderItem;
use App\Models\PaymentDetails;
use App\Models\Product;
use App\Models\State;
use App\Models\Tax;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PDF;

class CheckoutComponent extends Component
{
    public $shipping_first_name;
    public $shipping_last_name;
    public $billing_first_name;
    public $billing_last_name;
    public $email;
    public $password;
    public $password_confirmation;
    public $shipping_address;
    public $billing_address;
    public $shipping_telephone;
    public $shipping_postcode;
    public $shipping_city;
    public $shipping_state;
    public $shipping_country = 233;
    public $billing_telephone;
    public $billing_postcode;
    public $billing_city;
    public $billing_state;
    public $billing_country;
    public $same_billing_as_shipment;
    public  $comments;
    public $tab = 1;
    public $current_tab = 1;
    public $country;
    public $state;
    public $city;
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $billingStates = [];
    public $billingCities = [];
    public $card_name;
    public $card_number;
    public $month;
    public $year;
    public $cvc;
    public $tax = 0;
    public $disable_payment_button = 0;
    public $errorMsg;
    public $full_name = null;
    public $user_email = null;
    public $order_id;
    public $coupan_code;
    public $g_total;
    public $cartItems = [];
    public $sub_total = 0;
    public $total = 0;


    public function mount($payment_id = null)
    {
        if ($payment_id) {
            $this->paymentMode($payment_id, 2);
        }
        $this->fetch();
        $this->states  = State::where('country_id', $this->shipping_country)->get();
        $this->cities = City::where('state_id', $this->shipping_state)->get();
        if (Auth::check()) {
            $this->user_email = Auth::user()->email;
        }
        if (session()->has('coupan')) {
            $this->coupanCode(1);
        }
    }



    public function fetch()
    {
        if (Auth::check()) {
            $address = Address::where('user_id', Auth::user()->id)->where('address_type', 1)->first();
            if ($address) {
                $this->shipping_address = $address->address_line1;
                $this->shipping_first_name = $address->first_name;
                $this->shipping_last_name = $address->last_name;
                $this->shipping_telephone = $address->phone;
                $this->shipping_postcode = $address->pin;
                $this->shipping_city = $address->city;
                $this->shipping_state = $address->state;
                $this->shipping_country = $address->country ?? 233;
            }
        }
    }

    public function currency()
    {
        if (session()->has('currency')) {
            return Currency::find(session()->get('currency'));
        } else {
            return Currency::where('status', 1)->first();
        }
    }

    // public function products()
    // {
    //     $ids = [];
    //     if (session()->has('cart')) {
    //         foreach (session()->get('cart') as $item) {
    //             $ids[] = $item['product_id'];
    //             Cart::create([
    //                 'product_id' => $item['product_id'],
    //                 'user_id' => Auth::user()->id,
    //                 'ring_size' => $item['ring_size'],
    //                 'metal_quality' => $item['metal'],
    //                 'quantity' => 1,
    //             ]);
    //         }
    //         return Product::whereIn('id', $ids)->get();
    //     }
    //     return Product::where('id', 0)->get();
    // }

    public function login()
    {
        $validatedDate = $this->validate([

            'email' => 'required|email',

            'password' => 'required',

        ]);



        if (Auth::attempt(array('email' => $this->email, 'password' => $this->password))) {

            session()->flash('message', "You are Login successful.");
        } else {

            session()->flash('error', 'email and password are wrong.');
        }
        $this->fetch();
    }

    public function register()
    {

        $this->validate([
            'shipping_first_name' => 'required',
            'shipping_last_name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'shipping_address' => 'required',
            'shipping_telephone' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_country' => 'required',
        ]);
        DB::transaction(function () {
            $name = $this->shipping_first_name . " " . $this->shipping_last_name;
            $user = User::create([
                'name' => $name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            Auth::login($user);
            Address::create([
                'user_id' => $user->id,
                'address_line1' => $this->shipping_address,
                'first_name' => $this->shipping_first_name,
                'last_name' => $this->shipping_last_name,
                'phone' => $this->shipping_telephone,
                'pin' => $this->shipping_postcode,
                'city' => $this->shipping_city,
                'state' => $this->shipping_state,
                'country' => $this->shipping_country,
                'address_type' => 1,
            ]);
            // Address::create([
            //     'user_id' => $user->id,
            //     'address_line1' => $this->billing_address,
            //     'first_name' => $this->billing_first_name,
            //     'last_name' => $this->billing_last_name,
            //     'phone' => $this->billing_telephone,
            //     'pin' => $this->billing_postcode,
            //     'city' => $this->billing_city,
            //     'state' => $this->billing_state,
            //     'country' => $this->billing_country,
            //     'address_type' => 2,
            // ]);
        });

        $this->fetch();
    }
    public function mycheck()
    {
        if ($this->same_billing_as_shipment) {
            $this->billingStates = State::where('country_id', $this->shipping_country)->get();
            $this->billingCities = City::where('state_id', $this->shipping_state)->get();
            $this->billing_address = $this->shipping_address;
            $this->billing_telephone = $this->shipping_telephone;
            $this->billing_first_name = $this->shipping_first_name;
            $this->billing_last_name = $this->shipping_last_name;
            $this->billing_postcode = $this->shipping_postcode;
            $this->billing_city = $this->shipping_city;
            $this->billing_state = $this->shipping_state;
            $this->billing_country = $this->shipping_country;
        } else {
            $this->billing_first_name = null;
            $this->billing_last_name = null;
            $this->billing_address = null;
            $this->billing_telephone = null;
            $this->billing_postcode = null;
            $this->billing_city = null;
            $this->billing_state = null;
            $this->billing_country = null;
        }
    }
    public function tab($tab)
    {
        if ($tab <= $this->current_tab) {
            $this->tab = $tab;
        }
    }

    public function placeOrder1()
    {
        $this->tab = 2;
        $this->current_tab = 2;
    }
    public function placeOrder()
    {
        $tax = null;
        $g_total = null;
        $this->validate([
            'shipping_first_name' => 'required',
            'shipping_last_name' => 'required',
            'billing_first_name' => 'required',
            'billing_last_name' => 'required',
            'shipping_address' => 'required',
            'shipping_telephone' => 'required',
            // 'shipping_city' => 'required',
            'shipping_state' => 'required',
            // 'shipping_country' => 'required',
            'billing_address' => 'required',
            'billing_telephone' => 'required',
            // 'billing_city' => 'required',
            // 'billing_state' => 'required',
            // 'billing_country' => 'required',
        ]);
        if (session()->has('cart')) {
            foreach (session()->get('cart') as $item) {
                $ids[] = $item['product_id'];
                $cart = Cart::where('product_id', $item['product_id'])
                    ->where('user_id', Auth::user()->id)
                    ->where('ring_size', $item['ring_size'])
                    ->where('metal_quality', $item['metal'])
                    ->where('color', $item['color'])->first();

                Cart::updateOrCreate(
                    [
                        'product_id' => $item['product_id'],
                        'user_id' => Auth::user()->id,
                        'ring_size' => $item['ring_size'],
                        'metal_quality' => $item['metal'],
                        'color' => $item['color'],

                    ],
                    [
                        'product_id' => $item['product_id'],
                        'user_id' => Auth::user()->id,
                        'ring_size' => $item['ring_size'],
                        'metal_quality' => $item['metal'],
                        'quantity' => $item['qty'],
                        'price' => $item['price'],
                        'color' => $item['color'],

                    ]
                );
                $product = Product::find($item['product_id']);
                $g_total = $g_total + ($product->regular_price - $product->regular_price * $product->perc_discount / 100) * $item['qty'];
            }
        }
        if (session()->has('coupan_price')) {
            $coupan_price = session()->get('coupan_price');
            $g_total = $g_total - $coupan_price;
        }
        $address = Address::where('user_id', Auth::user()->id)->where('address_type', 1)->first();
        $address1 = Address::where('user_id', Auth::user()->id)->where('address_type', 2)->first();
        if (Auth::check()) {
            if (!$address) {
                Address::create([
                    'user_id' => Auth::user()->id,
                    'address_line1' => $this->shipping_address,
                    'first_name' => $this->shipping_first_name,
                    'last_name' => $this->shipping_last_name,
                    'phone' => $this->shipping_telephone,
                    'pin' => $this->shipping_postcode,
                    'city' => $this->shipping_city,
                    'state' => $this->shipping_state,
                    'country' => $this->shipping_country,
                    'address_type' => 1,
                ]);
            } else {
                Address::where('user_id', Auth::user()->id)->where('address_type', 1)->update([
                    'address_line1' => $this->shipping_address,
                    'first_name' => $this->shipping_first_name,
                    'last_name' => $this->shipping_last_name,
                    'phone' => $this->shipping_telephone,
                    'pin' => $this->shipping_postcode,
                    'city' => $this->shipping_city,
                    'state' => $this->shipping_state,
                    'country' => $this->shipping_country,
                ]);
            }
        }
        if ($address1) {
            Address::where('user_id', Auth::user()->id)->where('address_type', 2)->update([
                'user_id' => Auth::user()->id,
                'address_line1' => $this->billing_address,
                'first_name' => $this->billing_first_name,
                'last_name' => $this->billing_last_name,
                'phone' => $this->billing_telephone,
                'pin' => $this->billing_postcode,
                'city' => $this->billing_city,
                'state' => $this->billing_state,
                'country' => $this->billing_country,
                'address_type' => 2,
            ]);
        } else {
            $add =   Address::create([
                'user_id' => Auth::user()->id,
                'address_line1' => $this->billing_address,
                'first_name' => $this->billing_first_name,
                'last_name' => $this->billing_last_name,
                'phone' => $this->billing_telephone,
                'pin' => $this->billing_postcode,
                'city' => $this->billing_city,
                'state' => $this->billing_state,
                'country' => $this->billing_country,
                'address_type' => 2,
            ]);
        }
        session()->put('comments', $this->comments);
        session()->put('state', $this->billing_state);
        $this->tab = 2;
        $this->current_tab = 2;
        $state = State::find($this->shipping_state);
        if ($state)
            $tax = Tax::where('state', $state->name)->first();
        if ($tax) {
            $this->tax = $tax->state_tax_rate;
        }
        // $this->createOrder(1);

        $this->g_total = $g_total;
    }
    public function generateOrderId($g_total)
    {
        // $api = new Api('rzp_live_yluxOgpCMoickH', 'IaeLN6SxbZd7zlKARjTQrzz9');

        $api = new Api('rzp_test_SlC7r3VbQGzjQD', '2afZeFcLUQHoyX13tsm7Aqrz');

        $data = $api->order->create(array('receipt' => '123', 'amount' => ($g_total * 100), 'currency' => 'USD', 'notes' => array('key1' => 'value3', 'key2' => 'value2')));

        $this->order_id = $data->id;
    }

    public function makePayment()
    {

        // $api = new Api('rzp_live_yluxOgpCMoickH', 'IaeLN6SxbZd7zlKARjTQrzz9');

        $api = new Api('rzp_test_SlC7r3VbQGzjQD', '2afZeFcLUQHoyX13tsm7Aqrz');

        $data = $api->order->create(array('receipt' => '123', 'amount' => ($this->g_total * 100), 'currency' => 'USD', 'notes' => array('key1' => 'value3', 'key2' => 'value2')));

        $this->order_id = $data->id;
        $this->dispatchBrowserEvent('callPayment', ['ammount' => $this->g_total]);
    }

    public function paymentMode($payment_id, $payment_mode_id)
    {
        // $this->tab = 4;
        // $this->current_tab = 4;
        $this->disable_payment_button = 1;

        $this->createOrder($payment_id, $payment_mode_id);
    }

    public function getPayment()
    {
        // dd($this->stripeToken);
        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Stripe\Charge::create([
        //     "amount" => 100 * 150,
        //     "currency" => "inr",
        //     "source" => $this->stripeToken,
        //     "description" => "Making test payment."
        // ]);

        // Session::flash('success', 'Payment has been successfully processed.');
    }

    public function createOrder($payment_id, $payment_mode_id)
    {

        $this->validate([
            'shipping_first_name' => 'required',
            'shipping_last_name' => 'required',
            'billing_first_name' => 'required',
            'billing_last_name' => 'required',
            'shipping_address' => 'required',
            'shipping_telephone' => 'required',
            // 'shipping_city' => 'required',
            'shipping_state' => 'required',
            // 'shipping_country' => 'required',
            'billing_address' => 'required',
            'billing_telephone' => 'required',
            // 'billing_city' => 'required',
            // 'billing_state' => 'required',
            // 'billing_country' => 'required',
        ]);
        // try {
        DB::transaction(function () use ($payment_id, $payment_mode_id) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            $address = Address::where('user_id', Auth::user()->id)->where('address_type', 1)->first();
            $total = 0;
            $coupan_price = 0;
            $coupan_code = null;
            $total_sale_discount_price = 0;
            foreach ($carts as $item) {
                $product = Product::find($item->product_id);

                $sale_discount_price = $product->regular_price * $product->perc_discount / 100;
                $total_sale_discount_price += $sale_discount_price;
                $total = $total + ($item->price - $sale_discount_price) * $item->quantity;
            }
            if (session()->has('coupan_price')) {
                $coupan_price = session()->get('coupan_price');
            }
            if (session()->has('coupan')) {
                $coupan_code = session()->get('coupan');
            }

            $payment = PaymentDetails::create([
                'order_id' => 0,
                'amount' => $total,
                'provider' => $payment_mode_id,
                'status_id' => 1,
                'payment_id' => $payment_id,
                'currency' => 'USD',
            ]);


            if (Auth::check()) {
                if (!$address) {
                    Address::create([
                        'user_id' => Auth::user()->id,
                        'address_line1' => $this->shipping_address,
                        'first_name' => $this->shipping_first_name,
                        'last_name' => $this->shipping_last_name,
                        'phone' => $this->shipping_telephone,
                        'pin' => $this->shipping_postcode,
                        'city' => $this->shipping_city,
                        'state' => $this->shipping_state,
                        'country' => $this->shipping_country,
                        'address_type' => 1,
                    ]);
                }
            }
            $add =   Address::create([
                'user_id' => Auth::user()->id,
                'address_line1' => $this->billing_address,
                'first_name' => $this->billing_first_name,
                'last_name' => $this->billing_last_name,
                'phone' => $this->billing_telephone,
                'pin' => $this->billing_postcode,
                'city' => $this->billing_city,
                'state' => $this->billing_state,
                'country' => $this->billing_country,
                'address_type' => 2,
            ]);


            $order = Order::create([
                'user_id' => Auth::user()->id,
                'payment_id' => $payment->id,
                'billing_add_id' => $add->id,
                'shipping_add_id' => $add->id,
                'amount' => $total,
                'status_id' => 1,
                'discount_amount' => $coupan_price,
                'remark' => $this->comments . $coupan_code,

            ]);
            OrderStatus::create([
                'order_id' => $order->id,
                'status_id' => 1,
            ]);
            $ids = [];
            foreach ($carts as $item) {
                $ids[] = $item->product_id;
                $product = Product::find($item->product_id);

                $sale_discount_price = $product->regular_price * $product->perc_discount / 100;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price - $sale_discount_price,
                    'ring_size' => $item->ring_size,
                    'metal_quality' => $item->metal_quality,
                    'color' => $item->color,
                ]);
            }
            $details = [
                'title' => 'order',
            ];

            $order_no = $order->id;
            $data["email"] = "developerpradeep845@gmail.com";
            $data["order_no"] = $order->id;
            $data["ids"] = $ids;
            $data["coupan_price"] = $coupan_price;
            $data["coupan_code"] = $coupan_code;
            $products = Product::whereIn('id', $ids)->get();

            $pdf = PDF::loadView('order-mails.order_pdf', compact('products', 'ids', 'order_no', 'coupan_price', 'coupan_code'));
            Mail::send('order-mails.order', $data, function ($message) use ($data, $pdf) {
                $message->to([$data["email"], 'developerpradeep845@gmail.com', Auth::user()->email])
                    ->subject('Order Confirmation')
                    ->attachData($pdf->output(), "order.pdf");
            });

            $carts = Cart::where('user_id', Auth::user()->id)->delete();
            $this->tab = 3;
            $this->current_tab = 3;
            session()->forget('cart');
            Coupon::where('code', session()->get('coupan'))->where('coupan_type', 2)->update(['status' => 0]);
            session()->forget('coupan_price');
            session()->forget('coupan');
        });
        // } catch (\Exception $ex) {
        //     $this->errorMsg = "Geting Error...";
        // }
    }

    public function country()
    {
        if (session()->has('currency')) {
            $currency = Currency::find(session()->get('currency'));
        } else {
            $currency = Currency::where('status', 1)->first();
        }
        if ($currency->id == 1) {
            $this->countries = Country::where('id', 233)->get();
        } elseif ($currency->id == 2) {
            $this->countries = Country::where('id', 101)->get();
        } else {
            $this->countries = Country::all();
        }
    }

    public function CountryChange()
    {
        $this->states  = State::where('country_id', $this->shipping_country)->get();
    }

    public function updatedShippingState()
    {
        $this->cities = City::where('state_id', $this->shipping_state)->get();
    }

    public function billingCountryChange()
    {
        $this->billingStates = State::where('country_id', $this->billing_country)->get();
    }

    public function billingstateChange()
    {
        $this->billingCities = City::where('state_id', $this->billing_state)->get();
    }

    public function coupanCode($id)
    {
        $this->resetErrorBag();
        $first_coupan = Coupon::where('code', $this->coupan_code)->where('status', 1)->where('coupan_type', 1)->first();
        $order = Order::where('user_id', Auth::user()->id)->first();

        if ($order && $first_coupan) {

            $this->addError('coupan_code', 'Coupan code not valid...');
        } else {

            $ids = [];
            $products = [];
            $total = 0;
            if (session()->has('cart')) {
                foreach (session()->get('cart') as $item) {
                    $ids[] = $item['product_id'];
                }
                $products = Product::whereIn('id', $ids)->get();
            }
            foreach ($products as $product) {
                $total += ($product->regular_price - $product->regular_price * $product->perc_discount / 100);
            }

            if (session()->has('coupan')) {
                $coupan_code = session()->get('coupan');
                $coupan = Coupon::where('code', $coupan_code)->where('status', 1)->first();
                $this->coupan_code = $coupan_code;
            } else {
                $coupan = Coupon::where('code', $this->coupan_code)->where('status', 1)->first();
            }

            if ($coupan && ($coupan->min_amount <= $total)) {
                if ($coupan->type == 'percen') {
                    $coupan_price =  round($total * $coupan->value / 100);
                    session()->put('coupan_price', round($coupan_price));
                    session()->put('coupan', $this->coupan_code);
                } else {
                    $coupan_price =   $total - $coupan->value;
                    session()->put('coupan_price', $coupan->value);
                    session()->put('coupan', $this->coupan_code);
                }
            } else {
                $this->addError('coupan_code', 'Coupan code not valid...');
            }
        }
    }
    public function render()
    {
        // dd(ContactDetails::first());
        $this->countries = Country::all();
        $this->states  = State::where('country_id', $this->shipping_country)->get();
        $this->cities = City::where('state_id', $this->shipping_state)->get();
        $this->cartItems = Cart::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->get();
        $this->sub_total = 0;
        $this->total = 0;
        $this->tax = 0;
        foreach ($this->cartItems as $item) {
            $this->sub_total += $item->product->amount * $item->quantity;
        }
        $this->total = $this->sub_total - $this->tax;

        return view(
            'livewire.component.checkout-component',
            [
                'contact' => ContactDetails::first(),

                // 'products' => $this->products(),
                // 'currency' => $this->currency(),
            ]
        );
    }
}
