<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\Clienti;
use cafapp\Models\GruppiServizi;
use cafapp\Models\Servizi;
use cafapp\Models\Ticket;
use cafapp\Models\VociDiario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $data["users_id"] = Auth::user()->id;
        DB::beginTransaction();
        try{
            VociDiario::create($data);
            DB::commit();
            session()->flash("alert_success", "Salvataggio andato a buon fine");
            return redirect("diario/".$data['clienti_id']);
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
            return back()->with("diario_store_error","Attenzione: il salvataggio non è andato a buon fine. Riprova!");
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
        // $id passato come parametro è l'id del cliente di cui si vuole mostrare il diario

        $diario = VociDiario::where('clienti_id','=',$id)->orderBy('created_at','')->get();
        $gruppoServizi = GruppiServizi::all();
        $servizi = Servizi::where('gruppi_servizi_id',$gruppoServizi[0]->id)->get();
        $ticketCliente = Ticket::where('clienti_id', $id)->get();
        $cliente = Clienti::find($id);

        return view("caf.section.lista_diario",[
            "cliente" => $cliente,
            "diario" => $diario,
            "gruppoServizi" => $gruppoServizi,
            "servizi" => $servizi,
            "tickets" => $ticketCliente
        ]);
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
        return $id;

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
            VociDiario::find($id)->delete();
            DB::commit();
            session()->flash("alert_success", "Salvataggio andato a buon fine");
            return back();
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
            return back()->with("diario_delete_error","Attenzione: la cancellazione non è andata a buon fine. Riprova!");
        }

    }

    public function inserisciEvento($messaggio, $idCliente){
        $data["descrizione"] = $messaggio;
        $data["clienti_id"] = $idCliente;
        $data["users_id"] = Auth::user()->id;

        VociDiario::create($data);
    }
}
