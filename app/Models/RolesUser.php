<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RolesUser
 */
class RolesUser extends Model
{
    protected $table = 'RolesUser';

    public $timestamps = false;

    protected $fillable = [
        'descrizione'
    ];

    protected $guarded = [];

        
}