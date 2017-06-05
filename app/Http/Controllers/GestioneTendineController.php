<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\TipiDocumentiIdentitum;
use cafapp\Models\TipoInvaliditum;
use cafapp\Models\TipoProfessione;
use cafapp\Models\TitoloStudio;
use Illuminate\Http\Request;

class GestioneTendineController extends Controller
{
    public function inserisciTipoInvalidita(Request $data){
        TipoInvaliditum::create([
            'invalidita' => $data['descrizione'],
        ]);

        return redirect()->route('visualizzaGestioneTendine');
    }

    public function rimuoviTipoInvalidita($id){
        TipoInvaliditum::find($id)->delete();

        return redirect()->route('visualizzaGestioneTendine');
    }

    public function inserisciTipoDocumento(Request $data){
        TipiDocumentiIdentitum::create([
            'descrizione' => $data['descrizione'],
        ]);

        return redirect()->route('visualizzaGestioneTendine');
    }

    public function rimuoviTipoDocumento($id){
        TipiDocumentiIdentitum::find($id)->delete();

        return redirect()->route('visualizzaGestioneTendine');
    }

    public function inserisciTitoloStudio(Request $data){
        TitoloStudio::create([
            'titolo' => $data['descrizione'],
        ]);

        return redirect()->route('visualizzaGestioneTendine');
    }

    public function rimuoviTitoloStudio($id){
        TitoloStudio::find($id)->delete();

        return redirect()->route('visualizzaGestioneTendine');
    }

    public function inserisciTipoProfessione(Request $data){
        TipoProfessione::create([
            'professione' => $data['descrizione'],
        ]);

        return redirect()->route('visualizzaGestioneTendine');
    }

    public function rimuoviTipoProfessione($id){
        TipoProfessione::find($id)->delete();

        return redirect()->route('visualizzaGestioneTendine');
    }
}
