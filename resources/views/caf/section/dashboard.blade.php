@extends('caf.layout')

@section('title', 'Dashboard')

@section('titleSection', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                @if(Auth::user()->isSupervisor() || Auth::user()->isSuperAdmin())
                <div onclick="location.href='{{url('/account')}}'" style="cursor:pointer" class="card card-stats">
                @else
                <div onclick="window.alert('Solo gli utenti supervisori possono accedere alla sezione')" class="card card-stats">
                @endif
                    <div class="card-header" data-background-color="purple">
                        <i class="material-icons">content_paste</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Solo utenti supervisori</p>
                        <h3 class="title">Amministrazione</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            Gestisci account
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div onclick="location.href='{{url('/clienti')}}'" style="cursor:pointer" class="card card-stats">
                    <div class="card-header" data-background-color="purple">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="card-content">
                        <p class="category">&nbsp;</p>
                        <h3 class="title">Gestisci clienti</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            Visualizza clienti inseriti e gestisci quelli esistenti
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title">Ticket presi in carico da te</h4>
                        <p class="category">Lista dei ticket ci cui ti sei preso l'incarico della lavorazione</p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover add_data_table">
                            <thead class="text-info">
                            <th>Cliente</th>
                            <th>Servizio</th>
                            <th>Note</th>
                            <th>Data</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($ticketPresiInCaricoDaUtenteLoggato as $item)
                                <tr>
                                    <td>{{$item->clienti->anagrafica->nome}} {{$item->clienti->anagrafica->cognome}}</td>
                                    <td>{{$item->servizi->nome}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>{{str_replace('-', '/', date('d-m-Y', strtotime($item->created_at)))}}</td>
                                    <td>
                                        @php($idCliente = $item->clienti->id)
                                        <button onclick="location.href='{{url("/diario/$idCliente")}}'" type="button" rel="tooltip" title="Modifica" class="btn btn-info btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h4 class="title">Ticket presi in carico da altri utenti</h4>
                            <p class="category">Lista dei ticket che altri utenti hanno preso per la lavorazione</p>
                        </div>
                        <div class="card-content table-responsive">
                            <table class="table table-hover add_data_table">
                                <thead class="text-success">
                                <th>Cliente</th>
                                <th>Servizio</th>
                                <th>Note</th>
                                <th>Data</th>
                                <th>Utente</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($ticketPresiInCaricoDaAltriUtenti as $item)
                                    <tr>
                                        <td>{{$item->clienti->anagrafica->nome}} {{$item->clienti->anagrafica->cognome}}</td>
                                        <td>{{$item->servizi->nome}}</td>
                                        <td>{{$item->note}}</td>
                                        <td>{{str_replace('-', '/', date('d-m-Y', strtotime($item->created_at)))}}</td>
                                        <td>{{$item->user->nome}} {{$item->user->cognome}}</td>
                                        <td>
                                            @php($idCliente = $item->clienti->id)
                                            <button onclick="location.href='{{url("/diario/$idCliente")}}'" type="button" rel="tooltip" title="Modifica" class="btn btn-success btn-simple btn-xs">
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Ticket da prendere in carico</h4>
                        <p class="category">Lista dei ticket la cui documentazione è stata consegnata</p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover add_data_table">
                            <thead class="text-warning">
                            <th>Cliente</th>
                            <th>Servizio</th>
                            <th>Note</th>
                            <th>Data</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($ticketDaPrendereInCarico as $item)
                                <tr>
                                    <td>{{$item->clienti->anagrafica->nome}} {{$item->clienti->anagrafica->cognome}}</td>
                                    <td>{{$item->servizi->nome}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>{{str_replace('-', '/', date('d-m-Y', strtotime($item->created_at)))}}</td>
                                    <td>
                                        @php($idCliente = $item->clienti->id)
                                        <button onclick="location.href='{{url("/diario/$idCliente")}}'" type="button" rel="tooltip" title="Modifica" class="btn btn-warning btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="red">
                            <h4 class="title">Ticket in attesa di documentazione</h4>
                            <p class="category">Lista dei ticket la cui documentazione manca</p>
                        </div>
                        <div class="card-content table-responsive">
                            <table class="table table-hover add_data_table">
                                <thead class="text-danger">
                                <th>Cliente</th>
                                <th>Servizio</th>
                                <th>Note</th>
                                <th>Data</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($ticketInAttesaDiDocumentazione as $item)
                                    <tr>
                                        <td>{{$item->clienti->anagrafica->nome}} {{$item->clienti->anagrafica->cognome}}</td>
                                        <td>{{$item->servizi->nome}}</td>
                                        <td>{{$item->note}}</td>
                                        <td>{{str_replace('-', '/', date('d-m-Y', strtotime($item->created_at)))}}</td>
                                        <td>
                                            @php($idCliente = $item->clienti->id)
                                            <button onclick="location.href='{{url("/diario/$idCliente")}}'" type="button" rel="tooltip" title="Modifica" class="btn btn-danger btn-simple btn-xs">
                                                <i class="material-icons">edit</i>
                                            </button>
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

@section('activeDashboardSidebar')
    class="active"
@endsection
    @section('functionJavascript')
        <script type="text/javascript">
            $(document).ready(function() {
                $('.add_data_table').DataTable({
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
                $('.add_data_table_filter > label > input').attr('class','form-control');
            } );
        </script>
@endsection