<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $gruppi_servizi_id
 * @property string $nome
 * @property float $prezzo
 * @property GruppiServizi $gruppiServizi
 * @property ServiziHasDocumentiObbligatori[] $serviziHasDocumentiObbligatoris
 */
class Servizi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'servizi';

    /**
     * @var array
     */
    protected $fillable = ['gruppi_servizi_id', 'nome', 'prezzo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gruppiServizi()
    {
        return $this->belongsTo('App\GruppiServizi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviziHasDocumentiObbligatoris()
    {
        return $this->hasMany('App\ServiziHasDocumentiObbligatori');
    }
}
