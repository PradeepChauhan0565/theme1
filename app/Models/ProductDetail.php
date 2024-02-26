<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }

    public function metalPurity()
    {
        return $this->belongsTo(MetalPurity::class, 'quality_id');
    }
    public function metalColor()
    {
        return $this->belongsTo(MetalColor::class, 'color_id');
    }
    public function diamondShape()
    {
        return $this->belongsTo(DiamondShape::class, 'shape_id');
    }
    public function diamondSize()
    {
        return $this->belongsTo(DiamondSize::class, 'size_id');
    }
    // public function diamondSetting()
    // {
    //     return $this->belongsTo(DiamondSetting::class, 'setting_id');
    // }
    public function diadondQuality()
    {
        return $this->belongsTo(DiadondQuality::class, 'quality_id');
    }
    public function diadondColor()
    {
        return $this->belongsTo(DiamondColor::class, 'color_id');
    }
    public function metalType()
    {
        return $this->belongsTo(MetalType::class, 'metal_id');
    }

    public function colorStoneShape()
    {
        return $this->belongsTo(ColorStoneShape::class, 'shape_id');
    }
    public function colorStoneSize()
    {
        return $this->belongsTo(ColorStoneSize::class, 'size_id');
    }
    public function colorStoneName()
    {
        return $this->belongsTo(ColorStoneName::class, 'stone_name_id');
    }
    // public function colorStoneSetting()
    // {
    //     return $this->belongsTo(ColorStoneSetting::class, 'setting_id');
    // }
    public function colorStoneColor()
    {
        return $this->belongsTo(ColorStoneColor::class, 'color_id');
    }
}
