<?php

namespace cafapp\Http\Controllers;

use cafapp\Http\Requests\UserValidator;
use cafapp\Models\Caf;
use cafapp\Models\DocumentiServizi;
use cafapp\Models\GruppiServizi;
use cafapp\Models\TipiDocumentiIdentitum;
use cafapp\Models\TipoInvaliditum;
use cafapp\Models\TipoProfessione;
use cafapp\Models\TitoloStudio;
use cafapp\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipiInvalidita = TipoInvaliditum::all();
        $tipiDocumenti = TipiDocumentiIdentitum::all();
        $tipiProfessione = TipoProfessione::all();
        $titoliStudio = TitoloStudio::all();
        $gruppoServizi = GruppiServizi::all();
        $documentiServizi = DocumentiServizi::all();
        $caf = Caf::all();

        return view('caf.section.gesione_caf',[
            "caf" => $caf,
            "tipiInvalidita" => $tipiInvalidita,
            "tipiDocumenti" => $tipiDocumenti,
            "tipiProfessione" => $tipiProfessione,
            "titoliStudio" => $titoliStudio,
            "gruppoServizi" => $gruppoServizi,
            "documentiServizi" => $documentiServizi
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
        $data["utente"]["password"] = $data["passwordUtente"];
        $data["utente"]["password_confirmation"] = $data["passwordUtente_confirmation"];

        $userValidator = new UserValidator();
        $validatore = Validator::make($data["utente"],$userValidator->rules(),$userValidator->messages());
        if ($validatore->fails()) {
            return redirect('caf')
                ->withErrors($validatore)
                ->withInput();
        }

        DB::beginTransaction();
        try{
            $caf = Caf::create($data);
            $data["utente"]["caf_id"] = $caf->id;

            User::insertUser($data["utente"]);

            DB::commit();
            return redirect("caf");
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
        //
    }
}
