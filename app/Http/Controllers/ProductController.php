<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function producFront($category,  $style = null, $subCategory = null)
    {
        $categoryBanner = Category::where('slug', $category)->first();
        $search = null;
        return view('products', compact('categoryBanner', 'category', 'style', 'subCategory', 'search'));
    }

    public function recentView()
    {
        return view('recent-view');
    }
}
