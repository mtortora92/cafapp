<?php

namespace cafapp\Http\Controllers;

use cafapp\Http\Requests\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use cafapp\User;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utentiSupervisor = User::getUtentiSupervisorPerCaf(Auth::user()->caf_id);
        $utentiNormali = User::getUtentiNormaliPerCaf(Auth::user()->caf_id);

        return view('caf.section.gestione_utenti',[
            "utentiNormali" => $utentiNormali,
            "utentiSupervisor" => $utentiSupervisor,
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
     * @param UserValidator $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserValidator $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try{
            $data["caf_id"] = Auth::user()->caf_id;

            User::insertUser($data);

            DB::commit();

            session()->flash("alert_success", "Nuovo utente salvato correttamente");
            return redirect('account');
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andato a buon fine");
            return back()->with("user_update_error","Attenzione: l'operazione non è andata a buon fine. Riprova!");
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
        $data = $request->all();

        DB::beginTransaction();
        try{
            $user = User::find($id);
            $user->password = bcrypt($data["password"]);
            $user->save();

            DB::commit();

            session()->flash("alert_success", "Password correttamente modificata");
            return redirect('account');
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: la modifica non è andata a buon fine");
            return back()->with("user_update_error","Attenzione: l'operazione non è andata a buon fine. Riprova!");
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
        User::find($id)->delete();
        return redirect('/account');
    }
}
