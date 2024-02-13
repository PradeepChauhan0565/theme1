<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Kitco extends Model
{
    use HasFactory;


    protected $guarded = [];
    public function metal()
    {
        return $this->belongsTo(Metal_type::class, 'metal_type_id');
    }
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
