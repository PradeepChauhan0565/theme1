<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class RoleUser extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $table='role_user';
    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getTableColumns($table)
    {
        return Schema::getColumnListing($table);
    }
}
