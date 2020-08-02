<?php

namespace App\Models;

class PusherMessage extends Model
{
    protected $fillable = [
        'message'
    ];

    protected $casts = [
        'message' => 'json'
    ];
}
