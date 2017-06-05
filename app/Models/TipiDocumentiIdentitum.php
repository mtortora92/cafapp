<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipiDocumentiIdentitum
 */
class TipiDocumentiIdentitum extends Model
{
    protected $table = 'TipiDocumentiIdentita';

    public $timestamps = false;

    protected $fillable = [
        'descrizione'
    ];

    protected $guarded = [];

        
}