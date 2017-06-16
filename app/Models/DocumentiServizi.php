<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nome
 * @property string $descrizione
 * @property ServiziHasDocumentiObbligatori[] $serviziHasDocumentiObbligatoris
 */
class DocumentiServizi extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'documenti_servizi';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'descrizione'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviziHasDocumentiObbligatoris()
    {
        return $this->hasMany('App\ServiziHasDocumentiObbligatori');
    }
}
