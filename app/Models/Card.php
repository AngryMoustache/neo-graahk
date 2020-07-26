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
        'stats',
        'masked_text',
        'set_id',
        'attachment_id',
    ];

    public $casts = [
        'stats' => 'object',
        'data' => 'object'
    ];

    public $with = [
        'experience'
    ];

    public function __get($key)
    {
        return $this->getAttribute($key) ??
            json_decode($this->stats)->{$key} ??
            json_decode($this->data)->{$key} ??
            null;
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

    public function getTextAttribute()
    {
        if ($this->masked_text) {
            return $this->masked_text;
        }

        return CardText::parse(json_decode($this->data, true));
    }

    public function getRarity()
    {
        $user = optional(auth()->user())->id;
        if (!$user) { return null;}

        Cache::flush();
        $value = Cache::rememberForever("cardExpUser{$user}Card{$this->id}", function () {
            $exp = optional($this->experience)->experience ?? 0;
            foreach (config('rarities') as $rarityName => $rarityExp) {
                if ($exp >= $rarityExp) {
                    $rarity = $rarityName;
                }
            }

            return $rarity;
        });

        return $value;
    }

}
