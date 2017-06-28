@extends('caf.layout')

@section('title', 'Inserisci clienti')

@section('styleCSS')
    <!-- Css di bootstrap datepicker -->
    <link href="{{ URL::asset('assets/bootstrap-datepicker/bootstrap-datepicker3.css')}}" rel="stylesheet"/>
    <!-- Css di select2 -->
    <link href="{{ URL::asset('assets/select2/dist/css/select2.css')}}" rel="stylesheet"/>
@endsection

@section('titleSection', 'Inserisci clienti')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Nuovo cliente</h4>
                        <p class="category">Inserisci le informazione sul cliente</p>
                    </div>
                    <div class="card-content">
                        <form id="formInserimentoCliente" method="post" action="{{url('/clienti')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cod. Cliente</label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">N. della Tessera Enotria</label>
                                        <input name="numTesseraEnotria" value="" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="socio">
                                            Socio
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="delegaSindacale">
                                            Delega Sindacale
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="socioEnotriaCral">
                                            Socio Enotria Cral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="2" name="idTipologiaCliente">
                                            Persona Giuridica
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="1" name="idTipologiaCliente" checked="true">
                                            Persona Fisica
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cognome (in caso di persona giuridica Ragione Sociale)</label>
                                        <input type="text" id="cognome" name="cognome" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome</label>
                                        <input type="text" id="nome" name="nome" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="M" name="sesso" checked="true">
                                            Maschio
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="F" name="sesso">
                                            Femmina
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data di nascita (gg/mm/aaaa)</label>
                                        <input type="text" id="dataNascita" name="dataNascita" class="form-control datepicker-field" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Luogo di nascita</label>
                                        <select id="luogoNascita" name="luogoNascita" data-placeholder="Luogo di nascita" class="form-control select-comuni"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Codice Fiscale</label>
                                        <input type="text" name="codiceFiscale" class="form-control">
                                        @if ($errors->has("codiceFiscale"))
                                            <span>
                                                <strong>{{ $errors->first("codiceFiscale") }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Partita Iva</label>
                                        <input type="text" name="partitaIva" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Pin Inps</label>
                                        <input type="text" name="pinInps" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="idInvalidita">Invalidità:</label>
                                        <select class="form-control" id="invalidita" name="idInvalidita">
                                            @foreach($tipiInvalidita as $item)
                                                <option value="{{$item->id}}">{{$item->invalidita}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">% invalidità</label>
                                        <input type="text" name="percentuale" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="accompagnamento">
                                            Accompagnamento
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Indirizzo</label>
                                        <input type="text" name="indirizzoResidenza" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cap</label>
                                        <input type="text" maxlength="5" name="capResidenza" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Comune di residenza</label>
                                        <select id="comuneResidenza" name="comuneResidenza" data-placeholder="Comune" class="form-control select-comuni"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Tipo documento:</label>
                                        <select class="form-control" id="tipoDocumento" name="idTipoDocumento">
                                            @foreach($tipiDocumenti as $item)
                                                <option value="{{$item->id}}">{{$item->descrizione}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data rilascio (gg/mm/aaaa)</label>
                                        <input type="text" class="form-control datepicker-field" id="dataRilascio" name="dataRilascio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Rilasciato dal comune</label>
                                        <select id="comuneDiRilascio" name="rilasciatoDa" data-placeholder="Rilasciato da" class="form-control select-comuni"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data scadenza (gg/mm/aaaa)</label>
                                        <input type="text" class="form-control datepicker-field" id="dataScadenza" name="dataScadenza">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Titolo di studio:</label>
                                        <select class="form-control" id="titoloStudio" name="idTitoloStudio">
                                            @foreach($titoliStudio as $item)
                                                <option value="{{$item->id}}">{{$item->titolo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Professione:</label>
                                        <select class="form-control" id="tipoProfessione" name="idProfessione">
                                            @foreach($tipiProfessione as $item)
                                                <option value="{{$item->id}}">{{$item->professione}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Telefono/Fax</label>
                                        <input type="text" class="form-control" name="telefono">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare</label>
                                        <input type="text" class="form-control" name="cellulare">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary pull-right" value="Salva">
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('activeListaClientiSidebar')
    class="active"
@endsection

@section('functionJavascript')
    <script src="{{URL::asset('assets/jquery-validate/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/jquery-validate/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/bootstrap-datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/select2/dist/js/select2.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('assets/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.datepicker-field').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
            });

            $('.select-comuni').select2({
                minlength: 3,
                ajax: {
                    url: '{{url('select2-autocomplete-ajax')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.comune,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $("#formInserimentoCliente").validate({
                rules: {
                    'cognome':{
                        required: true,
                    },
                    'nome':{
                        required: true,
                    },
                    'codiceFiscale':{
                        required: true,
                    },
                    'capResidenza':{
                        digits: true,
                        minlength: 5,
                        maxlength: 5,
                    },
                    'luogoNascita':{
                        required: true
                    },
                    'dataNascita':{
                        required: true,
                        dateITA: true
                    },
                    'dataRilascio':{
                        dateITA: true,
                    },
                    'dataScadenza':{
                        dateITA: true,
                    },
                    'telefono':{
                        required: true,
                        number: true,
                    },
                    'cellulare':{
                        number: true,
                    },
                    'email':{
                        email: true,
                    },
                },
                messages: {
                    'cognome':{
                        required: "Il cognome è obbligatorio"
                    },
                    'nome':{
                        required: "Il nome è obbligatorio"
                    },
                    'codiceFiscale':{
                        required: "Il codice fiscale è obbligatorio"
                    },
                    'capResidenza':{
                        digits: "5 cifre",
                        minlength: "5 cifre",
                        maxlength: "5 cifre",
                    },
                    'luogoNascita':{
                        required: "Obbligatorio"
                    },
                    'dataNascita':{
                        required: "Obbligatorio",
                        dateITA: "Inserire data in formato corretto"
                    },
                    'dataRilascio':{
                        dateITA: "Inserire data in formato corretto"
                    },
                    'dataScadenza':{
                        dateITA: "Inserire data in formato corretto"
                    },
                    'telefono':{
                        required: "Inserire numero",
                        number: "Inserire numero",
                    },
                    'cellulare':{
                        number: "Inserire numero",
                    },
                    'email':{
                        email: "Inserire mail valida",
                    }
                }
            });
        });
    </script>
@endsection