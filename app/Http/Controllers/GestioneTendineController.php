<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\AltreInfoCliente;
use cafapp\Models\DocumentiOutput;
use cafapp\Models\DocumentiServizi;
use cafapp\Models\DocumentoIdentitum;
use cafapp\Models\GruppiServizi;
use cafapp\Models\Invaliditum;
use cafapp\Models\Servizi;
use cafapp\Models\TipiDocumentiIdentitum;
use cafapp\Models\TipoInvaliditum;
use cafapp\Models\TipoProfessione;
use cafapp\Models\TitoloStudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function modificaDocumentoServizi(Request $data){
        $id = $data->input('id_documento_modal');
        $desc = $data->input('descrizione');
        $nome = $data->input('nome');

        DocumentiServizi::find($id)->update(["nome" => $nome,"descrizione"=>$desc]);

        return redirect('/servizi/create');
    }

    public function modificaGruppoServizi(Request $data){
        $id = $data->input('id_gruppo_servizio_modal');
        $nome = $data->input('nome');

        GruppiServizi::find($id)->update(["nome" => $nome]);

        return redirect('/servizi/create');
    }

    public function inserisciGruppoServizi(Request $data){
        GruppiServizi::create([
            'nome' => $data["nome"]
        ]);

        return redirect('/servizi/create');
    }

    public function rimuoviGruppoServizi(Request $data){
        DB::beginTransaction();

        try {


            DB::commit();
            return redirect('/servizi');
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            //return back();
        }
    }

    public function inserisciDocumentoServizi(Request $data){
        DocumentiServizi::create([
            'nome' => $data["nome"],
            'descrizione' => $data["descrizione"],
        ]);

        return redirect('/servizi/create');
    }

    public function rimuoviDocumentoServizi(Request $data){
        $idDocumentoServizio = $data->input('id_doc_da_eliminare');

        $documentoServizio = DocumentiServizi::with('serviziHasDocumentiObbligatoris','documentiConsegnati')->where('id', $idDocumentoServizio)->first();

        $documentoServizio->serviziHasDocumentiObbligatoris()->delete();
        $documentoServizio->documentiConsegnati()->delete();
        $documentoServizio->delete();

        return redirect('/servizi/create');
    }

    public function inserisciTipoInvalidita(Request $data){
        TipoInvaliditum::create([
            'invalidita' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTipoInvalidita(Request $data){
        $idTipoInvalidita = $data->input('idTipoInvalidita');

        Invaliditum::where('idInvalidita',$idTipoInvalidita)->update(['idInvalidita'=>1]);

        TipoInvaliditum::find($idTipoInvalidita)->delete();

        return redirect("/tendine");
    }

    public function inserisciTipoDocumento(Request $data){
        TipiDocumentiIdentitum::create([
            'descrizione' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTipoDocumento(Request $data){
        $idTipoDocumento = $data->input('idTipoDocumento');

        DocumentoIdentitum::where('idTipoDocumento', $idTipoDocumento)->update(['idTipoDocumento' => 1]);

        TipiDocumentiIdentitum::find($idTipoDocumento)->delete();

        return redirect("/tendine");
    }

    public function inserisciTitoloStudio(Request $data){
        TitoloStudio::create([
            'titolo' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTitoloStudio(Request $data){
        $idTitoloStudio = $data->input('idTitoloStudio');

        AltreInfoCliente::where('idTitoloStudio',$idTitoloStudio)->update(['idTitoloStudio'=>1]);

        TitoloStudio::find($idTitoloStudio)->delete();

        return redirect("/tendine");
    }

    public function inserisciTipoProfessione(Request $data){
        TipoProfessione::create([
            'professione' => $data['descrizione'],
        ]);

        return redirect("/tendine");
    }

    public function rimuoviTipoProfessione(Request $data){
        $idProfessione = $data->input('idProfessione');

        AltreInfoCliente::where('idProfessione',$idProfessione)->update(['idProfessione'=>1]);

        TipoProfessione::find($idProfessione)->delete();

        return redirect("/tendine");
    }
}
