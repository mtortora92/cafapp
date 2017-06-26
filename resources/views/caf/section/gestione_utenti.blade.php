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
                                            <i class="material-icons">supervisor_account</i>
                                            Tutti
                                            <div class="ripple-container"></div></a>
                                    </li>
                                    <li class="">
                                        <a href="#messages" data-toggle="tab">
                                            <i class="material-icons">verified_user</i>
                                            Supervisori
                                            <div class="ripple-container"></div></a>
                                    </li>
                                    <li class="">
                                        <a href="#settings" data-toggle="tab">
                                            <i class="material-icons">accessibility</i>
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
                                                    <button onclick="setModalEditUser('{{url("account/$utente->id")}}', '{{$utente->nome}}', '{{$utente->cognome}}', '{{$utente->username}}', '{{$utente->idRuolo}}')" data-toggle="modal" data-target="#modalModificaAccount" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                                        <i class="material-icons">edit</i>
                                                    </button>
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
                                                    <button onclick="setModalEditUser('{{url("account/$utente->id")}}', '{{$utente->nome}}', '{{$utente->cognome}}', '{{$utente->username}}', '{{$utente->idRuolo}}')" data-toggle="modal" data-target="#modalModificaAccount" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                                        <i class="material-icons">edit</i>
                                                    </button>
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
                                                <button onclick="setModalEditUser('{{url("account/$utente->id")}}', '{{$utente->nome}}', '{{$utente->cognome}}', '{{$utente->username}}', '{{$utente->idRuolo}}')" data-toggle="modal" data-target="#modalModificaAccount" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                                    <i class="material-icons">edit</i>
                                                </button>
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
                                                <button onclick="setModalEditUser('{{url("account/$utente->id")}}', '{{$utente->nome}}', '{{$utente->cognome}}', '{{$utente->username}}', '{{$utente->idRuolo}}')" data-toggle="modal" data-target="#modalModificaAccount" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
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
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('caf.modal.modal_modifica_account')
@endsection

@section('activeGestioneUtentiSidebar')
    class="active"
@endsection