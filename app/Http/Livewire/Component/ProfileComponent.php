<?php

namespace App\Http\Livewire\Component;

use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileComponent extends Component
{

    public $shipping_first_name;
    public $shipping_last_name;
    public $shipping_address;
    public $shipping_telephone;
    public $shipping_postcode;
    public $shipping_city;
    public $shipping_state;
    public $shipping_country;
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $action;

    public function editAddress($edit, $userId)
    {
        $this->action = $edit;
        $address = Address::where('user_id', $userId)->where('address_type', 1)->first();
        // dd($address);
        $this->shipping_address = $address->address_line1 ?? '';
        $this->shipping_first_name = $address->first_name ?? '';
        $this->shipping_last_name = $address->last_name ?? '';
        $this->shipping_telephone = $address->phone ?? '';
        $this->shipping_postcode = $address->pin ?? '';
        $this->shipping_city = $address->city ?? '';
        $this->shipping_state = $address->state ?? '';
        $this->shipping_country = $address->country ?? '';
    }
    function back()
    {
        $this->action = null;
    }

    public function updateAdress()
    {
        Address::updateOrCreate([
            'user_id' => Auth::user()->id,
            'address_type' => 1,
        ], [
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
        return back()->with('success', 'Address updated successfully!');
    }
    public function render()
    {
        $this->states  = State::where('country_id', $this->shipping_country)->get();
        $this->cities = City::where('state_id', $this->shipping_state)->get();
        $country = Country::all();
        return view('livewire.component.profile-component', compact('country'));
    }
}
