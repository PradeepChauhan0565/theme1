<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }

    public function urls()
    {
        return $this->belongsToMany(Url::class,'role_url');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'role_user');
    }
}
