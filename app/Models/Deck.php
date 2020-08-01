<?php

namespace App\Models;

class Deck extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
    ];

    public $with = [
        'cards'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class)
            ->orderBy('stats_json->cost', 'asc')
            ->orderBy('name', 'asc')
            ->withPivot('showcase')
            ->withPivot('amount');
    }

    public function getSizeAttribute()
    {
        $count = 0;
        $this->cards->each(function ($card) use (&$count) {
            $count += $card->getOriginal('pivot_amount');
        });

        return $count;
    }

    public function getDisplayCardAttribute()
    {
        $cards = $this->cards;
        $showcase = optional($cards->where('pivot.showcase')->first())->attachment;
        return $showcase ?? optional($cards->last())->attachment;
    }

    public function duplicate()
    {
        $new = $this->replicate();
        $new->name = $new->name . ' - duplicate';
        $new->push();

        $this->relations = [];
        $this->load('cards');

        $pivots = [];
        foreach ($this->cards as $item) {
            $pivots[] = [
                'card_id' => $item->id,
                'amount' => $item->pivot->getAttributes()['amount']
            ];
        }

        $new->cards()->sync($pivots);
        return $new;
    }

    public function getDeckListIds($shuffle = false)
    {
        $list = [];
        $this->cards->each(function ($card) use (&$list) {
            for ($i = 0; $i < $card->getOriginal('pivot_amount'); $i++) {
                $list[] = $card->id;
            }
        });

        if ($shuffle) {
            shuffle($list);
        }

        return $list;
    }
}
