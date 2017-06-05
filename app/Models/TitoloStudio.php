<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TitoloStudio
 */
class TitoloStudio extends Model
{
    protected $table = 'TitoloStudio';

    public $timestamps = false;

    protected $fillable = [
        'titolo'
    ];

    protected $guarded = [];

        
}