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
            ->withPivot('amount');
    }

    public function getDisplayCardAttribute()
    {
        return optional(optional($this->cards)->first())->attachment;
    }

    public function duplicate()
    {
        $new = $this->replicate();
        $new->slug .= '-duplicate';
        $new->push();

        $this->relations = [];
        $this->load('cards');
        foreach ($this->relations as $relationName => $values) {
            foreach ($values as $item) {
                $new->{$relationName}()->attach($values, [
                    'amount' => $item->pivot->getAttributes()['amount']
                ]);
            }
        }

        return $new;
    }
}
