<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function delete()
    {
        $this->deleted_by = Auth::user()->id;
        $this->save();
        return parent::delete();
    }

    public function message()
    {
        return $this->hasOne(Message::class,'room_id','id')->orderBy('created_at','desc');
    }
    public function messages()
    {
        return $this->hasMany(Message::class,'room_id','id')->where('is_seen',0)->where('sender_id','!=',Auth::user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'room_name_id');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'room_users');
    }
}
