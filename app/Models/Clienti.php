<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Clienti
 */
class Clienti extends Model
{
    protected $table = 'Clienti';

    public $timestamps = false;

    protected $fillable = [
        'idAnagrafica',
        'idInvalidita',
        'idDocumentoIdentita',
        'idAltreInfo'
    ];

    protected $guarded = [];

        
}