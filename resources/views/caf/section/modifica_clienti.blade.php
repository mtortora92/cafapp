@php
    $tipiInvalidita = \cafapp\Models\TipoInvaliditum::all();
    $tipiDocumenti = \cafapp\Models\TipiDocumentiIdentitum::all();
    $tipiProfessione = \cafapp\Models\TipoProfessione::all();
    $titoliStudio = \cafapp\Models\TitoloStudio::all();

    $cliente = DB::table('Clienti')
        ->join('AnagraficheClienti', 'Clienti.idAnagrafica', '=', 'AnagraficheClienti.id')
        ->join('Invalidita', 'Clienti.idInvalidita', '=', 'Invalidita.id')
        ->join('AltreInfoCliente', 'Clienti.idAltreInfo', '=', 'AltreInfoCliente.id')
        ->join('DocumentoIdentita', 'Clienti.idDocumentoIdentita', '=', 'DocumentoIdentita.id')
        ->select('AnagraficheClienti.*','Invalidita.*','AltreInfoCliente.*','DocumentoIdentita.*')
        ->where('Clienti.id', $idCliente)
        ->first();
@endphp

@extends('caf.layout')

@section('title', 'Modifica cliente')

@section('styleCSS')
    <!-- Css di jquery ui -->
    <link href="../assets/jquery-ui/jquery-ui.css" rel="stylesheet"/>
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
                        <form id="formInserimentoCliente" method="post" action="{{url('/modifica_cliente')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cod. Cliente</label>
                                        <input type="text" value="{{$idCliente}}" class="form-control" disabled>
                                        <input type="hidden" value="{{$idCliente}}" name="idClienteDaModificare">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">N. della Tessera Enotria</label>
                                        <input name="numTesseraEnotria" value="{{$cliente->numTesseraEnotria}}" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->socio)
                                                <input type="checkbox" name="socio" checked>
                                            @else
                                                <input type="checkbox" name="socio">
                                            @endif
                                            Socio
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->delegaSindacale)
                                                <input type="checkbox" name="delegaSindacale" checked>
                                            @else
                                                <input type="checkbox" name="delegaSindacale">
                                            @endif
                                            Delega Sindacale
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->socioEnotriaCral)
                                                <input type="checkbox" name="socioEnotriaCral" checked>
                                            @else
                                                <input type="checkbox" name="socioEnotriaCral">
                                            @endif
                                            Socio Enotria Cral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="radio">
                                        <label>
                                            @if($cliente->idTipologiaCliente == 2)
                                                <input type="radio" value="2" name="tipologiaCliente" checked>
                                            @else
                                                <input type="radio" value="2" name="tipologiaCliente">
                                            @endif
                                            Persona Giuridica
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            @if($cliente->idTipologiaCliente == 1)
                                                <input type="radio" value="1" name="tipologiaCliente" checked>
                                            @else
                                                <input type="radio" value="1" name="tipologiaCliente">
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
                                        <input type="text" value="{{$cliente->cognome}}" id="cognome" name="cognome" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome</label>
                                        <input type="text" value="{{$cliente->nome}}" id="nome" name="nome" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio">
                                        <label>
                                            @if($cliente->sesso == "M")
                                                <input type="radio" value="M" name="sesso" checked="true">
                                            @else
                                                <input type="radio" value="M" name="sesso">
                                            @endif
                                            Maschio
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            @if($cliente->sesso == "F")
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
                                        <input type="text" id="dataNascita" value="{{str_replace('-', '/', date('d-m-Y', strtotime($cliente->dataNascita)))}}" name="dataNascita" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Luogo di nascita</label>
                                        <input onkeyup="ottieniListaCitta('comuneNascita')" id="comuneNascita" value="{{$cliente->luogoNascita}}" name="comuneNascita" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Codice Fiscale</label>
                                        <input type="text" name="codiceFiscale" value="{{$cliente->codiceFiscale}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Partita Iva</label>
                                        <input type="text" value="{{$cliente->partitaIva}}" name="partitaIva" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Pin Inps</label>
                                        <input type="text" value="{{$cliente->pinInps}}" name="pinInps" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Invalidità:</label>
                                        <select class="form-control" id="invalidita" name="invalidita">
                                            <option value="0">Nessuna</option>
                                            @foreach($tipiInvalidita as $item)
                                                @if(isset($cliente->idInvalidita) && $cliente->idInvalidita == $item->id)
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
                                        <input type="text" value="{{$cliente->percentuale}}" name="percentInvalidita" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="checkbox">
                                        <label>
                                            @if($cliente->accompagnamento)
                                                <input type="checkbox" name="accompagnamento" checked>
                                            @else
                                                <input type="checkbox" name="accompagnamento">
                                            @endif
                                            Accompagnamento
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Indirizzo</label>
                                        <input type="text" value="{{$cliente->indirizzoResidenza}}" name="indirizzo" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Comune di residenza</label>
                                        <input onkeyup="ottieniListaCitta('comuneResidenza')" value="{{$cliente->comuneResidenza}}" type="text" id="comuneResidenza" name="comuneResidenza" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Tipo documento:</label>
                                        <select class="form-control" id="tipoDocumento" name="tipoDocumento">
                                            @foreach($tipiDocumenti as $item)
                                                @if($cliente->idTipoDocumento == $item->id)
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
                                        <input type="text" value="{{str_replace('-', '/', date('d-m-Y', strtotime($cliente->dataRilascio)))}}" class="form-control" id="dataRilascio" name="dataRilascio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Rilasciato dal comune</label>
                                        <input onkeyup="ottieniListaCitta('comuneDiRilascio')" value="{{$cliente->rilasciatoDa}}" type="text" class="form-control" id="comuneDiRilascio" name="comuneDiRilascio">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data scadenza (gg/mm/aaaa)</label>
                                        <input type="text" value="{{str_replace('-', '/', date('d-m-Y', strtotime($cliente->dataScadenza)))}}" class="form-control" id="dataScadenza" name="dataScadenza">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Titolo di studio:</label>
                                        <select class="form-control" id="titoloStudio" name="titoloStudio">
                                            @foreach($titoliStudio as $item)
                                                @if($cliente->idTitoloStudio == $item->id)
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
                                        <select class="form-control" id="tipoProfessione" name="tipoProfessione">
                                            @foreach($tipiProfessione as $item)
                                                @if($cliente->idProfessione == $item->id)
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
                                        <input value="{{$cliente->telefono}}" type="text" class="form-control" name="telefono">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cellulare</label>
                                        <input value="{{$cliente->cellulare}}" type="text" class="form-control" name="cellulare">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email</label>
                                        <input value="{{$cliente->email}}" type="text" class="form-control" name="email">
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

