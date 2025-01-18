<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'content',
        'author_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_uuid', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_uuid', 'uuid');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'blog_uuid', 'uuid');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'blog_uuid', 'uuid');
    }

    public function seoMetadata()
    {
        return $this->hasOne(SeoMetadata::class, 'blog_uuid', 'uuid');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'blog_uuid', 'uuid');
    }
}
