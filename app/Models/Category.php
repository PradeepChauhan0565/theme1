<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public function categoryType()
    {
        return $this->hasMany(CategoryType::class)->orderBy('order_by', 'asc')->where('status', 1);
    }

    public function categoryTypes()
    {
        return $this->hasMany(CategoryType::class, 'category_id');
    }
    protected $guarded = [];

    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }
    public function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);
    }
}
