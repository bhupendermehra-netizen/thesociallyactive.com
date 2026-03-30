<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'tags',
        'image',
        'link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Helper: tags string ko array mein convert karo
    public function getTagsArrayAttribute()
    {
        return array_map('trim', explode(',', $this->tags ?? ''));
    }
}