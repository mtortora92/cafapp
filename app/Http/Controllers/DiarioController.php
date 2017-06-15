<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\VociDiario;
use Illuminate\Http\Request;
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
        DB::beginTransaction();
        try{
            VociDiario::create($data);
            DB::commit();
            return redirect("diario/".$data['clienti_id']);
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
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
        //
        $diario = VociDiario::where('clienti_id','=',$id)->get();
        return view("caf.section.lista_diario",[
            "clienteId" => $id,
            "diario" => $diario
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
        try{
            VociDiario::find($id)->delete();
            DB::commit();
            return back();
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return back()->with("diario_delete_error","Attenzione: la cancellazione non è andata a buon fine. Riprova!");
        }

    }
}
