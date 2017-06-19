<?php

namespace cafapp\Http\Controllers;

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

        $gruppoServizi = GruppiServizi::all();
        $documentiServizi = DocumentiServizi::all();
        $servizi = Servizi::all();

        return view('caf.section.gestione_caf.menu_servizi',[
            "gruppoServizi" => $gruppoServizi,
            "documentiServizi" => $documentiServizi,
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
        //
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
            return redirect("servizi");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            // return back()->with("servizio_store_error","Attenzione: il salvataggio non è andato a buon fine. Riprova!");
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
        //
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
        //
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

            $documenti->delete();
            $servizio->delete();

            DB::commit();
            return redirect("servizi");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return back();
        }
    }
}
