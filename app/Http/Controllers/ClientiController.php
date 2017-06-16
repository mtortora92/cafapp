<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\AltreInfoCliente;
use cafapp\Models\AnagraficheClienti;
use cafapp\Models\Clienti;
use cafapp\Models\Comuni;
use cafapp\Models\DocumentoIdentitum;
use cafapp\Models\Invaliditum;
use cafapp\Models\TipiDocumentiIdentitum;
use cafapp\Models\TipoInvaliditum;
use cafapp\Models\TipoProfessione;
use cafapp\Models\TitoloStudio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clienti = Clienti::getClientiPerCaf(Auth::user()->caf_id);

        return view("caf.section.lista_clienti",[
            "clienti" => $clienti,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipiInvalidita = TipoInvaliditum::all();
        $tipiDocumenti = TipiDocumentiIdentitum::all();
        $tipiProfessione = TipoProfessione::all();
        $titoliStudio = TitoloStudio::all();

        return view("caf.section.inserisci_clienti",[
            "tipiInvalidita" => $tipiInvalidita,
            "tipiDocumenti" => $tipiDocumenti,
            "tipiProfessione" => $tipiProfessione,
            "titoliStudio" => $titoliStudio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($data["dataNascita"] != "") {
            $data["dataNascita"] = Carbon::createFromFormat('d/m/Y', $data["dataNascita"])->format('Y-m-d');
        } else {
            $data["dataNascita"] = null;
        }
        if($data["dataRilascio"] != "") {
            $data["dataRilascio"] = Carbon::createFromFormat('d/m/Y', $data["dataRilascio"])->format('Y-m-d');
        } else {
            $data["dataRilascio"] = null;
        }
        if($data["dataScadenza"] != "") {
            $data["dataScadenza"] = Carbon::createFromFormat('d/m/Y', $data["dataScadenza"])->format('Y-m-d');
        } else {
            $data["dataScadenza"] = null;
        }
        if($data["idInvalidita"] == 0){
            $data["idInvalidita"] = null;
        }

        $validatore = $this->controllaCodiceFiscale(["codiceFiscale" => $data["codiceFiscale"]]);
        if(isset($validatore)){
            return redirect('clienti/create')
                ->withErrors($validatore)
                ->withInput();
        }

        DB::beginTransaction();
        try{
            $anagrafica = AnagraficheClienti::create($data);
            $altro = AltreInfoCliente::create($data);
            $invalidita = Invaliditum::create($data);
            $documento = DocumentoIdentitum::create($data);

            $cliente = Clienti::create(["idAnagrafica"=>$anagrafica->id,"idInvalidita"=>$invalidita->id,"idDocumentoIdentita"=>$documento->id,"idAltreInfo"=>$altro->id,"caf_id" => Auth::user()->caf_id]);

            DB::commit();
            return redirect("clienti");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return back()->with("socio_store_error","Attenzione: il salvataggio non è andato a buon fine. Riprova!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipiInvalidita = TipoInvaliditum::all();
        $tipiDocumenti = TipiDocumentiIdentitum::all();
        $tipiProfessione = TipoProfessione::all();
        $titoliStudio = TitoloStudio::all();
        $comuni = Comuni::all();
        $cliente = Clienti::with('documento_identita','invalidita','anagrafica','altre_info')->find($id);

        return view("caf.section.modifica_clienti",[
            "cliente" => $cliente,
            "tipiInvalidita" => $tipiInvalidita,
            "tipiDocumenti" => $tipiDocumenti,
            "tipiProfessione" => $tipiProfessione,
            "titoliStudio" => $titoliStudio,
            "comuni" => $comuni
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if($data["dataNascita"] != "") {
            $data["dataNascita"] = Carbon::createFromFormat('d/m/Y', $data["dataNascita"])->format('Y-m-d');
        } else {
            $data["dataNascita"] = null;
        }
        if($data["dataRilascio"] != "") {
            $data["dataRilascio"] = Carbon::createFromFormat('d/m/Y', $data["dataRilascio"])->format('Y-m-d');
        } else {
            $data["dataRilascio"] = null;
        }
        if($data["dataScadenza"] != "") {
            $data["dataScadenza"] = Carbon::createFromFormat('d/m/Y', $data["dataScadenza"])->format('Y-m-d');
        } else {
            $data["dataScadenza"] = null;
        }
        if($data["idInvalidita"] == 0){
            $data["idInvalidita"] = null;
        }

        if($data["codiceFiscale"] != $data["verificaCodiceFiscale"]) {
            $validatore = $this->controllaCodiceFiscale(["codiceFiscale" => $data["codiceFiscale"]]);
            if (isset($validatore)) {
                return redirect("clienti/$id/edit")
                    ->withErrors($validatore)
                    ->withInput();
            }
        }

        DB::beginTransaction();
        try{
            $cliente = Clienti::with('documento_identita','invalidita','anagrafica','altre_info')->find($id);

            $anagrafica = $cliente->anagrafica;
            $anagrafica->fill($data)->save();
            $invalidita = $cliente->invalidita;
            $invalidita->fill($data)->save();
            $documento_identita = $cliente->documento_identita;
            $documento_identita->fill($data)->save();
            $altre_info = $cliente->altre_info;
            $altre_info->fill($data)->save();

            DB::commit();
            return redirect("clienti");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return back()->with("socio_store_error","Attenzione: il salvataggio non è andato a buon fine. Riprova!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $cliente = Clienti::with('documento_identita','invalidita','anagrafica','altre_info')->find($id);

            $anagrafica = $cliente->anagrafica;
            $invalidita = $cliente->invalidita;
            $documento_identita = $cliente->documento_identita;
            $altre_info = $cliente->altre_info;

            $cliente->delete();
            $anagrafica->delete();
            $invalidita->delete();
            $documento_identita->delete();
            $altre_info->delete();

            DB::commit();
            return redirect("clienti");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return back();
        }
    }

    private function controllaCodiceFiscale($codiceFiscale){
        $rules = ['codiceFiscale' => 'unique:AnagraficheClienti'];
        $messages = ['codiceFiscale.unique' => 'Codice Fiscale già esistente'];

        $validatore = Validator::make($codiceFiscale, $rules, $messages);

        if ($validatore->fails()) {
            return $validatore;
        } else {
            return null;
        }
    }

}
