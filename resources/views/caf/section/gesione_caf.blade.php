@extends('caf.layout')

@section('title', 'Gestione caf')

@section('titleSection', 'Gestione caf')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Inserisci caf</h4>
                        <p class="category">Tutti i campi sono obbligatori</p>
                    </div>
                    <div class="card-content">
                        <form id="formInserimentoCaf" role="form" method="POST" action="{{ url('/caf') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome Caf</label>
                                        <input type="text" name="nome" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Inserire un utente amministratore per il caf selezionato</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome</label>
                                        <input type="text" name="utente[nome]" class="form-control" >
                                        @if ($errors->has("nome"))
                                            <span>
                                                <strong>{{ $errors->first("nome") }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cognome</label>
                                        <input type="text" name="utente[cognome]" class="form-control" >

                                        @if ($errors->has("cognome"))
                                            <span>
                                                <strong>{{ $errors->first("cognome") }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="utente[username]" class="form-control" >

                                        @if ($errors->has("username"))
                                            <span>
                                                <strong>{{ $errors->first("username") }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Password</label>
                                        <input type="password" name="passwordUtente" class="form-control" >

                                        @if ($errors->has("password"))
                                            <span>
                                                <strong>{{ $errors->first("password") }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Conferma Password</label>
                                        <input type="password" name="passwordUtente_confirmation" class="form-control" >
                                    </div>
                                    <!-- Hidden per specificare che ruolo è Supervisore -->
                                    <input type="hidden" name="utente[role]" value="1">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-round">Inserisci caf</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Lista Uffici Caf</h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <th>id</th>
                            <th>Nome</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($caf as $caf)
                                @php($id = $caf->id)
                                <tr>
                                    <td>{{$caf->id}}</td>
                                    <td>{{$caf->nome}}</td>
                                    <td>
                                        <form method="post" action="" id="formEliminaCaf{{$id}}">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <button onclick="window.alert('Funzione ancora non disponibile')//$('#formEliminaCaf{{$id}}').submit()" type="button" rel="tooltip" title="Elimina Caf" class="btn btn-danger btn-simple btn-xs">
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

@section('functionJavascript')
    <script src="{{URL::asset('assets/jquery-validate/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/jquery-validate/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/bootstrap-datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/select2/dist/js/select2.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#formInserimentoCaf").validate({
                rules: {
                    'nome':{
                        required: true,
                    },
                },
                messages: {
                    'nome':{
                        required: "Il nome del Caf è obbligatorio"
                    },
                }
            });
        });
    </script>
@endsection