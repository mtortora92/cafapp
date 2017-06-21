<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $ticket_id
 * @property string $path
 * @property Ticket $ticket
 */
class DocumentiOutput extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'documenti_output';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('cafapp\Models\Ticket');
    }
}
