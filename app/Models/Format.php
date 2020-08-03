<?php

namespace App\Models;

class Format extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
    ];

    public $with = [
        'cards',
        'sets',
    ];

    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }

    public function sets()
    {
        return $this->belongsToMany(Set::class);
    }

    public static function getForVue()
    {
        return self::get()->map(function ($value) {
            return [
                'id' => $value->id,
                'name' => $value->name,
            ];
        });
    }

}
