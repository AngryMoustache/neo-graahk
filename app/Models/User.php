<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'attachment_id',
        'password',
        'admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

    public function getVueInformation()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => optional($this->avatar)->format('thumb'),
        ];
    }
}
