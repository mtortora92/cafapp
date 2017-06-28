<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

class VociDiario extends Model
{
    protected $table = 'voci_diario';

    public $timestamps = true;

    protected $fillable = [
        'descrizione',
        'clienti_id',
        'users_id'
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('cafapp\User','users_id');
    }
}
