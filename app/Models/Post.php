<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'preview_content',
        'main_content',
        'preview_image',
        'main_image',
        'views_count',
        'category_id',
        'is_published'
    ];

    protected $casts = [
        'views_count' => 'integer',
        'user_id' => 'integer',
        'category_id' => 'integer',
        'is_published' => 'bool',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->with('children')->orderBy('created_at', 'desc');
    }

    public function incrementViewsCount()
    {
        $this->increment('views_count');
    }
}
