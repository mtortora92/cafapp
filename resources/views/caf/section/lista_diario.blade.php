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

@section('modal')
    @include('caf.modal.modal_voci_diario')
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