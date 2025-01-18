<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMetadata extends Model
{
    protected $fillable = [
        'blog_uuid',
        'meta_title',
        'meta_description',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_uuid', 'uuid');
    }
}
