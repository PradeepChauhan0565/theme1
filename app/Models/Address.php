<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Address extends Model
{
    use HasFactory;
    public function countries()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }
    public function states()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
    public function cities()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    protected $guarded = [];

    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }
}
