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

    public static function getAnagraficheClienti(){
        return AnagraficheClienti::with('cliente')->get();
    }


    protected $guarded = [];

    public function cliente() {
        return $this->hasOne('cafapp\Models\Clienti','idAnagrafica');
    }

    public function luogo_nascita() {
        return $this->belongsTo('cafapp\Models\Comuni','luogoNascita');
    }

    public function comune_residenza() {
        return $this->belongsTo('cafapp\Models\Comuni','comuneResidenza');
    }

}