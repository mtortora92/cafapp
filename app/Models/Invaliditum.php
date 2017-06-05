<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invaliditum
 */
class Invaliditum extends Model
{
    protected $table = 'Invalidita';

    public $timestamps = false;

    protected $fillable = [
        'idInvalidita',
        'percentuale',
        'accompagnamento'
    ];

    protected $guarded = [];

        
}