@section('activeInserisciClientiSidebar')
    class="active"
@endsection

@section('functionJavascript')
    <script src="../assets/jquery-ui/jquery-ui.js" type="text/javascript"></script>
    <script src="../assets/jquery-validate/jquery.validate.js" type="text/javascript"></script>
    <script src="../assets/jquery-validate/additional-methods.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#formInserimentoCliente").validate({
                rules: {
                    'cognome':{
                        required: true,
                    },
                    'nome':{
                        required: true,
                    },
                    'dataNascita':{
                        required: false,
                        dateITA: true,
                    },
                    'dataRilascio':{
                        required: false,
                        dateITA: true,
                    },
                    'dataScadenza':{
                        required: false,
                        dateITA: true,
                    }
                },
                messages: {
                    'cognome':{
                        required: "Il cognome è obbligatorio"
                    },
                    'nome':{
                        required: "Il nome è obbligatorio"
                    },
                    'dataNascita':{
                        dateITA: "Inserire data in formato corretto"
                    },
                    'dataRilascio':{
                        dateITA: "Inserire data in formato corretto"
                    },
                    'dataScadenza':{
                        dateITA: "Inserire data in formato corretto"
                    }
                }
            });
        });

        function ottieniListaCitta(idTextField){
            var data = $("#"+idTextField).val();

            $.ajax({
                url : '/getData/'+data,
                type : 'get',
                cache : false,
                success : function(data) {
                    autocompletamento(data, idTextField);
                }
            });
        }

        function autocompletamento(data, idTextField){
            $('input:text').bind({

            });

            $("#"+idTextField).autocomplete({
                minlenght: 3,
                autoFocus: true,
                source: data,
            });
        }
    </script>
@endsection