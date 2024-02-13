<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function single($product)
    {
        $product = Product::where('slug', $product)->first();
        return view('single', compact('product'));
    }
}
