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
        return $this->belongsToMany(Card::class);
    }

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function icon()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }
}
