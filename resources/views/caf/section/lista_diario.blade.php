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
                        <table id="example" class="table table-hover">
                            <thead>
                            <th>Evento</th>
                            <th>Data inserimento</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($diario as $eventi)
                                <tr>
                                    <td>{{$eventi->descrizione}}</td>
                                    <td>{{str_replace('-', '/', date('d-m-Y', strtotime($eventi->created_at)))}}</td>
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
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Ticket: {{$ticket->servizi->nome}}</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        Sconto:  {{$ticket->sconto}}
                        <br>
                        Note:  {{$ticket->note}}
                        <br>
                        Documenti obbligatori:
                        <table id="example" class="table table-hover">
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
                                @php($documentazioneConsegnata = true)
                                @foreach($documentiObbligatori as $documentoObb)
                                    <tbody>
                                    <tr>
                                        <td>{{$documentoObb->nome}}</td>
                                        <td>{{$documentoObb->descrizione}}</td>
                                        <td>
                                            <form method="post" enctype="multipart/form-data" style="display:inline" action="{{url('/ticket/upload_documento')}}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="documenti_servizi_id" value="{{$documentoObb->id}}">
                                                <input type="hidden" name="clienti_id" value="{{$cliente->id}}">
                                                <input name="documento_allegato" onchange="this.form.submit()" style="display:none" type="file" id="documentoObb{{$documentoObb->id}}">
                                                <button onclick="$('#documentoObb{{$documentoObb->id}}').click();" type="button" rel="tooltip" title="Allega documento" class="btn btn-simple">
                                                    <i class="material-icons">attach_file</i>
                                                </button>
                                            </form>
                                            @php($documentoPresenza = \cafapp\Models\DocumentiConsegnati::where('clienti_id',$cliente->id)->where('documenti_servizi_id',$documentoObb->id)->first())
                                            @if(isset($documentoPresenza))
                                                <button type="button" rel="tooltip" title="Visualizza documento" class="btn btn-simple">
                                                    <a target="_blank" href="{{url("visualizza_documento/$cliente->id/$documentoObb->id")}}"><i class="material-icons">visibility</i></a>
                                                </button>
                                                <button onclick="window.alert('Funzione ancora non disponibile')" type="button" rel="tooltip" title="Rimuovi Documento" class="btn btn-danger btn-simple btn-xs">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            @else
                                                @php($documentazioneConsegnata = false)
                                                <button onclick="window.alert('Allegare documento per visualizzarlo')" type="button" rel="tooltip" title="Documento non allegato" class="btn btn-simple">
                                                    <a><i class="material-icons">visibility_off</i></a>
                                                </button>
                                                <button onclick="window.alert('Nessun documento da rimuovere')" type="button" rel="tooltip" title="Rimuovi Documento" class="btn btn-danger btn-simple btn-xs">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            @endif
                        </table>
                        @if($documentazioneConsegnata)
                            <form method="post" enctype="multipart/form-data" style="display:inline" action="{{url('prendi_in_carico_lavorazione')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <input type="submit" class="btn btn-primary" value="Procedi alla lavorazione">
                            </form>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable(
                {"language": {
                    "lengthMenu": "Numero di _MENU_ per pagina",
                    "zeroRecords": "Nessun Risultato",
                    "info": "Pagina _PAGE_ di _PAGES_",
                    "infoEmpty": "Nessun cliente trovato",
                    "infoFiltered": ""}
                });
            $('#example_filter > label > input').attr('class','form-control');
        } );
    </script>
@endsection