<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id', 'cover_image',
        'description', 'content', 'seo_title',
        'seo_description', 'is_published', 'sort_order'
    ];

    protected $casts = ['is_published' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title) . '-' . time();
            }
        });
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->description ?? $this->content ?? ''), 120);
    }
}