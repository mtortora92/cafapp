<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentoIdentitum
 */
class DocumentoIdentitum extends Model
{
    protected $table = 'DocumentoIdentita';

    public $timestamps = false;

    protected $fillable = [
        'idTipoDocumento',
        'dataRilascio',
        'dataScadenza',
        'rilasciatoDa'
    ];

    protected $guarded = [];

    public function rilasciato_da() {
        return $this->belongsTo('cafapp\Models\Comuni','rilasciatoDa');
    }
        
}