<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class, 'sub_category_header_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function materials()
    {
        return $this->hasMany(ProductDetail::class, 'product_id');
    }



    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }


    public function categoryTypes()
    {
        return $this->belongsToMany(CategoryType::class, 'product_categories', 'product_id', 'sub_category_header_id');
    }

    public function subSategories()
    {
        return $this->belongsToMany(SubCategory::class, 'product_categories', 'product_id', 'sub_category_id');
    }



    public function metals()
    {
        return $this->belongsToMany(MetalType::class, 'metal_products');
    }

    public function category1()
    {
        return $this->belongsTo(Category::class, 'category_products');
    }



    public function centerDiamond()
    {
        return $this->belongsTo(DiadondQuality::class, 'center_diamond_quality_id');
    }

    public function centerShape()
    {
        return $this->belongsTo(DiamondShape::class, 'center_diamond_shape_id');
    }
    public function sideDiamond()
    {
        return $this->belongsTo(DiadondQuality::class, 'side_diamond_quality_id');
    }

    public function sideShape()
    {
        return $this->belongsTo(DiamondShape::class, 'side_diamond_shape_id');
    }

    public function colorStoneQuality()
    {
        return $this->belongsTo(ColorStoneQuality::class, 'color_stone_quality_id');
    }
    public function colorStoneShape()
    {
        return $this->belongsTo(ColorStoneShape::class, 'color_stone_shape_id');
    }
    public function metalType()
    {
        return $this->belongsTo(MetalType::class, 'material_map_products', 'material_id', 'id')->where('material_type_id', 2);
    }
    public function metalPurity()
    {
        return $this->belongsTo(MetalPurity::class, 'material_map_products', 'material_id', 'id')->where('material_type_id', 2);
    }

    public function ringSize()
    {
        return $this->belongsTo(Size::class, 'product_size_id');
    }

    public function orderRing()
    {
        return $this->hasOne(Cart::class);
    }

    public function kitco()
    {
        return $this->hasOne(Kitco::class, 'metal_type', 'metal_type_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }
}
