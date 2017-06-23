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
                                                <h4 class="title">Modifica servizio</h4>
                                                <p class="category">Tutti i campi sono obbligatori</p>
                                            </div>
                                            <div class="card-content">
                                                <form id="formModificaServizio" role="form" method="POST" action="{{ url("servizi/$servizio->id") }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Gruppo Servizio</label>
                                                                <select class="form-control" data-placeholder="Gruppo servizio" name="gruppi_servizi_id">
                                                                    @foreach($gruppoServizi as $gruppo)
                                                                        @if($gruppo->id == $servizio->gruppi_servizi_id)
                                                                            <option value="{{$gruppo->id}}" selected>{{$gruppo->nome}}</option>
                                                                        @else
                                                                            <option value="{{$gruppo->id}}">{{$gruppo->nome}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Nome</label>
                                                                <input value="{{$servizio->nome}}" type="text" class="form-control" data-placeholder="Nome" name="nome">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Importo (&euro;)</label>
                                                                <input value='{{$servizio->prezzo}}' type="text" class="form-control" data-placeholder="Prezzo" name="prezzo">
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
                                                                        @if(in_array($id,$docObbArray))
                                                                            <input checked type="checkbox" value="{{$id}}" name="documentiObbligatori[]">
                                                                        @else
                                                                            <input type="checkbox" value="{{$id}}" name="documentiObbligatori[]">
                                                                        @endif
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
                            </div>
                        </div>
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
            $("#formModificaServizio").validate({
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