<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'blog_uuid',
        'path',
        'type',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_uuid', 'uuid');
    }
}
