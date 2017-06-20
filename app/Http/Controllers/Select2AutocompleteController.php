<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\Comuni;
use cafapp\Models\Servizi;
use Illuminate\Http\Request;


class Select2AutocompleteController extends Controller
{
    /**
     * Show the application layout.
     *
     * @return \Illuminate\Http\Response
     */
    public function layout()
    {
        return view('app.uic.soci.form');
    }

    /**
     * @api
     * Show the application dataAjax.
     * @param App\Http\Requests $request dati passati in POST|GET
     * - es.
     *
     * @return \Illuminate\Http\Response
     */
    public function getComuni(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;

            $data = Comuni::select("id","comune")->where('comune','LIKE',"$search%")->get();
        }else {
            $data = Comuni::all();
        }

        return response()->json($data);
    }

    function ticketSelectServizi($idGruppoServizio){
        $listaOptionServizi = Servizi::where('gruppi_servizi_id',$idGruppoServizio)->get();

        $stringa = "";

        foreach ($listaOptionServizi as $servizio){
            $id = $servizio->id;
            $nome = $servizio->nome;
            $stringa = $stringa."<option value='$id'>$nome</option>";
        }

        return response()->json([
            'listaOptionServizi' => $stringa,
        ]);
    }
}
