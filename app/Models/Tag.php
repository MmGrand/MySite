<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tag');
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
