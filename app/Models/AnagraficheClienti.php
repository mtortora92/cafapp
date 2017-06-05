<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AnagraficheClienti
 */
class AnagraficheClienti extends Model
{
    protected $table = 'AnagraficheClienti';

    public $timestamps = false;

    protected $fillable = [
        'idTipologiaCliente',
        'cognome',
        'nome',
        'sesso',
        'dataNascita',
        'luogoNascita',
        'codiceFiscale',
        'partitaIva',
        'pinInps',
        'indirizzoResidenza',
        'comuneResidenza'
    ];

    protected $guarded = [];

        
}