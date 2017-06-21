@extends('caf.layout')

@section('title', 'Super Admin')

@section('titleSection', 'Super Admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain card-nav-tabs">
                    <div class="card-header" data-background-color="purple">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Tasks:</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li>
                                        <a href="{{url('caf')}}">
                                            <i class="material-icons">business</i>
                                            Gestione Caf
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="#menu_tendine" data-toggle="tab">
                                            <i class="material-icons">list</i>
                                            Gestione menu a tendina
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('servizi')}}">
                                            <i class="material-icons">contacts</i>
                                            Gestione Servizi
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="tab-content">
                            <div class="tab-pane" id="menu_caf">
                            </div>
                            <div class="tab-pane active" id="menu_tendine">
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h5 class="title">Tipi invalidità</h5>
                                            </div>
                                            <div class="card-content table-responsive">
                                                <form id="form_invalidita" method="post" action="{{ url('/inserisci_tipo_invalidita') }}">
                                                    {{ csrf_field() }}
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Descrizione</label>
                                                        <input type="text" name="descrizione" class="form-control">
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
                                                        @if($item->id != 1)
                                                            <tr>
                                                                <td>{{$item->invalidita}}</td>
                                                                <td class="td-actions text-right">
                                                                    <form method="post" id="formEliminaInvalidita{{$item->id}}" action="{{url('rimuovi_tipo_invalidita')}}">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="idTipoInvalidita" value="{{$item->id}}">
                                                                        <button onclick="$('#formEliminaInvalidita{{$item->id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                                            <i class="material-icons">close</i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h5 class="title">Documenti d'identità</h5>
                                            </div>
                                            <div class="card-content table-responsive">
                                                <form id="form_documenti" method="post" action="{{ url('/inserisci_tipo_documento') }}">
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
                                                        @if($item->id != 1)
                                                            <tr>
                                                                <td>{{$item->descrizione}}</td>
                                                                <td class="td-actions text-right">
                                                                    <form method="post" id="formEliminaDocumenti{{$item->id}}" action="{{url('rimuovi_tipo_documento')}}">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="idTipoDocumento" value="{{$item->id}}">
                                                                        <button onclick="$('#formEliminaDocumenti{{$item->id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                                            <i class="material-icons">close</i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h5 class="title">Titoli di studio</h5>
                                            </div>
                                            <div class="card-content table-responsive">
                                                <form id="form_studio" method="post" action="{{ url('/inserisci_titolo_studio') }}">
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
                                                    <th>Titoli di studio inseriti</th>
                                                    <th></th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($titoliStudio as $item)
                                                        @if($item->id != 1)
                                                            <tr>
                                                                <td>{{$item->titolo}}</td>
                                                                <td class="td-actions text-right">
                                                                    <form method="post" id="formEliminaTitoloStudio{{$item->id}}" action="{{url('rimuovi_titolo_studio')}}">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="idTitoloStudio" value="{{$item->id}}">
                                                                        <button onclick="$('#formEliminaTitoloStudio{{$item->id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                                            <i class="material-icons">close</i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h5 class="title">Professioni</h5>
                                            </div>
                                            <div class="card-content table-responsive">
                                                <form id="form_professioni" method="post" action="{{ url('/inserisci_tipo_professione') }}">
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
                                                    <th>Professioni inserite</th>
                                                    <th></th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($tipiProfessione as $item)
                                                        @if($item->id != 1)
                                                            <tr>
                                                                <td>{{$item->professione}}</td>
                                                                <td class="td-actions text-right">
                                                                    <form method="post" id="formEliminaProfessione{{$item->id}}" action="{{url('rimuovi_tipo_professione')}}">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="idProfessione" value="{{$item->id}}">
                                                                        <button onclick="$('#formEliminaProfessione{{$item->id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                                            <i class="material-icons">close</i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="menu_servizi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('caf.modal.modal_aggiungi_servizio')
@endsection

@section('functionJavascript')
    <script src="{{URL::asset('assets/jquery-validate/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/jquery-validate/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/bootstrap-datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/select2/dist/js/select2.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var regoleValidate = {
                rules: {
                    'descrizione':{
                        required: true,
                    },
                },
                messages: {
                    'descrizione':{
                        required: "Campo obbligatorio",
                    },
                }
            }

            $("#form_invalidita").validate(regoleValidate);
            $("#form_documenti").validate(regoleValidate);
            $("#form_professioni").validate(regoleValidate);
            $("#form_studio").validate(regoleValidate);
        });
    </script>
@endsection