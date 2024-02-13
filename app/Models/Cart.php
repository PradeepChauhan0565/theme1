<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    // public function product()
    // {
    //     return $this->belongsToMany(Product::class, 'product_id', 'id');
    // }
}
