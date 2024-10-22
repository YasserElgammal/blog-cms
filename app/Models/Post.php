<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'image', 'category_id', 'user_id', 'slug', 'status'];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->diffForHumans()
        );
    }

    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    public function getNextAttribute()
    {
        return static::wherecategoryId($this->category_id)->where('id', '>', $this->id)->published()->orderBy('id', 'asc')->first();
    }

    public function getPreviousAttribute()
    {
        return static::wherecategoryId($this->category_id)->where('id', '<', $this->id)->published()->orderBy('id', 'desc')->first();
    }

    public function getImageAttribute($value)
    {
        return $value ? asset("storage/$value") : asset('import/assets/post-pic-dummy.png');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function boot()
    {
        parent::boot();
        static::updating(function ($post) {
            if ($post->isDirty('image') && !is_null($post->getRawOriginal('image'))) {
                Storage::delete($post->getRawOriginal('image'));
            }
        });
        static::deleting(function ($post) {
            if (!is_null($post->getRawOriginal('image'))) {
                Storage::delete($post->getRawOriginal('image'));
            }
        });
    }
}
