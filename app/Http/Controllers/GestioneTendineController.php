<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\DocumentiServizi;
use cafapp\Models\GruppiServizi;
use cafapp\Models\TipiDocumentiIdentitum;
use cafapp\Models\TipoInvaliditum;
use cafapp\Models\TipoProfessione;
use cafapp\Models\TitoloStudio;
use Illuminate\Http\Request;

class GestioneTendineController extends Controller
{
    public function index(){
        $tipiInvalidita = TipoInvaliditum::all();
        $tipiDocumenti = TipiDocumentiIdentitum::all();
        $tipiProfessione = TipoProfessione::all();
        $titoliStudio = TitoloStudio::all();

        return view('caf.section.gestione_caf.menu_tendine',[
            "tipiInvalidita" => $tipiInvalidita,
            "tipiDocumenti" => $tipiDocumenti,
            "tipiProfessione" => $tipiProfessione,
            "titoliStudio" => $titoliStudio,
        ]);
    }

    public function inserisciGruppoServizi(Request $data){
        GruppiServizi::create([
            'nome' => $data["nome"]
        ]);

        return redirect('/servizi');
    }

    public function inserisciDocumentoServizi(Request $data){
        DocumentiServizi::create([
            'nome' => $data["nome"],
            'descrizione' => $data["descrizione"],
        ]);

        return redirect('/servizi');
    }

    public function inserisciTipoInvalidita(Request $data){
        TipoInvaliditum::create([
            'invalidita' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTipoInvalidita($id){
        TipoInvaliditum::find($id)->delete();

        return redirect("/tendine");
    }

    public function inserisciTipoDocumento(Request $data){
        TipiDocumentiIdentitum::create([
            'descrizione' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTipoDocumento($id){
        TipiDocumentiIdentitum::find($id)->delete();

        return redirect("/tendine");
    }

    public function inserisciTitoloStudio(Request $data){
        TitoloStudio::create([
            'titolo' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTitoloStudio($id){
        TitoloStudio::find($id)->delete();

        return redirect("/tendine");
    }

    public function inserisciTipoProfessione(Request $data){
        TipoProfessione::create([
            'professione' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTipoProfessione($id){
        TipoProfessione::find($id)->delete();

        return redirect("/tendine");
    }
}
