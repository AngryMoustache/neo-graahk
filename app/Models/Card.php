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

    public function formats()
    {
        return $this->belongsToMany(Format::class);
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
        return $this->hasOne(CardUser::class)
            ->where('user_id', optional(auth()->user())->id);
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
        $value = Cache::rememberForever("cardExpUser{$user}Card{$this->id}", function () use ($user) {
            $pivot = CardUser::where('card_id', $this->id)
                ->where('user_id', $user)
                ->first();

            $exp = optional($pivot)->experience ?? 0;
            foreach (config('rarities') as $rarityName => $rarityExp) {
                if ($exp >= $rarityExp) {
                    $rarity = $rarityName;
                }
            }

            return $rarity;
        });

        return $value;
    }

    public function getVueInformation($withAmount = false, $user = null)
    {
        $rarity = $this->getRarity($user);
        $array = [
            'id' => $this->id,
            'uniqid' => uniqid(),
            'name' => $this->name,
            'image' => $this->getRarityAttachment($rarity)->format('card'),
            'setIcon' => $this->currentSet->first()->icon->format('thumb'),
            'cost' => $this->cost,
            'showcase' => $this->getOriginal('pivot_showcase'),
            'data' => $this->data,
            'stats' => $this->stats,
            'rarity' => $rarity,
            'sets' => $this->sets->pluck('name', 'id')->toArray(),
            'text' => !empty($this->masked_text)
                ? $this->masked_text
                : CardText::parse($this->data)
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

    public function getRarityAttachment($rarity = null)
    {
        $rarity ??= $this->getRarity();
        if ($rarity === 'Fabulous' || $rarity === 'Extraordinary') {
            return $this->animatedAttachment ?? $this->attachment;
        }

        return $this->attachment;
    }

}
