<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 */
class User extends Model
{
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