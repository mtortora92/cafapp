<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nome
 * @property Servizi[] $servizis
 */
class GruppiServizi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gruppi_servizi';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servizis()
    {
        return $this->hasMany('cafapp\Models\Servizi');
    }
}
