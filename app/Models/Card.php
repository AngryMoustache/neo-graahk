<?php

namespace App\Models;

use App\CardText;
use Illuminate\Support\Facades\Cache;

class Card extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'data_json',
        'stats_json',
        'masked_text',
        'set_id',
        'attachment_id',
        'animated_attachment_id',
    ];

    public $with = [
        'experience'
    ];

    public function __get($key)
    {
        return $this->getAttribute($key) ??
            $this->stats[$key] ??
            $this->data[$key] ??
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

    public function animatedAttachment()
    {
        return $this->belongsTo(
            Attachment::class,
            'animated_attachment_id',
            'id',
            'attachments'
        );
    }

    public function experience()
    {
        return $this->hasOne(CardUser::class);
    }

    public function getStatsAttribute()
    {
        return json_decode($this->stats_json, true);
    }

    public function getDataAttribute()
    {
        return json_decode($this->data_json, true);
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

        return CardText::parse($this->data);
    }

    public function getRarity($user = null)
    {
        $user ??= optional(auth()->user())->id;
        if (!$user) { return null; }

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

    public function getVueInformation($withAmount = false)
    {
        $array = [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->attachment->format('thumb'),
            'cost' => $this->cost,
            'showcase' => $this->getOriginal('pivot_showcase')
        ];

        if ($withAmount) {
            $array['amount'] = $this->getOriginal('pivot_amount');
        }

        return $array;
    }

    public function getVueInformationWithAmount()
    {
        return $this->getVueInformation(true);
    }

}
