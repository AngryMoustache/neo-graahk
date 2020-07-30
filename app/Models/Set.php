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

    public function formats()
    {
        return $this->belongsToMany(Format::class);
    }

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function icon()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

    public static function getForVue()
    {
        return self::get()->map(function ($value) {
            return [
                'id' => $value->id,
                'name' => $value->name,
                'icon' => optional($value->icon)->format('thumb'),
                'active' => 0
            ];
        });
    }
}
