@extends('caf.layout')

@section('title', 'Gestione utenti')

@section('titleSection', 'Gestione utenti')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Inserisci utente</h4>
                        <p class="category">Tutti i campi sono obbligatori</p>
                    </div>
                    <div class="card-content">
                        <form role="form" method="POST" action="{{ url('/account') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome</label>
                                        <input type="text" name="nome" class="form-control" >

                                        @if ($errors->has('nome'))
                                            <span>
                                                <strong>{{ $errors->first('nome') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cognome</label>
                                        <input type="text" name="cognome" class="form-control" >

                                        @if ($errors->has('cognome'))
                                            <span>
                                                <strong>{{ $errors->first('cognome') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control" >

                                        @if ($errors->has('username'))
                                            <span>
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control" >

                                        @if ($errors->has('password'))
                                            <span>
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Conferma Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="role" value="2" checked="true">
                                            Operatore
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="role" value="1">
                                            Supervisore
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-round">Inserisci utente</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card card-nav-tabs">
                    <div class="card-header" data-background-color="purple">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Utenti:</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="active">
                                        <a href="#profile" data-toggle="tab">
                                            <i class="material-icons">bug_report</i>
                                            Tutti
                                            <div class="ripple-container"></div></a>
                                    </li>
                                    <li class="">
                                        <a href="#messages" data-toggle="tab">
                                            <i class="material-icons">code</i>
                                            Supervisori
                                            <div class="ripple-container"></div></a>
                                    </li>
                                    <li class="">
                                        <a href="#settings" data-toggle="tab">
                                            <i class="material-icons">cloud</i>
                                            Operatori
                                            <div class="ripple-container"></div></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <table class="table">
                                    <thead class="text-primary">
                                        <th>Nome</th>
                                        <th>Cognome</th>
                                        <th>Username</th>
                                        <th>Supervisore</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        @foreach($utentiSupervisor as $utente)
                                            <tr>
                                                <td>{{$utente->nome}}</td>
                                                <td>{{$utente->cognome}}</td>
                                                <td>{{$utente->username}}</td>
                                                <td><i class="fa fa-check"></i></td>
                                                <td class="td-actions text-right">
                                                    <form method="post" action="{{url("/account/$utente->id")}}" id="formEliminaAccount{{$utente->id}}">
                                                        {{csrf_field()}}
                                                        {{ method_field('DELETE') }}
                                                        <button onclick="$('#formEliminaAccount{{$utente->id}}').submit()" type="button" rel="tooltip" title="Rimuovi account" class="btn btn-danger btn-simple btn-xs">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach($utentiNormali as $utente)
                                            <tr>
                                                <td>{{$utente->nome}}</td>
                                                <td>{{$utente->cognome}}</td>
                                                <td>{{$utente->username}}</td>
                                                <td></td>
                                                <td class="td-actions text-right">
                                                    <form method="post" action="{{url("/account/$utente->id")}}" id="formEliminaAccount{{$utente->id}}">
                                                        {{csrf_field()}}
                                                        {{ method_field('DELETE') }}
                                                        <button onclick="$('#formEliminaAccount{{$utente->id}}').submit()" type="button" rel="tooltip" title="Rimuovi account" class="btn btn-danger btn-simple btn-xs">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="messages">
                                <table class="table">
                                    <thead class="text-primary">
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Username</th>
                                    <th>Supervisore</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($utentiSupervisor as $utente)
                                        <tr>
                                            <td>{{$utente->nome}}</td>
                                            <td>{{$utente->cognome}}</td>
                                            <td>{{$utente->username}}</td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td class="td-actions text-right">
                                                <form method="post" action="{{url("/account/$utente->id")}}" id="formEliminaAccount{{$utente->id}}">
                                                    {{csrf_field()}}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="$('#formEliminaAccount{{$utente->id}}').submit()" type="button" rel="tooltip" title="Rimuovi account" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="settings">
                                <table class="table">
                                    <thead class="text-primary">
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Username</th>
                                    <th>Supervisore</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($utentiNormali as $utente)
                                        <tr>
                                            <td>{{$utente->nome}}</td>
                                            <td>{{$utente->cognome}}</td>
                                            <td>{{$utente->username}}</td>
                                            <td></td>
                                            <td class="td-actions text-right">
                                                <form method="post" action="{{url("/account/$utente->id")}}" id="formEliminaAccount{{$utente->id}}">
                                                    {{csrf_field()}}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="$('#formEliminaAccount{{$utente->id}}').submit()" type="button" rel="tooltip" title="Rimuovi account" class="btn btn-danger btn-simple btn-xs">
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
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tipi invalidità</h4>
                        <p class="category">Gestisci tipi di invalidità</p>
                    </div>
                    <div class="card-content table-responsive">
                        <form method="post" action="{{ url('/inserisci_tipo_invalidita') }}">
                            {{ csrf_field() }}
                            <div class="form-group label-floating">
                                <label class="control-label">Descrizione</label>
                                <input type="text" name="descrizione" class="form-control" >
                                <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>

                        <table class="table">
                            <thead class="text-primary">
                            <th>Tipi invalidità inserite</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($tipiInvalidita as $item)
                                <tr>
                                    <td>{{$item->invalidita}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{url("/rimuovi_tipo_invalidita/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tipi documenti di identità</h4>
                        <p class="category">Gestisci tipologie documenti di identità</p>
                    </div>
                    <div class="card-content table-responsive">
                        <form method="post" action="{{ url('/inserisci_tipo_documento') }}">
                            {{ csrf_field() }}
                            <div class="form-group label-floating">
                                <label class="control-label">Descrizione</label>
                                <input type="text" name="descrizione" class="form-control" >
                                <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>

                        <table class="table">
                            <thead class="text-primary">
                            <th>Tipi documenti inseriti</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($tipiDocumenti as $item)
                                <tr>
                                    <td>{{$item->descrizione}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{url("/rimuovi_tipo_documento/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Titoli di studio</h4>
                        <p class="category">Gestisci titoli di studio</p>
                    </div>
                    <div class="card-content table-responsive">
                        <form method="post" action="{{ url('/inserisci_titolo_studio') }}">
                            {{ csrf_field() }}
                            <div class="form-group label-floating">
                                <label class="control-label">Descrizione</label>
                                <input type="text" name="descrizione" class="form-control" >
                                <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>

                        <table class="table">
                            <thead class="text-primary">
                            <th>Tipi titoli di studio inseriti</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($titoliStudio as $item)
                                <tr>
                                    <td>{{$item->titolo}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{url("/rimuovi_titolo_studio/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tipi di professione</h4>
                        <p class="category">Gestisci tipi di professione</p>
                    </div>
                    <div class="card-content table-responsive">
                        <form method="post" action="{{ url('/inserisci_tipo_professione') }}">
                            {{ csrf_field() }}
                            <div class="form-group label-floating">
                                <label class="control-label">Descrizione</label>
                                <input type="text" name="descrizione" class="form-control" >
                                <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>

                        <table class="table">
                            <thead class="text-primary">
                            <th>Tipi professione inseriti</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($tipiProfessione as $item)
                                <tr>
                                    <td>{{$item->professione}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{url("/rimuovi_tipo_professione/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </a>
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

@section('activeGestioneUtentiSidebar')
    class="active"
@endsection