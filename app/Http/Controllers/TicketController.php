<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\DocumentiConsegnati;
use cafapp\Models\DocumentiOutput;
use cafapp\Models\Servizi;
use cafapp\Models\ServiziHasDocumentiObbligatori;
use cafapp\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
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
            $documentiObbligatori = ServiziHasDocumentiObbligatori::where('servizi_id', $data["servizi_id"])->get();

            $data["inserito_da"] = Auth::user()->id;
            $data["stato_ticket_id"] = 1;

            // Inserisco evento nel diario
            $istanzaDiario = new DiarioController();
            $nomeServizio = Servizi::find($data["servizi_id"])->nome;
            $messaggio = "Apertura Ticket per $nomeServizio";
            $istanzaDiario->inserisciEvento($messaggio,$data["clienti_id"]);

            $ticket = Ticket::create($data);

            $statoDocumentazione = $ticket->statoDocumentazione();

            if($statoDocumentazione){
                $ticket->stato_ticket_id = 2;
                $ticket->save();
            }

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

    public function chiudiTicket(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'documento_allegato_chiusura_ticket' => 'file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            DB::beginTransaction();
            try{
                $documento = $request->file('documento_allegato_chiusura_ticket');
                $idTicket = $request->input('id_ticket_in_modal_chiudi_ticket');
                $idCliente = $request->input('clienti_id');

                $ticket = Ticket::find($idTicket);
                $ticket->update(["stato_ticket_id" => 3, "data_chiusura" => Carbon::now()->format('Y-m-d')]); // Setta a completato

                if(isset($documento)) {
                    $destinationPath = "documenti/prodotti/$idCliente/$idTicket";
                    $extension = $documento->getClientOriginalExtension();
                    $fileName = "documento$idTicket$idCliente" . '.' . $extension;

                    $data["path"] = $fileName;

                    $doc = DocumentiOutput::where('ticket_id', $idTicket)->first();
                    if (isset($doc)) {
                        // Bisogna prima eliminare il file già presente
                        $doc->update(["path" => $fileName]);
                    } else {
                        $doc = DocumentiOutput::create(["path" => $fileName, "ticket_id" => $idTicket]);
                    }

                    $documento->move($destinationPath, $fileName);
                }

                // Inserisco evento nel diario
                $istanzaDiario = new DiarioController();
                $servizioTicket = $ticket->servizi->nome;
                $messaggio = "Chiusura ticket $servizioTicket";
                $istanzaDiario->inserisciEvento($messaggio,$idCliente);

                DB::commit();
                session()->flash("alert_success", "Salvataggio andato a buon fine");
                return redirect("diario/".$idCliente);
            } catch (\Exception $e){
                DB::rollBack();
                echo $e->getMessage();
                session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
                return back()->with("diario_delete_error","Attenzione: la cancellazione non è andata a buon fine. Riprova!");
            }
        }
    }

    public function prendiInCarico(Request $request){
        DB::beginTransaction();
        try {
            $idTicket = $request->input('ticket_id');
            $idCliente = $request->input('cliente_id');

            Ticket::find($idTicket)->update(["utente_per_lavorazione" => Auth::user()->id]);

            DB::commit();
            session()->flash("alert_success", "Salvataggio andato a buon fine");
            return redirect("diario/" . $idCliente);
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
            return back()->with("diario_delete_error","Attenzione: la cancellazione non è andata a buon fine. Riprova!");
        }
    }

    public function uploadDocumento(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'documento_allegato' => 'file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            DB::beginTransaction();
            try{
                $documento = $request->file('documento_allegato');
                $idCliente = $data["clienti_id"];
                $idDocumento = $data["documenti_servizi_id"];
                $idServizio = $data["servizio_id"];
                $idTicket = $data["ticket_id"];
                $data["users_id"] = Auth::user()->id;

                $destinationPath = "documenti/consegnati/$idCliente/$idDocumento/";
                $extension = $documento->getClientOriginalExtension();
                $fileName = "documento$idDocumento$idCliente".'.'.$extension;

                $data["path"] = $fileName;

                $doc = DocumentiConsegnati::where('clienti_id',$idCliente)->where('documenti_servizi_id',$idDocumento)->first();
                if(isset($doc)){
                    // Bisogna prima eliminare il file già presente
                    $doc->update($data);
                } else {
                    $doc = DocumentiConsegnati::create($data);
                }

                $ticketsDelCliente = Ticket::where('clienti_id',$idCliente)->get();

                foreach ($ticketsDelCliente as $ticket){
                    $documentazioneCompletata = $ticket->statoDocumentazione();
                    if($documentazioneCompletata){
                        $ticket->stato_ticket_id = 2;
                        $ticket->save();
                    }
                }

                $documento->move($destinationPath, $fileName);

                // Inserisco evento nel diario
                $istanzaDiario = new DiarioController();
                $nomeDocumento = $doc->documentiServizi->nome;
                $messaggio = "Aggiunta documento $nomeDocumento";
                $istanzaDiario->inserisciEvento($messaggio,$idCliente);

                DB::commit();
                session()->flash("alert_success", "Salvataggio andato a buon fine");
                return redirect("diario/".$idCliente);
            } catch (\Exception $e){
                DB::rollBack();
                echo $e->getMessage();
                session()->flash("alert_error", "Attenzione: il salvataggio non è andata a buon fine");
                return back()->with("diario_delete_error","Attenzione: la cancellazione non è andata a buon fine. Riprova!");
            }
        }
    }

    public function visualizeDocumento($idCliente,$idDocumento){
        $documento = DocumentiConsegnati::where('clienti_id',$idCliente)->where('documenti_servizi_id',$idDocumento)->first();

        $path = "documenti/consegnati/$idCliente/$idDocumento/$documento->path";

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function visualizeDocumentoOutput($idCliente,$idTicket){
        $documento = DocumentiOutput::where('ticket_id',$idTicket)->first();

        $path = "documenti/prodotti/$idCliente/$idTicket/$documento->path";

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
