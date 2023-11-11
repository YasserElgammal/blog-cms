<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug','parent_id'];

    // One to many realtionship
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    // I use this function to get Active Posts in the current category
    public function publishedPosts()
    {
        return SELF::posts()->with('category')->published()->latest('created_at')->paginate(10);
    }
}
