<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\Comuni;
use cafapp\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function registrazioneUtente(Request $request){
        $data = $request->all();

        $validatore = Validator::make($data, [
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

         User::create([
            'nome' => $data['nome'],
            'cognome' => $data['cognome'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'idRuolo' => $data['role'],
         ]);

         return redirect('/gestione_utenti');
    }
}
