@extends('caf.layout')

@section('title', 'Modifica cliente')

@section('styleCSS')
    <!-- Css di bootstrap datepicker -->
    <link href="{{ URL::asset('assets/bootstrap-datepicker/bootstrap-datepicker3.css')}}" rel="stylesheet"/>
    <!-- Css di select2 -->
    <link href="{{ URL::asset('assets/select2/dist/css/select2.css')}}" rel="stylesheet"/>
@endsection

@section('titleSection', 'Modifica cliente')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Modifica cliente</h4>
                        <p class="category">Inserisci le informazione sul cliente</p>
                    </div>
                    <div class="card-content">
                        <form id="formModificaCliente" method="post" action="{{url("/clienti/$cliente->id")}}">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cod. Cliente</label>
                                        <input type="text" value="{{$cliente->id}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">N. della Tessera Enotria</label>
                                        <input name="numTesseraEnotria" value="{{$cliente->altre_info->numTesseraEnotria}}" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->altre_info->socio)
                                                <input type="checkbox" value="1" name="socio" checked>
                                            @else
                                                <input type="checkbox" value="1" name="socio">
                                            @endif
                                            Socio
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->altre_info->delegaSindacale)
                                                <input type="checkbox" value="1" name="delegaSindacale" checked>
                                            @else
                                                <input type="checkbox" value="1" name="delegaSindacale">
                                            @endif
                                            Delega Sindacale
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->altre_info->socioEnotriaCral)
                                                <input type="checkbox" value="1" name="socioEnotriaCral" checked>
                                            @else
                                                <input type="checkbox" value="1" name="socioEnotriaCral">
                                            @endif
                                            Socio Enotria Cral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="radio">
                                        <label>
                                            @if($cliente->anagrafica->idTipologiaCliente == 2)
                                                <input type="radio" value="2" name="idTipologiaCliente" checked>
                                            @else
                                                <input type="radio" value="2" name="idTipologiaCliente">
                                            @endif
                                            Persona Giuridica
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            @if($cliente->anagrafica->idTipologiaCliente == 1)
                                                <input type="radio" value="1" name="idTipologiaCliente" checked>
                                            @else
                                                <input type="radio" value="1" name="idTipologiaCliente">
                                            @endif
                                            Persona Fisica
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cognome (in caso di persona giuridica Ragione Sociale)</label>
                                        <input type="text" value="{{$cliente->anagrafica->cognome}}" id="cognome" name="cognome" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome</label>
                                        <input type="text" value="{{$cliente->anagrafica->nome}}" id="nome" name="nome" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label>
                                            @if($cliente->anagrafica->sesso == "M")
                                                <input type="radio" value="M" name="sesso" checked="true">
                                            @else
                                                <input type="radio" value="M" name="sesso">
                                            @endif
                                            Maschio
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            @if($cliente->anagrafica->sesso == "F")
                                                <input type="radio" value="F" name="sesso" checked="true">
                                            @else
                                                <input type="radio" value="F" name="sesso">
                                            @endif
                                            Femmina
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data di nascita (gg/mm/aaaa)</label>
                                        @if(isset($cliente->anagrafica->dataNascita))
                                            <input type="text" id="dataNascita" value="{{str_replace('-', '/', date('d-m-Y', strtotime($cliente->anagrafica->dataNascita)))}}" name="dataNascita" class="form-control datepicker-field" >
                                        @else
                                            <input type="text" id="dataNascita" value="" name="dataNascita" class="form-control datepicker-field" >
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group label-floating">
                                        <label class="control-label">Luogo di nascita</label>
                                        <select id="luogoNascita" name="luogoNascita" data-placeholder="Luogo di nascita" class="form-control select-comuni">
                                            @if(isset($cliente->anagrafica->luogoNascita))
                                                <option value="{{$cliente->anagrafica->luogo_nascita->id}}" selected>{{$cliente->anagrafica->luogo_nascita->comune}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Codice Fiscale</label>
                                        <input type="text" name="codiceFiscale" value="{{$cliente->anagrafica->codiceFiscale}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Partita Iva</label>
                                        <input type="text" value="{{$cliente->anagrafica->partitaIva}}" name="partitaIva" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Pin Inps</label>
                                        <input type="text" value="{{$cliente->anagrafica->pinInps}}" name="pinInps" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Invalidità:</label>
                                        <select class="form-control" id="invalidita" name="idInvalidita">
                                            @foreach($tipiInvalidita as $item)
                                                @if(isset($cliente->invalidita->idInvalidita) && $cliente->invalidita->idInvalidita == $item->id)
                                                    <option value="{{$item->id}}" selected>{{$item->invalidita}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->invalidita}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">% invalidità</label>
                                        <input type="text" value="{{$cliente->invalidita->percentuale}}" name="percentuale" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->invalidita->accompagnamento)
                                                <input type="checkbox" value="1" name="accompagnamento" checked>
                                            @else
                                                <input type="checkbox" value="1" name="accompagnamento">
                                            @endif
                                            Accompagnamento
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Indirizzo</label>
                                        <input type="text" value="{{$cliente->anagrafica->indirizzoResidenza}}" name="indirizzoResidenza" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cap</label>
                                        <input type="text" value="{{$cliente->anagrafica->capResidenza}}" maxlength="5" name="capResidenza" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Comune di residenza</label>
                                        <select id="comuneResidenza" name="comuneResidenza" data-placeholder="Comune" value="{{$cliente->anagrafica->comuneResidenza}}" class="form-control select-comuni">
                                            @if(isset($cliente->anagrafica->comuneResidenza))
                                                <option value="{{$cliente->anagrafica->comune_residenza->id}}" selected>{{$cliente->anagrafica->comune_residenza->comune}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Tipo documento:</label>
                                        <select class="form-control" id="tipoDocumento" name="idTipoDocumento">
                                            @foreach($tipiDocumenti as $item)
                                                @if($cliente->documento_identita->idTipoDocumento == $item->id)
                                                    <option value="{{$item->id}}" selected>{{$item->descrizione}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->descrizione}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data rilascio (gg/mm/aaaa)</label>
                                        @if(isset($cliente->documento_identita->dataRilascio))
                                            <input type="text" value="{{str_replace('-', '/', date('d-m-Y', strtotime($cliente->documento_identita->dataRilascio)))}}" class="form-control datepicker-field" id="dataRilascio" name="dataRilascio">
                                        @else
                                            <input type="text" value="" class="form-control datepicker-field" id="dataRilascio" name="dataRilascio">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Rilasciato dal comune</label>
                                        <select id="comuneDiRilascio" name="rilasciatoDa" data-placeholder="Rilasciato da" value="{{$cliente->documento_identita->rilasciatoDa}}" class="form-control select-comuni">
                                            @if(isset($cliente->documento_identita->rilasciatoDa))
                                                <option value="{{$cliente->documento_identita->rilasciato_da->id}}" selected>{{$cliente->documento_identita->rilasciato_da->comune}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data scadenza (gg/mm/aaaa)</label>
                                        @if($cliente->documento_identita->dataScadenza)
                                            <input type="text" value="{{str_replace('-', '/', date('d-m-Y', strtotime($cliente->documento_identita->dataScadenza)))}}" class="form-control datepicker-field" id="dataScadenza" name="dataScadenza">
                                        @else
                                            <input type="text" value="" class="form-control datepicker-field" id="dataScadenza" name="dataScadenza">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Titolo di studio:</label>
                                        <select class="form-control" id="titoloStudio" name="idTitoloStudio">
                                            @foreach($titoliStudio as $item)
                                                @if($cliente->altre_info->idTitoloStudio == $item->id)
                                                    <option value="{{$item->id}}" selected>{{$item->titolo}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->titolo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Professione:</label>
                                        <select class="form-control" id="tipoProfessione" name="idProfessione">
                                            @foreach($tipiProfessione as $item)
                                                @if($cliente->altre_info->idProfessione == $item->id)
                                                    <option value="{{$item->id}}" selected>{{$item->professione}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->professione}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Telefono/Fax</label>
                                        <input value="{{$cliente->altre_info->telefono}}" type="text" class="form-control" name="telefono">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare</label>
                                        <input value="{{$cliente->altre_info->cellulare}}" type="text" class="form-control" name="cellulare">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email</label>
                                        <input value="{{$cliente->altre_info->email}}" type="text" class="form-control" name="email">
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary pull-right" value="Aggiorna cliente">
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
    <script src="{{ URL::asset('assets/jquery-validate/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/jquery-validate/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/bootstrap-datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/select2/dist/js/select2.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>

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

            $("#formModificaCliente").validate({
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
                    'dataNascita':{
                        dateITA: true,
                    },
                    'dataRilascio':{
                        dateITA: true,
                    },
                    'dataScadenza':{
                        dateITA: true,
                    },
                    'telefono':{
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
                    'dataNascita':{
                        dateITA: "Inserire data in formato corretto"
                    },
                    'dataRilascio':{
                        dateITA: "Inserire data in formato corretto"
                    },
                    'dataScadenza':{
                        dateITA: "Inserire data in formato corretto"
                    },
                    'telefono':{
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