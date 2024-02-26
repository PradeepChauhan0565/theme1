<?php

namespace App\Http\Livewire;

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
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Models\Cart;
use App\Models\Setting;
use App\Models\Wishlist;

class ProductComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $status = [];
    public $delete;



    public $sku;
    public $name;
    public $regular_price;
    public $sale_price;
    public $short_desc;
    public $long_desc;
    public $image_color_id;
    public $productSize_id;

    public $product_id;
    public $pt_id;

    public $action;
    public $category_id;
    public $categorytype_id;
    public $sub_category_id;

    //material type
    public $material_type_id;
    //metal
    public $metal_id;
    public $metalQualitiy_id;
    public $metalColor_id;
    public $metalWeight;
    public $metalPrice;
    //diamond
    public $diamondQuality_id;
    public $diamondColor_id;
    public $diamondShape_id;
    public $diamondSize_id;
    public $diamondSetting_id;
    public $diamondWeight;
    public $diamondPrice;
    public $diamondQty;
    public $diamondCenterStone_id;

    //colorstone
    public $colorStoneColor_id;
    public $colorStoneShape_id;
    public $colorStoneSize_id;
    public $colorStoneSetting_id;
    public $colorStoneName_id;
    public $colorStoneWeight;
    public $colorStonePrice;
    public $colorStoneQty;
    public $colorStoneCenterStone_id;


    public $whiteImages = [];
    public $whiteOldImage = [];
    public $whiteVideo;
    public $whiteOldVideo;

    public $roseImages = [];
    public $roseOldImage = [];
    public $roseVideo;
    public $roseOldVideo;


    public $yelloIimages = [];
    public $yellowOldImage = [];
    public $yellowVideo;
    public $yellowOldVideo;

    public $is_main_image = [];
    public $deleteproduct;

    public $excelFile;



    function add($action)
    {
        $this->action = $action;

        $this->product_id = null;
        $this->pt_id = null;
        $this->deleteproduct = null;
        //product
        $this->sku = null;
        $this->name = null;
        $this->regular_price = null;
        $this->sale_price = null;
        $this->short_desc = null;
        $this->long_desc = null;
        $this->productSize_id = null;
        //category
        $this->category_id = null;
        $this->categorytype_id = null;
        $this->sub_category_id = null;

        $this->material_type_id = null;
        //metal
        $this->metal_id = null;
        $this->metalQualitiy_id = null;
        $this->metalColor_id = null;
        $this->metalWeight = null;
        $this->metalPrice = null;
        //diamond
        $this->diamondQuality_id = null;
        $this->diamondColor_id = null;
        $this->diamondShape_id = null;
        $this->diamondSize_id = null;
        $this->diamondSetting_id = null;
        $this->diamondWeight = null;
        $this->diamondPrice = null;
        $this->diamondQty = null;
        $this->diamondCenterStone_id = null;
        //colorstone
        $this->colorStoneColor_id = null;
        $this->colorStoneShape_id = null;
        $this->colorStoneSize_id = null;
        $this->colorStoneSetting_id = null;
        $this->colorStoneName_id = null;
        $this->colorStoneWeight = null;
        $this->colorStonePrice = null;
        $this->colorStoneQty = null;
        $this->colorStoneCenterStone_id = null;
        //white images
        $this->whiteImages = [];
        $this->whiteVideo = null;
        $this->whiteOldVideo = null;
        //rose images
        $this->roseImages = [];
        $this->roseVideo = null;
        $this->roseOldVideo = null;
        //yellow images
        $this->yelloIimages = [];
        $this->yellowVideo = null;
        $this->yellowOldVideo = null;

        $this->image_color_id = null;
        $this->whiteOldVideo = null;

        $this->is_main_image = [];
    }

    function back()
    {
        $this->action = null;
    }

    function isMainImageChange($image_id)
    {
        $image = ProductImage::find($image_id);

        Product::find($image->product_id)->update([
            'image_url' => $image->url
        ]);
    }


    public function product()
    {
        $this->validate([
            'sku' => 'required',
            'name' => 'required',
            'regular_price' => 'required',
        ], [
            'sku' => 'Sku is requared',
            'name' => 'Name is requared',
            'regular_price' => 'Regular price is requared',
        ]);
        $slug = Str::slug($this->name, "-");
        $this->product_id = Product::updateOrCreate([
            'id' => $this->pt_id,
        ], [
            'sku' => $this->sku ? $this->sku : null,
            'name' => $this->name ? $this->name : null,
            'regular_price' => $this->regular_price ? $this->regular_price : null,
            'sale_price' => $this->sale_price ? $this->sale_price : null,
            'short_desc' => $this->short_desc ? $this->short_desc : null,
            'long_desc' => $this->long_desc ? $this->long_desc : null,
            'default_image_color' => $this->image_color_id ? $this->image_color_id : null,
            'product_size_id' => $this->productSize_id ? $this->productSize_id : null,
            'slug' => $slug,
            'created_by' => Auth::user()->id
        ]);
        $this->pt_id = $this->product_id->id;
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function productCategory()
    {
        $this->validate([
            'category_id' => 'required',
            'categorytype_id' => 'required',
            'sub_category_id' => 'required',
        ], [
            'category_id' => 'Category is requared',
            'categorytype_id' => 'Category type is requared',
            'sub_category_id' => 'Subcategory is requared',
        ]);
        ProductCategory::updateOrCreate([
            'product_id' => $this->pt_id,
        ], [
            'product_id' => $this->pt_id,
            'category_id' => $this->category_id ? $this->category_id : null,
            'sub_category_header_id' => $this->categorytype_id ? $this->categorytype_id : null,
            'sub_category_id' => $this->sub_category_id ? $this->sub_category_id : null,
            'created_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function productDetail()
    {
        if ($this->material_type_id == 2) {
            ProductDetail::updateOrCreate([
                'product_id' => $this->pt_id,
                'material_type_id' => 2
            ], [
                'product_id' => $this->pt_id,
                'material_type_id' => $this->material_type_id ? $this->material_type_id : null,
                'metal_id' => $this->metal_id ? $this->metal_id : null,
                'quality_id' => $this->metalQualitiy_id ? $this->metalQualitiy_id : null,
                'color_id' => $this->metalColor_id ? $this->metalColor_id : null,
                'weight' => $this->metalWeight ? $this->metalWeight : null,
                'amount' => $this->metalPrice ? $this->metalPrice : null,
                'created_by' => Auth::user()->id
            ]);
        }
        if ($this->material_type_id == 3) {
            ProductDetail::updateOrCreate([
                'product_id' => $this->pt_id,
                'material_type_id' => 3
            ], [
                'product_id' => $this->pt_id,
                'material_type_id' => $this->material_type_id ? $this->material_type_id : null,
                'quality_id' => $this->diamondQuality_id ? $this->diamondQuality_id : null,
                'color_id' => $this->diamondColor_id  ? $this->diamondColor_id : null,
                'shape_id' =>  $this->diamondShape_id ? $this->diamondShape_id : null,
                'size_id' => $this->diamondSize_id ? $this->diamondSize_id : null,
                'setting_id' => $this->diamondSetting_id ? $this->diamondSetting_id : null,
                'weight' => $this->diamondWeight ? $this->diamondWeight : null,
                'amount' => $this->diamondPrice ? $this->diamondPrice : null,
                'qty' => $this->diamondQty ? $this->diamondQty : null,
                'center_stone' =>  $this->diamondCenterStone_id ? $this->diamondCenterStone_id : null,

                'created_by' => Auth::user()->id
            ]);
        }
        if ($this->material_type_id == 4) {
            ProductDetail::updateOrCreate([
                'product_id' => $this->pt_id,
                'material_type_id' => 4
            ], [
                'product_id' => $this->pt_id,
                'material_type_id' => $this->material_type_id ? $this->material_type_id : null,
                'color_id' => $this->colorStoneColor_id  ? $this->colorStoneColor_id : null,
                'shape_id' =>  $this->colorStoneShape_id ? $this->colorStoneShape_id : null,
                'size_id' => $this->colorStoneSize_id ? $this->colorStoneSize_id : null,
                'setting_id' => $this->colorStoneSetting_id ? $this->colorStoneSetting_id : null,
                'weight' => $this->colorStoneWeight ? $this->colorStoneWeight : null,
                'amount' => $this->colorStonePrice ? $this->colorStonePrice : null,
                'qty' => $this->colorStoneQty ? $this->colorStoneQty : null,
                'stone_name_id' =>  $this->colorStoneName_id ? $this->colorStoneName_id : null,
                'center_stone' =>  $this->colorStoneCenterStone_id ? $this->colorStoneCenterStone_id : null,

                'created_by' => Auth::user()->id
            ]);
        }

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function productImage()
    {
        $wcount = 1;
        $rcount = 1;
        $ycount = 1;
        $month = strtolower(date('M'));
        $year = strtolower(date('y'));

        if ($this->whiteImages) {
            foreach ($this->whiteImages as $image) {
                $imageName =  $image->getClientOriginalName();
                $imageUrl = $image->storeAs('products/' . $month . '_' . $year, $imageName, 'public');

                $videoUrl = 0;
                if ($this->whiteVideo) {
                    $videoName =  $this->whiteVideo->getClientOriginalName();
                    $videoUrl = $image->storeAs('products/' . $month . '_' . $year, $videoName, 'public');
                }
                ProductImage::create(
                    [
                        'product_id' => $this->pt_id,
                        'image_color_id' => 'w',
                        'url' => $imageUrl ? $imageUrl : null,
                        'sr_no' => $wcount ? $wcount : null,
                        'is_video' => $videoUrl ? $videoUrl : null,
                        'created_by' => Auth::user()->id
                    ]
                );
                $wcount++;
            }
        }
        if ($this->roseImages) {
            foreach ($this->roseImages as $image) {
                $imageName =  $image->getClientOriginalName();
                $imageUrl = $image->storeAs('products/' . $month . '_' . $year, $imageName, 'public');

                $videoUrl = 0;
                if ($this->roseVideo) {
                    $videoName =  $this->roseVideo->getClientOriginalName();
                    $videoUrl = $image->storeAs('products/' . $month . '_' . $year, $videoName, 'public');
                }
                ProductImage::create(
                    [
                        'product_id' => $this->pt_id,
                        'image_color_id' => 'r',
                        'sr_no' => $rcount ? $rcount : null,
                        'url' => $imageUrl ? $imageUrl : null,
                        'is_video' => $videoUrl ? $videoUrl : null,
                        'created_by' => Auth::user()->id
                    ]
                );
                $rcount++;
            }
        }
        if ($this->yelloIimages) {
            foreach ($this->yelloIimages as $image) {
                $imageName =  $image->getClientOriginalName();
                $imageUrl = $image->storeAs('products/' . $month . '_' . $year, $imageName, 'public');

                $videoUrl = 0;
                if ($this->yellowVideo) {
                    $videoName =  $this->yellowVideo->getClientOriginalName();
                    $videoUrl = $image->storeAs('products/' . $month . '_' . $year, $videoName, 'public');
                }
                ProductImage::create(
                    [
                        'product_id' => $this->pt_id,
                        'image_color_id' => 'y',
                        'sr_no' => $ycount ? $ycount : null,
                        'url' => $imageUrl ? $imageUrl : null,
                        'is_video' => $videoUrl ? $videoUrl : null,
                        'created_by' => Auth::user()->id
                    ]
                );
                $ycount++;
            }
        }


        $this->whiteImages = [];
        $this->roseImages = [];
        $this->yelloIimages = [];

        $this->dispatchBrowserEvent('livewireUpdated');
    }
    public function removeWhiteImage($index)
    {
        unset($this->whiteImages[$index]);
    }
    public function removeRoseImage($index)
    {
        unset($this->roseImages[$index]);
    }
    public function removeYellowImage($index)
    {
        unset($this->yelloIimagesImages[$index]);
    }
    public function removeWhiteVideo()
    {
        ProductImage::where('product_id', $this->pt_id)->where('image_color_id', 'w')->update([
            'is_video' => null,
        ]);
    }
    public function removeRoseVideo()
    {
        ProductImage::where('product_id', $this->pt_id)->where('image_color_id', 'r')->update([
            'is_video' => null,
        ]);
    }
    public function removeYellowVideo()
    {
        ProductImage::where('product_id', $this->pt_id)->where('image_color_id', 'y')->update([
            'is_video' => null,
        ]);
    }
    public function removeWhiteOldImage($id)
    {
        if ($id != null) {
            $images = ProductImage::find($id);
            $images->delete();
        }
    }
    public function removeOldRoseImage($id)
    {
        if ($id != null) {
            $images = ProductImage::find($id);
            $images->delete();
        }
    }
    public function removeOldYellowImage($id)
    {
        if ($id != null) {
            $images = ProductImage::find($id);
            $images->delete();
        }
    }
    public function edit($editAction, $id)
    {
        $this->pt_id = $id;
        $products = Product::find($id);
        $this->sku = $products->sku ?? '';
        $this->name = $products->name ?? '';
        $this->regular_price = $products->regular_price ?? '';
        $this->sale_price = $products->sale_price ?? '';
        $this->short_desc = $products->short_desc ?? '';
        $this->long_desc = $products->long_desc ?? '';
        $this->productSize_id = $products->product_size_id ?? '';

        $productCategories = ProductCategory::where('product_id', $this->pt_id)->get();
        foreach ($productCategories as $productCategory) {
            $this->category_id = $productCategory->category_id ?? '';
            $this->categorytype_id = $productCategory->sub_category_header_id ?? '';
            $this->sub_category_id = $productCategory->sub_category_id ?? '';
        }

        $productMetalDetails = ProductDetail::where('product_id', $this->pt_id)->where('material_type_id', 2)->get();
        foreach ($productMetalDetails as $metalDetail) {
            $this->material_type_id = $metalDetail->material_type_id ?? '';
            $this->metal_id = $metalDetail->metal_id ?? '';
            $this->metalQualitiy_id = $metalDetail->quality_id ?? '';
            $this->metalColor_id = $metalDetail->color_id ?? '';
            $this->metalWeight = $metalDetail->weight ?? '';
            $this->metalPrice = $metalDetail->amount ?? '';
        }
        $productDiamondDetails = ProductDetail::where('product_id', $this->pt_id)->where('material_type_id', 3)->get();
        foreach ($productDiamondDetails as $diamondDetail) {
            $this->material_type_id = $diamondDetail->material_type_id ?? '';
            $this->diamondQuality_id = $diamondDetail->quality_id ?? '';
            $this->diamondColor_id = $diamondDetail->color_id ?? '';
            $this->diamondShape_id = $diamondDetail->shape_id ?? '';
            $this->diamondSize_id = $diamondDetail->size_id ?? '';
            $this->diamondSetting_id = $diamondDetail->setting_id ?? '';
            $this->diamondWeight = $diamondDetail->weight ?? '';
            $this->diamondPrice = $diamondDetail->amount ?? '';
            $this->diamondQty = $diamondDetail->qty ?? '';
            $this->diamondCenterStone_id = $diamondDetail->center_stone ?? '';
        }

        $productColorStoneDetails = ProductDetail::where('product_id', $this->pt_id)->where('material_type_id', 4)->get();
        foreach ($productColorStoneDetails as $colorStoneDetail) {
            $this->material_type_id = $colorStoneDetail->material_type_id ?? '';
            $this->colorStoneColor_id = $colorStoneDetail->color_id ?? '';
            $this->colorStoneShape_id = $colorStoneDetail->shape_id ?? '';
            $this->colorStoneSize_id = $colorStoneDetail->size_id ?? '';
            $this->colorStoneSetting_id = $colorStoneDetail->setting_id ?? '';
            $this->colorStoneWeight = $colorStoneDetail->weight ?? '';
            $this->colorStonePrice = $colorStoneDetail->amount ?? '';
            $this->colorStoneQty = $colorStoneDetail->qty ?? '';
            $this->colorStoneName_id = $colorStoneDetail->stone_name_id ?? '';
            $this->colorStoneCenterStone_id = $colorStoneDetail->center_stone ?? '';
        }
        // $productColor = ProductImage::find($id);
        // dd($productColor);
        $whiteImases = ProductImage::where('product_id', $id)->where('image_color_id', 'w')->get();
        $roseImases = ProductImage::where('product_id', $id)->where('image_color_id', 'r')->get();
        $yellowImases = ProductImage::where('product_id', $id)->where('image_color_id', 'y')->get();
        foreach ($whiteImases as $item) {
            $this->whiteOldVideo = $item->is_video ?? '';
        }
        $this->whiteOldImage = $whiteImases ?? '';

        foreach ($roseImases as $item) {
            $this->roseOldVideo = $item->is_video ?? '';
        }
        $this->roseOldImage = $roseImases ?? '';

        foreach ($yellowImases as $item) {
            $this->yellowOldVideo = $item->is_video ?? '';
        }
        $this->yellowOldImage = $yellowImases ?? '';

        $this->action = $editAction;
    }



    public function deleteConfirmation($id, $delete)
    {
        $this->deleteproduct = $id;
        $this->delete = $delete;
        $this->dispatchBrowserEvent('livewireOpenModal');
    }
    function closeModel()
    {
        $this->dispatchBrowserEvent('livewireCloseModal');
    }
    function deleteAllConfirmation()
    {
        $this->deleteproduct = null;
        $this->delete = null;
    }
    public function deleteProduct()
    {
        $wish = Wishlist::where('product_id', $this->deleteproduct)->get();
        foreach ($wish as $key => $value) {
            $value->delete();
        }
        $carts = Cart::where('product_id', $this->deleteproduct)->get();
        foreach ($carts as $key => $value) {
            $value->delete();
        }
        Product::find($this->deleteproduct)->delete();
        $productCategory = ProductCategory::where('product_id', $this->deleteproduct)->first();
        if ($productCategory != null) {
            $productCategory->delete();
        }
        $productDetail = ProductDetail::where('product_id', $this->deleteproduct)->get();
        foreach ($productDetail as $key => $value) {
            $value->delete();
        }

        $ProductImages = ProductImage::where('product_id', $this->deleteproduct)->get();
        foreach ($ProductImages as $key => $value) {
            $value->delete();
        }
        return redirect(request()->header('Referer'));
        $this->dispatchBrowserEvent('livewireCloseModal');
        $this->delete = null;
    }
    function deleteAllProduct()
    {
        Wishlist::whereNotNull('id')->delete();
        Cart::whereNotNull('id')->delete();
        Product::whereNotNull('id')->delete();
        ProductCategory::whereNotNull('id')->delete();
        ProductDetail::whereNotNull('id')->delete();
        ProductImage::whereNotNull('id')->delete();

        return redirect(request()->header('Referer'));
        $this->dispatchBrowserEvent('livewireCloseModal');
        $this->delete = null;
    }
    public function importProduct()
    {
        $this->dispatchBrowserEvent('livewireImoprtModal');
    }
    function closeImportModel()
    {
        $this->dispatchBrowserEvent('livewireImoprtCloseModal');
    }
    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        Product::find($id)->update([
            'status' => $d,
        ]);
    }



    public function productImport()
    {
        $this->validate([
            'excelFile' => 'required',
        ]);

        // if (!$this->proceesBar) {
        Excel::import(new ProductImport, $this->excelFile->store('file'));
        // dd('test');
        // $this->proceesBar = 1;
        $this->excelFile = null;
        $this->dispatchBrowserEvent('livewireImoprtCloseModal');
        // }

        $this->excelFile = null;
        return redirect()->back();
    }
    public function render()
    {
        $this->status = [];
        $products = Product::all();
        foreach ($products as $products) {
            $this->status[$products->id] = $products->status;
        }

        return view('livewire.product-component', [
            'categories' => Category::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'categorytypes' => CategoryType::where('category_id', $this->category_id)->get(),
            'subcategories' => SubCategory::where('categorytype_id', $this->categorytype_id)->orderBy('order_by', 'asc')->where('status', 1)->get(),
            'materialType' => MaterialType::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'metals' => MetalType::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'metalPurity' => MetalPurity::orderBy('order_by', 'asc')->where('status', 1)->get(),

            'diadondQuality' => DiadondQuality::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'metalColors' => MetalColor::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'diamondShapes' => DiamondShape::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'diamondColors' => DiamondColor::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'diamondSizes' => DiamondSize::orderBy('order_by', 'asc')->where('status', 1)->get(),

            'colorStoneShapes' => ColorStoneShape::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'colorStoneSizes' => ColorStoneSize::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'colorStoneColors' => ColorStoneColor::orderBy('order_by', 'asc')->where('status', 1)->get(),
            'settings' => Setting::orderBy('order_by', 'asc')->where('status', 1)->get(),

            'colorStoneNames' => ColorStoneName::orderBy('order_by', 'asc')->where('status', 1)->get(),

            'sizes' => Size::orderBy('order_by', 'asc')->where('status', 1)->get(),

            'products' => Product::orderBy('id', 'DESC')
                ->when($this->search, function ($qs) {
                    $qs->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sku', 'LIKE', '%' . $this->search . '%');
                    // ->orWhere('order_by', 'LIKE', '%' . $this->search . '%');
                })->paginate(50),
        ]);
    }
}
