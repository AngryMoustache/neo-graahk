<?php

namespace App\Models;

class Card extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'data',
        'set_id',
        'attachment_id',
    ];

    public $casts = [
        'data' => 'object'
    ];

    public function __get($key)
    {
        return $this->getAttribute($key) ??
            $this->data->$key ?? null;
    }

    public function set()
    {
        return $this->belongsTo(Set::class);
    }

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }
}
