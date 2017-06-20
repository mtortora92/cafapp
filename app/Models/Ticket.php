<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $clienti_id
 * @property integer $servizi_id
 * @property float $sconto
 * @property string $data_chiusura
 * @property Clienti $clienti
 * @property Servizi $servizi
 */
class Ticket extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ticket';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['clienti_id', 'servizi_id', 'sconto', 'data_chiusura', 'utente_per_lavorazione'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clienti()
    {
        return $this->belongsTo('cafapp\Models\Clienti', 'clienti_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servizi()
    {
        return $this->belongsTo('cafapp\Models\Servizi');
    }
}
