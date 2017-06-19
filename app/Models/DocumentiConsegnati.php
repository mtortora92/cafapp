<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $clienti_id
 * @property integer $documenti_servizi_id
 * @property string $path
 * @property Clienti $clienti
 * @property DocumentiServizi $documentiServizi
 */
class DocumentiConsegnati extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'documenti_consegnati';

    /**
     * @var array
     */
    protected $fillable = ['clienti_id', 'documenti_servizi_id', 'path'];

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
    public function documentiServizi()
    {
        return $this->belongsTo('cafapp\Models\DocumentiServizi');
    }
}
