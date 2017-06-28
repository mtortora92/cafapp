@extends('caf.layout')

@section('title', 'Diario')

@section('titleSection', 'Diario')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <button data-toggle="modal" data-target="#modalAggiungiVoceDiario" class="btn btn-primary">Inserisci Evento</button>
            </div>
            <div class="col-md-2">
                <button data-toggle="modal" data-target="#modalApriTicket" class="btn btn-primary">Apri Ticket</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Diario di {{$cliente->anagrafica->nome}} {{$cliente->anagrafica->cognome}}</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table id="diario" class="table table-hover">
                            <thead>
                            <th>Evento</th>
                            <th>Utente</th>
                            <th>Data inserimento</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($diario as $eventi)
                                <tr>
                                    <td>{{$eventi->descrizione}}</td>
                                    <td>{{$eventi->user->nome}} {{$eventi->user->cognome}}</td>
                                    <td>{{str_replace('-', '/', date('d-m-Y H:i', strtotime($eventi->created_at->setTimeZone(new DateTimeZone('Europe/Rome')))))}}</td>
                                    <td>
                                        <form method="post" action="{{url("/diario/$eventi->id")}}" id="formEliminaVoceDiario{{$eventi->id}}">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <button onclick="$('#formEliminaVoceDiario{{$eventi->id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @foreach($tickets as $ticket)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="{{ticketStateBackgroundColor($ticket->stato_ticket_id)}}">
                        <h4 class="title">Ticket: {{$ticket->servizi->nome}} (Aperto da {{$ticket->inseritoDa->nome}} {{$ticket->inseritoDa->cognome}})</h4>
                        <p class="category">
                            <i onclick="location.href='{{url("informativa_privacy/$ticket->id")}}'" class="material-icons" role="button" rel="tooltip" title="Informativa sulla privacy">assignment</i>
                        </p>
                    </div>
                    <div class="card-content table-responsive">
                        Importo:  {{$ticket->importo}} &euro;
                        <br>
                        Note:  {{$ticket->note}}
                        <br>
                        Documenti obbligatori:
                        <table class="table table-hover">
                            <thead>
                                <th>Nome</th>
                                <th>Descrizione</th>
                                <th></th>
                            </thead>
                            @php($documentiObbligatori = $ticket->servizi->getDocumentiObbligatori)
                            @if(count($documentiObbligatori) == 0)
                                <tbody>
                                <tr><td colspan="3">Nessun documento richiesto</td></tr>
                                </tbody>
                            @else
                                @foreach($documentiObbligatori as $documentoObb)
                                    <tbody>
                                    <tr>
                                        <td>{{$documentoObb->nome}}</td>
                                        <td>{{$documentoObb->descrizione}}</td>
                                        <td>
                                            <form method="post" id="formUploadDoc{{$ticket->id}}{{$documentoObb->id}}" enctype="multipart/form-data" style="display:inline" action="{{url('/ticket/upload_documento')}}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="documenti_servizi_id" value="{{$documentoObb->id}}">
                                                <input type="hidden" name="clienti_id" value="{{$cliente->id}}">
                                                <input type="hidden" name="servizio_id" value="{{$ticket->servizi_id}}">
                                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                                <input name="documento_allegato" onchange="$('#formUploadDoc{{$ticket->id}}{{$documentoObb->id}}').submit()" style="display:none" type="file" id="documentoObb{{$ticket->id}}{{$documentoObb->id}}">
                                                <button onclick="$('#documentoObb{{$ticket->id}}{{$documentoObb->id}}').click();" type="button" rel="tooltip" title="Allega documento" class="btn btn-simple">
                                                    <i class="material-icons {{ticketStateTextColor($ticket->stato_ticket_id)}}">attach_file</i>
                                                </button>
                                            </form>
                                            @php($documentoPresenza = \cafapp\Models\DocumentiConsegnati::where('clienti_id',$cliente->id)->where('documenti_servizi_id',$documentoObb->id)->first())
                                            @if(isset($documentoPresenza))
                                                <button type="button" rel="tooltip" title="Documento inserito da {{$documentoPresenza->user->nome}} {{$documentoPresenza->user->cognome}} il {{str_replace('-', '/', date('d-m-Y', strtotime($documentoPresenza->created_at)))}}" class="btn btn-simple">
                                                    <a target="_blank" href="{{url("visualizza_documento/$cliente->id/$documentoObb->id")}}"><i class="material-icons {{ticketStateTextColor($ticket->stato_ticket_id)}}">visibility</i></a>
                                                </button>
                                            @else
                                                <button onclick="window.alert('Allegare documento per visualizzarlo')" type="button" rel="tooltip" title="Documento non allegato" class="btn btn-simple">
                                                    <a><i class="material-icons {{ticketStateTextColor($ticket->stato_ticket_id)}}">visibility_off</i></a>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            @endif
                        </table>
                        @if($ticket->stato_ticket_id == 2 && !isset($ticket->utente_per_lavorazione))
                            <form method="post" enctype="multipart/form-data" style="display:inline" action="{{url('prendi_in_carico_lavorazione')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <input type="submit" class="btn btn-warning" value="Procedi alla lavorazione">
                            </form>
                        @elseif($ticket->stato_ticket_id == 2 && isset($ticket->utente_per_lavorazione))
                            @if($ticket->utente_per_lavorazione != Auth::user()->id)
                                <h6 class="{{ticketStateTextColor($ticket->stato_ticket_id)}}">
                                    La lavorazione è stata già presa in carico dall'utente {{$ticket->user->nome}} {{$ticket->user->cognome}}
                                </h6>
                            @else
                                <button onclick="$('.modal-body #id_ticket_in_modal_chiudi_ticket').val('{{$ticket->id}}')" data-toggle="modal" data-target="#modalChiudiTicket" class="btn btn-warning">Chiudi il Ticket</button>
                            @endif
                        @elseif($ticket->stato_ticket_id == 3)
                            <h6 class="{{ticketStateTextColor($ticket->stato_ticket_id)}}">
                                La lavorazione è stata completata dall'utente {{$ticket->user->nome}} {{$ticket->user->cognome}}
                                @if(isset($ticket->data_chiusura))
                                    il {{str_replace('-', '/', date('d-m-Y', strtotime($ticket->data_chiusura)))}}
                                @endif
                            </h6>
                                <form method="post" enctype="multipart/form-data" style="display:inline" action="{{url('chiudi_ticket')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id_ticket_in_modal_chiudi_ticket" value="{{$ticket->id}}">
                                    <input type="hidden" name="clienti_id" value="{{$cliente->id}}">
                                    <input name="documento_allegato_chiusura_ticket" onchange="this.form.submit()" style="display:none" type="file" id="documentoOutput{{$ticket->id}}">
                                    <button onclick="$('#documentoOutput{{$ticket->id}}').click();" type="button" rel="tooltip" title="Allega documento per cliente" class="btn btn-simple">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </form>
                                @php($documentoOutputPresenza = \cafapp\Models\DocumentiOutput::where('ticket_id',$ticket->id)->first())
                                @if(isset($documentoOutputPresenza))
                                    <button type="button" rel="tooltip" title="Visualizza documento del cliente" class="btn btn-simple">
                                        <a target="_blank" href="{{url("visualizza_documento_output/$cliente->id/$ticket->id")}}"><i class="material-icons {{ticketStateTextColor($ticket->stato_ticket_id)}}">visibility</i></a>
                                    </button>
                                @else
                                    <button onclick="window.alert('Allegare documento per visualizzarlo')" type="button" rel="tooltip" title="Documento non allegato" class="btn btn-simple btn-success">
                                        <a><i class="material-icons {{ticketStateTextColor($ticket->stato_ticket_id)}}">visibility_off</i></a>
                                    </button>
                                @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection

@section('modal')
    @include('caf.modal.modal_voci_diario')
    @include('caf.modal.modal_aggiungi_ticket')
@endsection

@section('functionJavascript')
    <script src="{{URL::asset('assets/jquery-validate/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/jquery-validate/additional-methods.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#diario').DataTable({
                "language": {
                    "lengthMenu": "Numero di _MENU_ per pagina",
                    "zeroRecords": "Nessun Risultato",
                    "info": "Pagina _PAGE_ di _PAGES_",
                    "infoEmpty": "Nessun cliente trovato",
                    "infoFiltered": "",
                    "search": "Filtra",
                    "paginate": {
                        "previous": "Precedente",
                        "next": "Prossima"
                    }
                }
            });
            $('#diario_filter > label > input').attr('class','form-control');
        } );
    </script>
@endsection