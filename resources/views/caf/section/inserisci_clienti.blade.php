@php
    $tipiInvalidita = \cafapp\Models\TipoInvaliditum::all();
    $tipiDocumenti = \cafapp\Models\TipiDocumentiIdentitum::all();
    $tipiProfessione = \cafapp\Models\TipoProfessione::all();
    $titoliStudio = \cafapp\Models\TitoloStudio::all();
@endphp

@extends('caf.layout')

@section('title', 'Inserisci clienti')

@section('styleCSS')
    <!-- Css di jquery ui -->
    <link href="../assets/jquery-ui/jquery-ui.css" rel="stylesheet"/>
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
                        <form id="formInserimentoCliente" method="post" action="{{url('/inserisci_clienti')}}">
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
                                        <input name="numTesseraEnotria" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="socio">
                                            Socio
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="delegaSindacale">
                                            Delega Sindacale
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="socioEnotriaCral">
                                            Socio Enotria Cral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="2" name="tipologiaCliente">
                                            Persona Giuridica
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="1" name="tipologiaCliente" checked="true">
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
                                        <input type="text" id="dataNascita" name="dataNascita" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Luogo di nascita</label>
                                        <input onkeyup="ottieniListaCitta('comuneNascita')" id="comuneNascita" name="comuneNascita" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Codice Fiscale</label>
                                        <input type="text" name="codiceFiscale" class="form-control">
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
                                        <label for="tipoDocumento">Invalidità:</label>
                                        <select class="form-control" id="invalidita" name="invalidita">
                                            <option value="0">Nessuna</option>
                                            @foreach($tipiInvalidita as $item)
                                                <option value="{{$item->id}}">{{$item->invalidita}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">% invalidità</label>
                                        <input type="text" name="percentInvalidita" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="accompagnamento">
                                            Accompagnamento
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Indirizzo</label>
                                        <input type="text" name="indirizzo" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Comune di residenza</label>
                                        <input onkeyup="ottieniListaCitta('comuneResidenza')" type="text" id="comuneResidenza" name="comuneResidenza" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Tipo documento:</label>
                                        <select class="form-control" id="tipoDocumento" name="tipoDocumento">
                                            @foreach($tipiDocumenti as $item)
                                                <option value="{{$item->id}}">{{$item->descrizione}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data rilascio (gg/mm/aaaa)</label>
                                        <input type="text" class="form-control" id="dataRilascio" name="dataRilascio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Rilasciato dal comune</label>
                                        <input onkeyup="ottieniListaCitta('comuneDiRilascio')" type="text" class="form-control" id="comuneDiRilascio" name="comuneDiRilascio">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data scadenza (gg/mm/aaaa)</label>
                                        <input type="text" class="form-control" id="dataScadenza" name="dataScadenza">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Titolo di studio:</label>
                                        <select class="form-control" id="titoloStudio" name="titoloStudio">
                                            @foreach($titoliStudio as $item)
                                                <option value="{{$item->id}}">{{$item->titolo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="form-group">
                                        <label for="tipoDocumento">Professione:</label>
                                        <select class="form-control" id="tipoProfessione" name="tipoProfessione">
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

                            <input type="submit" class="btn btn-primary pull-right" value="Inserisci cliente">
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