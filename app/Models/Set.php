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

    public function getIconAttribute()
    {
        return asset("img/set-icons/{$this->code}.svg");
    }
}
