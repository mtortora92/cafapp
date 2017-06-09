<?php

namespace cafapp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'nome',
        'cognome',
        'username',
        'password',
        'idRuolo',
        'isValid',
        'remember_token'
    ];

    protected $guarded = [];
}
