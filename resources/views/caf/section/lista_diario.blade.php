@extends('caf.layout')

@section('title', 'Diario')

@section('titleSection', 'Diario')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#modalAggiungiVoceDiario" class="btn btn-primary">Inserisci Evento</button>
            </div>
        </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Eventi</h4>
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

@endsection
<!-- Modal Aggiungi Voce Diario -->
<div id="modalAggiungiVoceDiario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inserisci Evento</h4>
            </div>
            <div class="modal-body">
                <form id="formInserimentoEvento" method="post" action="{{url('/diario')}}">
                    {{csrf_field()}}
                    <div class="form-group label-floating">
                    <label class="control-label">Descrizione</label>
                    <textarea name="descrizione" class="form-control"></textarea>
                </div>
                    <input type="hidden" class="form-control" name="clienti_id" value="{{$clienteId}}"/>

                    <input type="submit" class="btn btn-primary" value="Salva"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
            </div>
        </div>

    </div>
</div>

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