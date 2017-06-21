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
                                    <li>
                                        <a href="{{url('tendine')}}">
                                            <i class="material-icons">list</i>
                                            Gestione menu a tendina
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="#menu_servizi" data-toggle="tab">
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
                            <div class="tab-pane" id="menu_tendine">
                            </div>
                            <div class="tab-pane active" id="menu_servizi">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h4 class="title">Servizi</h4>
                                                <p class="category"></p>
                                            </div>
                                            <div class="card-content table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <th>Nome</th>
                                                        <th>Prezzo</th>
                                                        <th>Gruppo</th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($servizi as $servizio)
                                                        <tr>
                                                            <td>{{$servizio->nome}}</td>
                                                            <td>{{$servizio->prezzo}}</td>
                                                            <td>{{$servizio->gruppiServizi->nome}}</td>
                                                            <td>
                                                                <!--
                                                                <button onclick="window.alert('Funzione ancora non disponibile')" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                                                    <i class="material-icons">edit</i>
                                                                </button>
                                                                -->
                                                                <form method="post" action="{{url("servizi/$servizio->id")}}" id="formEliminaServizio{{$servizio->id}}">
                                                                    {{csrf_field()}}
                                                                    {{ method_field('DELETE') }}
                                                                    <button onclick="$('#formEliminaServizio{{$servizio->id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
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
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h4 class="title">Inserisci nuovo servizio</h4>
                                                <p class="category">Tutti i campi sono obbligatori</p>
                                            </div>
                                            <div class="card-content">
                                                <form id="formInserimentoServizio" role="form" method="POST" action="{{ url('servizi') }}">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Gruppo Servizio</label>
                                                                <select class="form-control" data-placeholder="Gruppo servizio" name="gruppi_servizi_id">
                                                                    @foreach($gruppoServizi as $gruppo)
                                                                        <option value="{{$gruppo->id}}">{{$gruppo->nome}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Nome</label>
                                                                <input type="text" class="form-control" data-placeholder="Nome" name="nome">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Prezzo</label>
                                                                <input value='0' type="text" class="form-control" data-placeholder="Prezzo" name="prezzo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h6>Documenti obbligatori</h6>
                                                    <div class="row">
                                                        @foreach($documentiServizi as $doc)
                                                            @php($id = $doc->id)
                                                            <div class="col-md-3">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$id}}" name="documentiObbligatori[]">
                                                                        {{$doc->nome}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-round">Inserisci servizio</button>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h4 class="title">Gruppi servizi</h4>
                                                <p class="category"></p>
                                            </div>
                                            <div class="card-content table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <th>Nome</th>
                                                    <th><i data-toggle="modal" data-target="#modalAggiungiGruppoServizio" role="button" class="material-icons">control_point</i></th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($gruppoServizi as $gruppo)
                                                        @php($id = $gruppo->id)
                                                        <tr>
                                                            <td>{{$gruppo->nome}}</td>
                                                            <td>
                                                                <form method="post" action="" id="formEliminaGruppo{{$id}}">
                                                                    {{csrf_field()}}
                                                                    <button onclick="window.alert('Funzione ancora non disponibile')//$('#formEliminaGruppo{{$id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
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
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" data-background-color="purple">
                                                <h4 class="title">Documenti</h4>
                                                <p class="category"></p>
                                            </div>
                                            <div class="card-content table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <th>Nome</th>
                                                    <th><i data-toggle="modal" data-target="#modalAggiungiDocumento" role="button" class="material-icons">control_point</i></th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($documentiServizi as $doc)
                                                        @php($id = $doc->id)
                                                        <tr>
                                                            <td>{{$doc->nome}}</td>
                                                            <td>
                                                                <form method="post" action="" id="formEliminaDocumentoServizio{{$id}}">
                                                                    {{csrf_field()}}
                                                                    <button onclick="window.alert('Funzione ancora non disponibile')//$('#formEliminaDocumentoServizio{{$id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
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
            $("#formInserimentoServizio").validate({
                rules: {
                    'nome':{
                        required: true,
                    },
                    'prezzo':{
                        required:true,
                        number:true,
                    }
                },
                messages: {
                    'nome':{
                        required: "Il nome del servizio è obbligatorio"
                    },
                    'prezzo':{
                        required:"Deve essere un numero",
                        number:"Deve essere un numero",
                    }
                }
            });
        });
    </script>
@endsection