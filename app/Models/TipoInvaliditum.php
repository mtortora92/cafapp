<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoInvaliditum
 */
class TipoInvaliditum extends Model
{
    protected $table = 'TipoInvalidita';

    public $timestamps = false;

    protected $fillable = [
        'invalidita'
    ];

    protected $guarded = [];

        
}