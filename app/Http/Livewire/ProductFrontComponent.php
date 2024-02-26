<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ProductCategory;
use App\Models\RecentlyViewedProduct;
use Livewire\Component;
use App\Models\MetalPurity;
use App\Models\DiamondShape;
use App\Models\MetalColor;
use App\Models\MetalType;
use App\Models\ProductDetail;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ProductFrontComponent extends Component
{
    use WithFileUploads, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category;
    public $category_type;
    public $sub_category;
    public $sortBy;
    public $sortDirectionNewToOld = 'desc';
    public $sortDirectionOldToNew = 'asc';
    public $sortDirectionAToZ = 'asc';
    public $sortDirectionZToA = 'desc';

    public $search;
    public $allProducts;

    public $categoryTypes = [];
    public $f_sub_categories = [];
    public $subSategories = [];
    public $colorType;
    public $colorTypeAll = "any";
    public $puritiesAll = "any";
    public $purities = [];
    public $metalType = [];
    public $diamondAll = "0-10";
    public $diamond = [];
    public $diastoneShapes = [];
    public $price = [];



    public function mount($category, $category_type, $sub_category, $search)
    {
        if ($search) {
            $this->search = $search;
        } else {
            $this->category = $category;
            $this->category_type = $category_type;
            $this->sub_category = $sub_category;
            $this->f_sub_categories = SubCategory::where('category_id', $this->category->id)->pluck('name', 'id')->toArray();
        }
    }
    public function addToWishlist($productId)
    {

        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist.');
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdeted');
                session()->flash('message', 'Wishlist added Successfully');
            }
        } else {
            session()->flash('message', 'Please login to continue');
        }
    }

    public function removeToWishlist($productId)
    {
        $data = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->delete();
        $this->emit('wishlistAddedUpdeted');
        session()->flash('message', 'Wishlist removed Successfully');
    }

    public function recentView($id)
    {
        if (empty(Session::get('session_id'))) {
            $session_id = md5(uniqid(rand(), true));
        } else {
            $session_id = Session::get('session_id');
        }
        Session::put('session_id', $session_id);

        $recently_viewed_products = DB::table('recently_viewed_products')->where(['product_id'
        => $id, 'session_id' => $session_id])->count();
        if ($recently_viewed_products == 0) {
            DB::table('recently_viewed_products')->insert([
                'product_id' => $id,
                'session_id' => $session_id
            ]);
        }
    }

    public function showCategory($id)
    {
        $this->categoryTypes[$id] = $id;
        // $this->category_type = $id;
    }

    public function filter()
    {
        if ($this->purities) {
            $this->puritiesAll = null;
        }
        if ($this->puritiesAll) {
            $this->purities = [];
        }

        if ($this->colorType) {
            $this->colorTypeAll = "";
        }
        if ($this->colorTypeAll) {
            $this->colorType = null;
        }
        $this->resetPage();
    }
    public function resetFilter($key, $type)
    {
        if ($type == 'subcategory') {
            $this->subSategories[$key] = false;
        }
        if ($type == 'shape') {
            $this->diastoneShapes[$key] = false;
        }
        if ($type == 'metal') {
            $this->metalType[$key] = false;
        }
        if ($type == 'dia') {
            $this->diamond[$key] = false;
        }
        if ($type == 'metal_color') {
            $this->colorType = null;
        }

        if ($type == 'kt') {
            $this->purities[$key] = false;
        }
        if ($type == 'price') {
            $this->price[$key] = false;
        }
    }


    public function resetFilterAll()
    {
        $this->subSategories = [];
        $this->diastoneShapes = [];
        $this->metalType = [];
        $this->purities = [];
        $this->price = [];
        $this->diamond = [];
        $this->colorType = null;
    }
    public function render()
    {
        $product_ids = [];
        $products = [];
        $metal_ids = [];
        foreach ($this->metalType as $mt) {
            if ($mt) {
                $metal_ids[] =  $mt;
            }
        }
        $purities_ids = [];
        $product_ids = [];
        foreach ($this->purities as $mp) {
            if ($mp) {
                $purities_ids[] =  $mp;
            }
        }
        $dia_ids = [];
        foreach ($this->diastoneShapes as $dshape) {
            if ($dshape) {
                $dia_ids[] =  $dshape;
            }
        }


        if ($this->search) {
            $this->search = $this->search;
        }

        if ($this->sub_category) {
            $product_ids = ProductCategory::where('category_id', $this->category->id)
                ->where('sub_category_header_id', $this->category_type->id)
                ->where('sub_category_id', $this->sub_category->id)
                ->pluck('product_id');
        } elseif ($this->category_type) {
            $product_ids = ProductCategory::where('category_id', $this->category->id)
                ->where('sub_category_header_id', $this->category_type->id)
                ->pluck('product_id');
        } elseif ($this->category) {
            $product_ids = ProductCategory::where('category_id', $this->category->id)->pluck('product_id');
        }


        $products = product::when(count($product_ids) > 0, function ($query) use ($product_ids) {
            $query->whereIn('id', $product_ids);
        })

            ->when(strlen($this->search), function ($query) {
                $query = $query->where('status', 1)->where(
                    function ($q) {
                        $q->where('name', 'LIKE', '%' . $this->search . '%')->orWhere('sku', 'LIKE', '%' . $this->search . '%');
                    }
                );
            })
            ->when(count($metal_ids) > 0, function ($query) use ($metal_ids) {
                $query->whereHas('materials', function ($query) use ($metal_ids) {
                    $query->whereIn('metal_id', $metal_ids)->where('material_type_id', 2);
                });
            })
            ->when(count($dia_ids) > 0, function ($query) use ($dia_ids) {
                $query->whereHas('materials', function ($query) use ($dia_ids) {
                    $query->whereIn('shape_id', $dia_ids);
                });
            })
            ->when(count($purities_ids) > 0, function ($query) use ($purities_ids) {
                $query->whereHas('materials', function ($query) use ($purities_ids) {
                    $query->whereIn('quality_id', $purities_ids)->where('material_type_id', 2);
                });
            })
            ->when(count($product_ids) > 0, function ($query) use ($product_ids) {
                $query->whereIn('products.id', $product_ids);
            })
            ->when($this->sortBy == 'highest', function ($query) {
                $query->orderBy('regular_price', 'desc');
            })
            ->when($this->sortBy == 'lowest', function ($query) {
                $query->orderBy('regular_price', 'asc');
            })
            ->when($this->sortBy == 'newToOld', function ($query) {
                $query->orderBy('created_at', $this->sortDirectionNewToOld);
            })
            ->when($this->sortBy == 'oldToNew', function ($query) {
                $query->orderBy('created_at', $this->sortDirectionOldToNew);
            })
            ->when($this->sortBy == 'aToZ', function ($query) {
                $query->orderBy('name', $this->sortDirectionAToZ);
            })
            ->when($this->sortBy == 'zToA', function ($query) {
                $query->orderBy('name', $this->sortDirectionZToA);
            })

            ->when($this->category, function ($query) {
                $query->whereHas('categories', function ($query) {
                    $query->where('categories.id', $this->category->id);
                });
            })


            ->when(count($this->subSategories) > 0, function ($query) {
                $ids = array_filter($this->subSategories, function ($value) {
                    return $value !== false;
                });
                if (count($ids) > 0) {
                    $query->whereHas('subSategories', function ($query) {
                        $ids = [];
                        foreach ($this->subSategories as $sub_category) {
                            if ($sub_category) {
                                $ids[] = $sub_category;
                            }
                        }
                        $query->whereIn('sub_categories.id', $ids);
                    });
                }
            });



        if (count($this->price) > 0) {
            $products->where(function ($query) {
                foreach ($this->price as $p1) {
                    if ($p1) {
                        $price = explode("-", $p1);
                        $price1 = (int)$price[0];
                        $price2 = (int)$price[1];
                        $query->orWhereBetween('regular_price', [$price1, $price2]);
                    }
                }
                return $query;
            });
        }

        if ($this->colorType) {
            $colorType = $this->colorType;
            $products = $products->whereHas(
                'images',
                function ($q) use ($colorType) {
                    return $q->where('image_color_id', $colorType);
                }
            );
        }

        if (count($this->diamond) > 0) {
            $product_ids = [];
            foreach ($this->diamond as $p1) {
                if ($p1) {
                    $diamond = explode("-", $p1);
                    $diamond1 = (int)$diamond[0];
                    $diamond2 = (int)$diamond[1];
                    $product_dia_id = ProductDetail::whereBetween('weight', [$diamond1, $diamond2])
                        ->where('material_type_id', 3)
                        ->pluck('product_id')->toArray();

                    $product_ids = array_merge($product_ids, $product_dia_id);
                }
            }
            $products =  $products->when(count($product_ids) > 0, function ($query) use ($product_ids) {
                $query->whereIn('products.id', $product_ids);
            });
            $products =  $products->when(count($product_ids) == 0, function ($query) use ($product_ids) {
                $query->whereIn('products.id', [0]);
            });

            $this->diamondAll = false;
        } else {
            $this->diamondAll = '0-10';
        }
        $products = $products->where('status', 1)->paginate(20);
        return view('livewire.product-front-component', [
            'metalPurities' => MetalPurity::orderBy('order_by')->where('status', 1)->pluck('code', 'id')->toArray(),
            'dstoneShapes' => DiamondShape::orderBy('order_by')->where('status', 1)->pluck('code', 'id')->toArray(),
            'metal' => MetalType::orderBy('order_by')->where('status', 1)->pluck('code', 'id')->toArray(),
            'products' => $products,
        ]);
    }
}
