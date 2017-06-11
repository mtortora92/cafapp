@extends('caf.layout')

@section('title', 'Lista clienti')

@section('titleSection', 'Lista clienti')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button onclick="location.href='{{url("/clienti/create")}}'" class="btn btn-primary">Inserisci Nuovo cliente</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Lista clienti</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <th>Cognome</th>
                            <th>Nome</th>
                            <th>Nato/a il</th>
                            <th>Nato/a a</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($clienti as $cliente)
                                @php($id = $cliente->cliente->id)
                                <tr>
                                    <td>{{$cliente->cognome}}</td>
                                    <td>{{$cliente->nome}}</td>
                                    <td>
                                        @if(isset($cliente->dataNascita))
                                        {{str_replace('-', '/', date('d-m-Y', strtotime($cliente->dataNascita)))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($cliente->luogo_nascita->comune))
                                        {{$cliente->luogo_nascita->comune}}
                                        @endif
                                    </td>
                                    <td>
                                        <button onclick="location.href='{{url("/clienti/$id/edit")}}'" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <form method="post" action="{{url("/clienti/$id")}}" id="formEliminaCliente{{$id}}">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                        <button onclick="$('#formEliminaCliente{{$id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
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
    </div>
@endsection

@section('activeListaClientiSidebar')
    class="active"
@endsection