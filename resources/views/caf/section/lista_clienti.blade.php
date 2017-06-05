@php
    $arrayClienti = DB::table('Clienti')
        ->join('AnagraficheClienti', 'Clienti.idAnagrafica', '=', 'AnagraficheClienti.id')
        ->select('AnagraficheClienti.*','Clienti.id as idCliente')->get();
@endphp

@extends('caf.layout')

@section('title', 'Lista clienti')

@section('titleSection', 'Lista clienti')

@section('content')
    <div class="container-fluid">
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
                            </thead>
                            <tbody>
                            @foreach($arrayClienti as $cliente)
                                <tr onclick="location.href='{{url("/modifica_cliente/$cliente->idCliente")}}'" style="cursor:pointer">
                                    <td>{{$cliente->cognome}}</td>
                                    <td>{{$cliente->nome}}</td>
                                    <td>{{str_replace('-', '/', date('d-m-Y', strtotime($cliente->dataNascita)))}}</td>
                                    <td>{{$cliente->luogoNascita}}</td>
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