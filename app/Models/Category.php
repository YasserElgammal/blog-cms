<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','user_id'];

    public function setUser_IdAttribute($user)
    {
        $this->attributes['user_id'] = Auth::user()->id;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
