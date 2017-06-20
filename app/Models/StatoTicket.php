<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nome
 * @property Ticket[] $tickets
 */
class StatoTicket extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'stato_ticket';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('cafapp\Models\Ticket');
    }
}
