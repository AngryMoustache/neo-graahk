<?php

namespace App\Models;

class Game extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'status',
        'user_1_id',
        'user_2_id',
        'game_data',
    ];

    public $casts = [
        'game_data' => 'json'
    ];

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_1_id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_2_id');
    }

}
