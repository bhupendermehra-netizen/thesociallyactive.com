<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'title_tag', 'category_id', 'author_id', 'cover_image',
        'content', 'description', 'seo_title', 'seo_description', 'custom_meta_tags',
        'head_script', 'body_script',
        'alt_description', 'blog_date', 'is_published', 'sort_order', 'enable_comments',
    ];

    public function getAuthorIdAttribute()
    {
        return $this->attributes['author_id'];
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

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable')->orderBy('sort_order');
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