<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipologiaCliente
 */
class TipologiaCliente extends Model
{
    protected $table = 'TipologiaCliente';

    public $timestamps = false;

    protected $fillable = [
        'descrizione'
    ];

    protected $guarded = [];

        
}