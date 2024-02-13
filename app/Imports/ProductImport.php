<?php

namespace App\Imports;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductCategory;
use App\Models\ProductCollection;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductTag;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\SubCategory;

use App\Models\MetalType;
use App\Models\MetalColor;
use App\Models\MaterialType;
use App\Models\MetalPurity;

use App\Models\DiadondQuality;
use App\Models\DiamondCut;
use App\Models\DiamondColor;
use App\Models\DiamondShape;
use App\Models\DiamondSize;
use App\Models\DiamondSetting;

use App\Models\ColorStoneShape;
use App\Models\ColorStoneSize;
use App\Models\ColorStoneColor;
use App\Models\ColorStoneName;
use App\Models\ColorStoneSetting;
use App\Models\ColorStoneQuality;

use App\Models\Kitco;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $slug = Str::slug($row['name']) . "-" . $row['sku'];
        dd($slug);
        $ringSize = Size::where('name', $row['ring_size'])->first();
        $exist = Product::where('sku', $row['sku'])->first();
    }
}
