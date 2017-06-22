<?php

namespace cafapp\Models;

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
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['gruppi_servizi_id', 'nome', 'prezzo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gruppiServizi()
    {
        return $this->belongsTo('cafapp\Models\GruppiServizi');
    }

    public function getDocumentiObbligatori(){
        return $this->belongsToMany(DocumentiServizi::class, 'servizi_has_documenti_obbligatori', 'servizi_id', 'documenti_servizi_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviziHasDocumentiObbligatoris()
    {
        return $this->hasMany('cafapp\Models\ServiziHasDocumentiObbligatori');
    }

    public function tickets(){
        return $this->hasMany('cafapp\Models\Ticket');
    }
}
