<?php

namespace App\Models;

class CardUser extends Model
{
    public $table = 'card_user';

    protected $fillable = [
        'card_id',
        'user_id',
        'experience',
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
