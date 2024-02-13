<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_add_id', 'id');
    }
    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_add_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }
}
