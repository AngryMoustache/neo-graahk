<?php

namespace App\Models;

use App\CardText;
use Illuminate\Support\Facades\Cache;

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

    public $with = [
        'experience'
    ];

    public function __get($key)
    {
        return $this->getAttribute($key) ??
            $this->data->$key ?? null;
    }

    public function originalSet()
    {
        return $this->belongsToMany(Set::class)
            ->withPivot(['reprint'])
            ->wherePivot('reprint', 0);
    }

    public function currentSet()
    {
        return $this->belongsToMany(Set::class)
            ->withPivot(['id', 'reprint'])
            ->orderBy('pivot_id','desc');
    }

    public function sets()
    {
        return $this->belongsToMany(Set::class);
    }

    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }

    public function experience()
    {
        return $this->hasOne(CardUser::class);
    }

    public function getExpAttribute()
    {
        return optional($this->experience)->experience;
    }

    public function getRarity()
    {
        $user = optional(auth()->user())->id;
        if (!$user) {
            return null;
        }

        $value = Cache::rememberForever("cardExpUser{$user}Card{$this->id}", function () {
            $exp = optional($this->experience)->experience;
            foreach (config('rarities') as $rarityName => $rarityExp) {
                if ($exp >= $rarityExp) {
                    $rarity = $rarityName;
                }
            }

            return $rarity;
        });

        return $value;
    }

    public function getTextAttribute()
    {
        if ($this->maskedText) {
            return $this->maskedText;
        }

        return CardText::parse(optional($this->data)->text);
    }

}
