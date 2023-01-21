<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    // I use this function to get Active Posts in the current Tag
    public function publishedPosts()
    {
        return SELF::posts()->with(['user', 'category'])->whereStatus(true)->orderBy('id','desc')->paginate(10);
    }

    public function countTagsForPublishedPosts()
    {
        return SELF::posts()->whereStatus(true)->count();
    }
}
