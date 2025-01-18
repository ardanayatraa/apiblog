<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = [
        'blog_uuid',
        'user_id',
        'type',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
