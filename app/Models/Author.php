<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }
}
