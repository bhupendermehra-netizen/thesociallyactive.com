<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name', 'bio', 'profile_image',
        'facebook', 'instagram', 'linkedin', 'twitter',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
