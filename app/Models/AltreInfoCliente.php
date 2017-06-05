<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AltreInfoCliente
 */
class AltreInfoCliente extends Model
{
    protected $table = 'AltreInfoCliente';

    public $timestamps = false;

    protected $fillable = [
        'idTitoloStudio',
        'idProfessione',
        'telefono',
        'cellulare',
        'email',
        'numTesseraEnotria',
        'socio',
        'delegaSindacale',
        'socioEnotriaCral'
    ];

    protected $guarded = [];

        
}