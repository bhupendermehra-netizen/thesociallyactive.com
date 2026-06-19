<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'page', 'title', 'section', 'fields', 'slug',
        'meta_title', 'meta_description', 'meta_keywords', 'status',
        'custom_meta_tags', 'head_script', 'body_script',
    ];
}
