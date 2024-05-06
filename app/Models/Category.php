<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeWithName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function scopeWithSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
