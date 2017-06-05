<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoProfessione
 */
class TipoProfessione extends Model
{
    protected $table = 'TipoProfessione';

    public $timestamps = false;

    protected $fillable = [
        'professione'
    ];

    protected $guarded = [];

        
}