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
                                                            <td>&euro; {{$servizio->prezzo}}</td>
                                                            <td>{{$servizio->gruppiServizi->nome}}</td>
                                                            <td>
                                                                <button onclick="location.href='{{url("servizi/$servizio->id/edit")}}'" type="button" rel="tooltip" title="Modifica" class="btn btn-primary btn-simple btn-xs">
                                                                    <i class="material-icons">edit</i>
                                                                </button>

                                                                <!--
                                                                <form style="display:inline" method="post" action="{url("servizi/$servizio->id")}}" id="formEliminaServizio{$servizio->id}}">
                                                                    {csrf_field()}}
                                                                    { method_field('DELETE') }}
                                                                    <button onclick="$('#formEliminaServizio{$servizio->id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                                                        <i class="material-icons">close</i>
                                                                    </button>
                                                                </form>
                                                                -->
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><button onclick="location.href = '{{url('servizi/create')}}'" rel="tooltip" title="Aggiungi servizio" type="button" class="btn btn-primary"><i class="material-icons">control_point</i></button></td>
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