<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

class Caf extends Model
{
    protected $table = 'caf';

    public $timestamps = false;

    protected $fillable = [
        'nome'
    ];

    protected $guarded = [];
}
