<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

class VociDiario extends Model
{
    protected $table = 'voci_diario';

    public $timestamps = true;

    protected $fillable = [
        'descrizione',
        'clienti_id'
    ];

    protected $guarded = [];
}
