<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\DocumentiConsegnati;
use cafapp\Models\DocumentiOutput;
use cafapp\Models\ServiziHasDocumentiObbligatori;
use cafapp\Models\Ticket;
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

            if(count($documentiObbligatori) == 0){
                $data["stato_ticket_id"] = 2;  // Pronto per la lavorazione
            } else {
                $data["stato_ticket_id"] = 1;   // In attesa della documentazione
            }

            Ticket::create($data);
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

                Ticket::find($idTicket)->update(["stato_ticket_id" => 3]); // Setta a completato

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

                DB::commit();
                return redirect("diario/".$idCliente);
            } catch (\Exception $e){
                DB::rollBack();
                echo $e->getMessage();
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
            return redirect("diario/" . $idCliente);
        } catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
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

                $documentiObbligatoriPerServizio = ServiziHasDocumentiObbligatori::where('servizi_id',$idServizio)->get();
                $documentazioneCompleta = true;

                foreach ($documentiObbligatoriPerServizio as $item){
                    $documentoConsegnato = DocumentiConsegnati::where('clienti_id', $idCliente)->where('documenti_servizi_id',$item->documenti_servizi_id);

                    if(!isset($documentoConsegnato)){
                        $documentazioneCompleta = false;
                    }
                }

                if($documentazioneCompleta){
                    // Se la documentazione è stata completata setta lo stato del ticket a pronto per la presa in carico
                    Ticket::find($idTicket)->update(["stato_ticket_id" => 2]);
                }

                $documento->move($destinationPath, $fileName);

                DB::commit();
                return redirect("diario/".$idCliente);
            } catch (\Exception $e){
                DB::rollBack();
                echo $e->getMessage();
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
