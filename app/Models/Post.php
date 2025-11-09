<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'slug', 'content', 'deleted_at'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = static::generateUniqueSlug($post->title);
        });
    }

    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->latest();
    }

    public function commentsCounts()
    {
        return $this->comments->count();
    }
}