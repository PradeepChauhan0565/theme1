<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function categorytype()
    {
        return $this->belongsTo(CategoryType::class, 'categorytype_id');
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
