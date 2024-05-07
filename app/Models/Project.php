<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'preview_content',
        'preview_image',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'bool',
        'created_at' => 'datetime',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }
}
