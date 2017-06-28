<?php

namespace cafapp\Http\Controllers;

use cafapp\Http\Requests\UserValidator;
use cafapp\Models\Caf;
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
        $caf = Caf::all();

        return view('caf.section.gestione_caf.menu_caf',[
            "caf" => $caf,
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

            session()->flash("alert_success", "Salvataggio andato a buon fine");
            return redirect("caf");
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
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
