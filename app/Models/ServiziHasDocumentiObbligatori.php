<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $servizi_id
 * @property integer $documenti_servizi_id
 * @property Servizi $servizi
 * @property DocumentiServizi $documentiServizi
 */
class ServiziHasDocumentiObbligatori extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'servizi_has_documenti_obbligatori';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['servizi_id', 'documenti_servizi_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servizi()
    {
        return $this->belongsTo('cafapp\Models\Servizi');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentiServizi()
    {
        return $this->belongsTo('cafapp\Models\DocumentiServizi');
    }
}
