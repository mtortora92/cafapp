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

    public function documento_identita() {
        return $this->belongsTo('cafapp\Models\DocumentoIdentitum','idDocumentoIdentita');
    }

    public function invalidita() {
        return $this->belongsTo('cafapp\Models\Invaliditum','idInvalidita');
    }

    public function anagrafica() {
        return $this->belongsTo('cafapp\Models\AnagraficheClienti','idAnagrafica');
    }

    public function altre_info() {
        return $this->belongsTo('cafapp\Models\AltreInfoCliente','idAltreInfo');
    }
}