<?php

namespace App\Models;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'attachment_id',
        'body',
    ];

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
