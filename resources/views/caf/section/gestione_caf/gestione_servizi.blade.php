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
                            <div class="tab-pane" id="menu_tendine">
                            </div>
                            <div class="tab-pane active" id="menu_servizi">
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
                                                            <i onclick="setModalAddServizio('{{url('inserisci_gruppo_servizi')}}', '')" rel="tooltip" title="Aggiungi gruppo" data-toggle="modal" data-target="#modalAggiungiGruppoServizio" role="button" class="material-icons">control_point</i>
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
                                                                <label class="control-label">Importo (&euro;)</label>
                                                                <input value='0' type="text" class="form-control" data-placeholder="Prezzo" name="prezzo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h6>Documenti obbligatori</h6>
                                                    <i onclick="setModalAddDocumento('{{url('inserisci_documento_servizi')}}', '','')" rel="tooltip" title="Aggiungi documento" data-toggle="modal" data-target="#modalAggiungiDocumento" role="button" class="material-icons">control_point</i>
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
                                                    <th></th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($gruppoServizi as $gruppo)
                                                        @php($id = $gruppo->id)
                                                        <tr>
                                                            <td>{{$gruppo->nome}}</td>
                                                            <td>
                                                                <!--
                                                                <form method="post" style="display:inline" action="{url('rimuovi_gruppo_servizi')}}" id="formEliminaGruppo{$id}}">
                                                                    {csrf_field()}}
                                                                    <input type="hidden" name="id_gruppo_da_eliminare" value="{$id}}">
                                                                    <button onclick="$('#formEliminaGruppo{$id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                                        <i class="material-icons">close</i>
                                                                    </button>
                                                                </form>
                                                                -->

                                                                <button onclick="setModalAddServizio('{{url('modifica_gruppo_servizi')}}', '{{$gruppo->nome}}', '{{$id}}')" data-toggle="modal" data-target="#modalAggiungiGruppoServizio" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                                                    <i class="material-icons">edit</i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td><button onclick="setModalAddServizio('{{url('inserisci_gruppo_servizi')}}', '')" rel="tooltip" title="Aggiungi gruppo" data-toggle="modal" data-target="#modalAggiungiGruppoServizio" type="button" class="btn btn-primary"><i class="material-icons">control_point</i></button></td>
                                                    </tr>
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
                                                    <th></th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($documentiServizi as $doc)
                                                        @php($id = $doc->id)
                                                        <tr>
                                                            <td>{{$doc->nome}}</td>
                                                            <td>
                                                                <form method="post" style="display:inline" action="{{url('rimuovi_documento_servizi')}}" id="formEliminaDocumentoServizio{{$id}}">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="id_doc_da_eliminare" value="{{$id}}">
                                                                    <button onclick="$('#formEliminaDocumentoServizio{{$id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                                        <i class="material-icons">close</i>
                                                                    </button>
                                                                </form>

                                                                <button onclick="setModalAddDocumento('{{url('modifica_documento_servizi')}}', '{{$doc->nome}}','{{$doc->descrizione}}', '{{$id}}')" data-toggle="modal" data-target="#modalAggiungiDocumento" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                                                    <i class="material-icons">edit</i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td><button onclick="setModalAddDocumento('{{url('inserisci_documento_servizi')}}', '','')" rel="tooltip" title="Aggiungi documento" data-toggle="modal" data-target="#modalAggiungiDocumento" type="button" class="btn btn-primary"><i class="material-icons">control_point</i></button></td>
                                                    </tr>
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