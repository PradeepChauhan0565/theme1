<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\ProductImage;
use App\Models\SubCategory;

use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function invoice()
    {
        return view('order');
    }

    public function search(Request $request)
    {

        $sku = null;
        // $style_id = null;
        $sub_category = null;
        $category = null;
        $category_type = null;
        $subCategory = null;
        $search = $request->search;
        // Search::create([
        //     'search' => $request->search,
        // ]);
        $categoryBanner = Category::where('id', 1)->first();
        return view('products', compact('categoryBanner', 'category', 'category_type', 'sub_category', 'search', 'sku'));
    }
    public function producFront($category,  $style = null, $subCategory = null)
    {

        $category = Category::where('slug', $category)->first();
        $category_type = CategoryType::where('slug', $style)->first();
        $sub_category = SubCategory::where('slug', $subCategory)->first();
        // dd($category);
        $categoryBanner = Category::where('slug', $category)->first();
        $search = null;
        return view('products', compact('categoryBanner', 'category', 'category_type', 'sub_category', 'search'));
    }
    public function recentView()
    {

        return view('recent-view');
    }

    public function singleImage($product_id, $color_id)
    {
        $productImage = ProductImage::where('product_id', $product_id)
            ->where('image_color_id', $color_id)
            ->get();
        return view('singleImage', compact('productImage'));
    }
}
