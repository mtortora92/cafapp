<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\DocumentiOutput;
use cafapp\Models\DocumentiServizi;
use cafapp\Models\GruppiServizi;
use cafapp\Models\Servizi;
use cafapp\Models\ServiziHasDocumentiObbligatori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiziController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servizi = Servizi::all();

        return view('caf.section.gestione_caf.menu_servizi',[
            "servizi" => $servizi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gruppoServizi = GruppiServizi::all();
        $documentiServizi = DocumentiServizi::all();

        return view('caf.section.gestione_caf.gestione_servizi',[
            "gruppoServizi" => $gruppoServizi,
            "documentiServizi" => $documentiServizi
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

        DB::beginTransaction();
        try{
            $servizio = Servizi::create($data);

            if(isset($data["documentiObbligatori"])) {
                foreach ($data["documentiObbligatori"] as $doc) {
                    ServiziHasDocumentiObbligatori::create([
                        'servizi_id' => $servizio->id,
                        'documenti_servizi_id' => $doc,
                    ]);
                }
            }

            DB::commit();
            session()->flash("alert_success", "Salvataggio andato a buon fine");
            return redirect("servizi");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
            return back()->with("servizio_store_error","Attenzione: il salvataggio non è andato a buon fine. Riprova!");
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
        $gruppoServizi = GruppiServizi::all();
        $documentiServizi = DocumentiServizi::all();
        $servizio = Servizi::find($id);
        $documentiObbligatori = $servizio->getDocumentiObbligatori;
        $docObbArray = array();
        foreach ($documentiObbligatori as $doc){
            array_push($docObbArray, $doc->id);
        }

        return view('caf.section.gestione_caf.modifica_servizio',[
            "gruppoServizi" => $gruppoServizi,
            "documentiServizi" => $documentiServizi,
            "servizio" => $servizio,
            "docObbArray" => $docObbArray
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

        DB::beginTransaction();
        try{
            Servizi::find($id)->update($data);

            ServiziHasDocumentiObbligatori::where('servizi_id',$id)->delete();

            if(isset($data["documentiObbligatori"])) {
                foreach ($data["documentiObbligatori"] as $doc) {
                    ServiziHasDocumentiObbligatori::create([
                        'servizi_id' => $id,
                        'documenti_servizi_id' => $doc,
                    ]);
                }
            }

            DB::commit();
            session()->flash("alert_success", "Salvataggio andato a buon fine");
            return redirect("servizi");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
            return back()->with("servizio_update_error","Attenzione: il salvataggio non è andato a buon fine. Riprova!");
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
            $servizio = Servizi::find($id);
            $documenti = $servizio->serviziHasDocumentiObbligatoris();
            $tickets = $servizio->tickets();
            $documentiOutput = $tickets->documentoOutput();

            $documentiOutput->delete();
            $tickets->delete();
            $documenti->delete();
            $servizio->delete();

            DB::commit();
            session()->flash("alert_success", "Salvataggio andato a buon fine");
            return redirect("servizi");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
            return back();
        }
    }
}
