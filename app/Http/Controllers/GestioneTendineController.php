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

        return redirect("/caf");
    }

    public function rimuoviTipoInvalidita($id){
        TipoInvaliditum::find($id)->delete();

        return redirect("/caf");
    }

    public function inserisciTipoDocumento(Request $data){
        TipiDocumentiIdentitum::create([
            'descrizione' => $data['descrizione'],
        ]);

        return redirect("/caf");
    }

    public function rimuoviTipoDocumento($id){
        TipiDocumentiIdentitum::find($id)->delete();

        return redirect("/caf");
    }

    public function inserisciTitoloStudio(Request $data){
        TitoloStudio::create([
            'titolo' => $data['descrizione'],
        ]);

        return redirect("/caf");
    }

    public function rimuoviTitoloStudio($id){
        TitoloStudio::find($id)->delete();

        return redirect("/caf");
    }

    public function inserisciTipoProfessione(Request $data){
        TipoProfessione::create([
            'professione' => $data['descrizione'],
        ]);

        return redirect("/caf");
    }

    public function rimuoviTipoProfessione($id){
        TipoProfessione::find($id)->delete();

        return redirect("/caf");
    }
}
