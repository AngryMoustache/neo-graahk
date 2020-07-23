<?php

namespace App\Models;

class Set extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code',
        'attachment_id',
    ];

    public $with = [
        'cards'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }
}
