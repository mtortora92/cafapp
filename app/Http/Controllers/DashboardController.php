<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketDaPrendereInCarico = Ticket::whereHas('clienti', function($query) {
            $query->where('caf_id', Auth::user()->caf_id);
        })->where('stato_ticket_id',2)->where('utente_per_lavorazione',null)->orderBy('created_at')->get();


        $ticketPresiInCaricoDaUtenteLoggato = Ticket::whereHas('clienti', function($query) {
            $query->where('caf_id', Auth::user()->caf_id);
        })->where('stato_ticket_id',2)->where('utente_per_lavorazione',Auth::user()->id)->orderBy('created_at')->get();

        $ticketPresiInCaricoDaAltriUtenti = Ticket::whereHas('clienti', function($query) {
            $query->where('caf_id', Auth::user()->caf_id);
        })->where('stato_ticket_id',2)->where('utente_per_lavorazione',"!=",Auth::user()->id)->where('utente_per_lavorazione',"!=",null)->orderBy('created_at')->get();
        $ticketInAttesaDiDocumentazione = Ticket::whereHas('clienti', function($query) {
            $query->where('caf_id', Auth::user()->caf_id);
        })->where('stato_ticket_id', 1)->orderBy('created_at')->get();

        return view('caf.section.dashboard',[
            "ticketDaPrendereInCarico" => $ticketDaPrendereInCarico,
            "ticketPresiInCaricoDaUtenteLoggato" => $ticketPresiInCaricoDaUtenteLoggato,
            "ticketInAttesaDiDocumentazione" => $ticketInAttesaDiDocumentazione,
            "ticketPresiInCaricoDaAltriUtenti" => $ticketPresiInCaricoDaAltriUtenti
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
        //
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
