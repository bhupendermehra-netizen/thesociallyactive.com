<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id', 'author_id', 'cover_image',
        'blog_date', 'description', 'content', 'seo_title',
        'seo_description', 'is_published', 'enable_comments', 'sort_order'
    ];

    public function getAuthorIdAttribute()
    {
        return $this->attributes['author_id'];
    }

    public function getBlogDateAttribute()
    {
        return $this->attributes['blog_date'];
    }

    protected $casts = [
        'is_published' => 'boolean',
        'enable_comments' => 'boolean',
        'blog_date' => 'date'
    ];

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