<?php

namespace cafapp\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $clienti_id
 * @property integer $servizi_id
 * @property integer $utente_per_lavorazione
 * @property integer $stato_ticket_id
 * @property float $sconto
 * @property string $data_chiusura
 * @property string $note
 * @property Clienti $clienti
 * @property Servizi $servizi
 * @property User $user
 * @property StatoTicket $statoTicket
 */
class Ticket extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ticket';

    /**
     * @var array
     */
    protected $fillable = ['clienti_id', 'servizi_id', 'utente_per_lavorazione', 'stato_ticket_id', 'importo', 'data_chiusura', 'note', 'inserito_da'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('cafapp\User', 'utente_per_lavorazione');
    }

    public function inseritoDa()
    {
        return $this->belongsTo('cafapp\User', 'inserito_da');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function statoTicket()
    {
        return $this->belongsTo('cafapp\Models\StatoTicket');
    }

    public function documentoOutput(){
        return $this->hasOne('cafapp\Models\DocumentiOutput');
    }

    public function statoDocumentazione(){
        $documentiObbligatori = $this->servizi->serviziHasDocumentiObbligatoris;

        foreach ($documentiObbligatori as $docObb){
            $doc = DocumentiConsegnati::where('documenti_servizi_id', $docObb->documenti_servizi_id)->where('clienti_id', $this->clienti_id)->first();
            if(!isset($doc)){
                return false;
            }
        }

        return true;
    }
}
