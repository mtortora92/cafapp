<?php

namespace cafapp\Http\Controllers;

use cafapp\Models\AltreInfoCliente;
use cafapp\Models\AnagraficheClienti;
use cafapp\Models\Clienti;
use cafapp\Models\DocumentoIdentitum;
use cafapp\Models\Invaliditum;
use Illuminate\Http\Request;

class GestioneClientiController extends Controller
{
    public function inserisciCliente(Request $data){
        $numTesseraEnotria = $data->input('numTesseraEnotria');
        $socio = $data->input('socio');
        $delegaSindacale = $data->input('delegaSindacale');
        $socioEnotriaCral = $data->input('socioEnotriaCral');
        $tipologiaCliente = $data->input('tipologiaCliente');
        $cognome = $data->input('cognome');
        $nome = $data->input('nome');
        $sesso = $data->input('sesso');
        $dataNascita = date('Y-m-d', strtotime(str_replace('/', '-', $data->input('dataNascita'))));
        $comuneNascita = $data->input('comuneNascita');
        $codiceFiscale = $data->input('codiceFiscale');
        $partitaIva = $data->input('partitaIva');
        $pinInps = $data->input('pinInps');
        $invalidita = $data->input('invalidita');
        if($invalidita == 0){
            $invalidita = null;
        }
        $percentInvalidita = $data->input('percentInvalidita');
        $accompagnamento = $data->input('accompagnamento');
        $indirizzo = $data->input('indirizzo');
        $comuneResidenza = $data->input('comuneResidenza');
        $tipoDocumento = $data->input('tipoDocumento');
        $dataRilascio = date('Y-m-d', strtotime(str_replace('/', '-', $data->input('dataRilascio'))));
        $comuneDiRilascio = $data->input('comuneDiRilascio');
        $dataScadenza = date('Y-m-d', strtotime(str_replace('/', '-', $data->input('dataScadenza'))));
        $titoloStudio = $data->input('titoloStudio');
        $tipoProfessione = $data->input('tipoProfessione');
        $telefono = $data->input('telefono');
        $cellulare = $data->input('cellulare');
        $email = $data->input('email');

        $newInvalidita = new Invaliditum();
        $newInvalidita->idInvalidita = $invalidita;
        if(is_null($percentInvalidita)){
            $percentInvalidita = "";
        }
        $newInvalidita->percentuale = $percentInvalidita;
        if($accompagnamento) {
            $newInvalidita->accompagnamento = true;
        } else {
            $newInvalidita->accompagnamento = false;
        }
        $newInvalidita->save();
        $idNewInvalidita = $newInvalidita->id;

        $newDocumentoIdentita = new DocumentoIdentitum();
        $newDocumentoIdentita->idTipoDocumento = $tipoDocumento;
        if(is_null($comuneDiRilascio)){
            $comuneDiRilascio = "";
        }
        $newDocumentoIdentita->rilasciatoDa = $comuneDiRilascio;

        $newDocumentoIdentita->dataRilascio = $dataRilascio;

        $newDocumentoIdentita->dataScadenza = $dataScadenza;
        $newDocumentoIdentita->save();
        $idNewDocumentoIdentita = $newDocumentoIdentita->id;

        $newAltreInfo = new AltreInfoCliente();
        $newAltreInfo->idTitoloStudio = $titoloStudio;
        $newAltreInfo->idProfessione = $tipoProfessione;
        if(is_null($telefono)){
            $telefono = "";
        }
        $newAltreInfo->telefono = $telefono;
        if(is_null($cellulare)){
            $cellulare = "";
        }
        $newAltreInfo->cellulare = $cellulare;
        if(is_null($email)){
            $email = "";
        }
        $newAltreInfo->email = $email;
        if(is_null($numTesseraEnotria)){
            $numTesseraEnotria = "";
        }
        $newAltreInfo->numTesseraEnotria = $numTesseraEnotria;
        if($socio) {
            $newAltreInfo->socio = true;
        } else {
            $newAltreInfo->socio = false;
        }
        if($delegaSindacale) {
            $newAltreInfo->delegaSindacale = true;
        } else {
            $newAltreInfo->delegaSindacale = false;
        }
        if($socioEnotriaCral) {
            $newAltreInfo->socioEnotriaCral = true;
        } else {
            $newAltreInfo->socioEnotriaCral = false;
        }
        $newAltreInfo->save();
        $idNewAltreInfo = $newAltreInfo->id;

        $newAnagraficheCliente = new AnagraficheClienti();
        $newAnagraficheCliente->idTipologiaCliente = $tipologiaCliente;
        if(is_null($cognome)){
            $cognome = "";
        }
        $newAnagraficheCliente->cognome = $cognome;
        if(is_null($nome)){
            $nome = "";
        }
        $newAnagraficheCliente->nome = $nome;
        $newAnagraficheCliente->sesso = $sesso;
        $newAnagraficheCliente->dataNascita = $dataNascita;
        if(is_null($comuneNascita)){
            $comuneNascita = "";
        }
        $newAnagraficheCliente->luogoNascita = $comuneNascita;
        if(is_null($codiceFiscale)){
            $codiceFiscale = "";
        }
        $newAnagraficheCliente->codiceFiscale = $codiceFiscale;
        if(is_null($partitaIva)){
            $partitaIva = "";
        }
        $newAnagraficheCliente->partitaIva = $partitaIva;
        if(is_null($pinInps)){
            $pinInps = "";
        }
        $newAnagraficheCliente->pinInps = $pinInps;
        if(is_null($indirizzo)){
            $indirizzo = "";
        }
        $newAnagraficheCliente->indirizzoResidenza = $indirizzo;
        if(is_null($comuneResidenza)){
            $comuneResidenza = "";
        }
        $newAnagraficheCliente->comuneResidenza = $comuneResidenza;
        $newAnagraficheCliente->save();
        $idNewAnagraficheCliente = $newAnagraficheCliente->id;

        $newCliente = new Clienti();
        $newCliente->idAnagrafica = $idNewAnagraficheCliente;
        $newCliente->idInvalidita = $idNewInvalidita;
        $newCliente->idDocumentoIdentita = $idNewDocumentoIdentita;
        $newCliente->idAltreInfo = $idNewAltreInfo;
        $newCliente->save();

        return redirect()->route('visualizzaInserisciCliente');
    }

    public function modificaCliente(Request $data){
        $idCliente = $data->input("idClienteDaModificare");

        $numTesseraEnotria = $data->input('numTesseraEnotria');
        $socio = $data->input('socio');
        $delegaSindacale = $data->input('delegaSindacale');
        $socioEnotriaCral = $data->input('socioEnotriaCral');
        $tipologiaCliente = $data->input('tipologiaCliente');
        $cognome = $data->input('cognome');
        $nome = $data->input('nome');
        $sesso = $data->input('sesso');
        $dataNascita = date('Y-m-d', strtotime(str_replace('/', '-', $data->input('dataNascita'))));
        $comuneNascita = $data->input('comuneNascita');
        $codiceFiscale = $data->input('codiceFiscale');
        $partitaIva = $data->input('partitaIva');
        $pinInps = $data->input('pinInps');
        $invalidita = $data->input('invalidita');
        if($invalidita == 0){
            $invalidita = null;
        }
        $percentInvalidita = $data->input('percentInvalidita');
        $accompagnamento = $data->input('accompagnamento');
        $indirizzo = $data->input('indirizzo');
        $comuneResidenza = $data->input('comuneResidenza');
        $tipoDocumento = $data->input('tipoDocumento');
        $dataRilascio = date('Y-m-d', strtotime(str_replace('/', '-', $data->input('dataRilascio'))));
        $comuneDiRilascio = $data->input('comuneDiRilascio');
        $dataScadenza = date('Y-m-d', strtotime(str_replace('/', '-', $data->input('dataScadenza'))));
        $titoloStudio = $data->input('titoloStudio');
        $tipoProfessione = $data->input('tipoProfessione');
        $telefono = $data->input('telefono');
        $cellulare = $data->input('cellulare');
        $email = $data->input('email');

        $cliente = Clienti::find($idCliente);

        $newInvalidita = Invaliditum::find($cliente->idInvalidita);
        $newInvalidita->idInvalidita = $invalidita;
        if(is_null($percentInvalidita)){
            $percentInvalidita = "";
        }
        $newInvalidita->percentuale = $percentInvalidita;
        if($accompagnamento) {
            $newInvalidita->accompagnamento = true;
        } else {
            $newInvalidita->accompagnamento = false;
        }
        $newInvalidita->save();

        $newDocumentoIdentita = DocumentoIdentitum::find($cliente->idDocumentoIdentita);
        $newDocumentoIdentita->idTipoDocumento = $tipoDocumento;
        if(is_null($comuneDiRilascio)){
            $comuneDiRilascio = "";
        }
        $newDocumentoIdentita->rilasciatoDa = $comuneDiRilascio;

        $newDocumentoIdentita->dataRilascio = $dataRilascio;

        $newDocumentoIdentita->dataScadenza = $dataScadenza;
        $newDocumentoIdentita->save();


        $newAltreInfo = AltreInfoCliente::find($cliente->idAltreInfo);
        $newAltreInfo->idTitoloStudio = $titoloStudio;
        $newAltreInfo->idProfessione = $tipoProfessione;
        if(is_null($telefono)){
            $telefono = "";
        }
        $newAltreInfo->telefono = $telefono;
        if(is_null($cellulare)){
            $cellulare = "";
        }
        $newAltreInfo->cellulare = $cellulare;
        if(is_null($email)){
            $email = "";
        }
        $newAltreInfo->email = $email;
        if(is_null($numTesseraEnotria)){
            $numTesseraEnotria = "";
        }
        $newAltreInfo->numTesseraEnotria = $numTesseraEnotria;
        if($socio) {
            $newAltreInfo->socio = true;
        } else {
            $newAltreInfo->socio = false;
        }
        if($delegaSindacale) {
            $newAltreInfo->delegaSindacale = true;
        } else {
            $newAltreInfo->delegaSindacale = false;
        }
        if($socioEnotriaCral) {
            $newAltreInfo->socioEnotriaCral = true;
        } else {
            $newAltreInfo->socioEnotriaCral = false;
        }
        $newAltreInfo->save();


        $newAnagraficheCliente = AnagraficheClienti::find($cliente->idAnagrafica);
        $newAnagraficheCliente->idTipologiaCliente = $tipologiaCliente;
        if(is_null($cognome)){
            $cognome = "";
        }
        $newAnagraficheCliente->cognome = $cognome;
        if(is_null($nome)){
            $nome = "";
        }
        $newAnagraficheCliente->nome = $nome;
        $newAnagraficheCliente->sesso = $sesso;
        $newAnagraficheCliente->dataNascita = $dataNascita;
        if(is_null($comuneNascita)){
            $comuneNascita = "";
        }
        $newAnagraficheCliente->luogoNascita = $comuneNascita;
        if(is_null($codiceFiscale)){
            $codiceFiscale = "";
        }
        $newAnagraficheCliente->codiceFiscale = $codiceFiscale;
        if(is_null($partitaIva)){
            $partitaIva = "";
        }
        $newAnagraficheCliente->partitaIva = $partitaIva;
        if(is_null($pinInps)){
            $pinInps = "";
        }
        $newAnagraficheCliente->pinInps = $pinInps;
        if(is_null($indirizzo)){
            $indirizzo = "";
        }
        $newAnagraficheCliente->indirizzoResidenza = $indirizzo;
        if(is_null($comuneResidenza)){
            $comuneResidenza = "";
        }
        $newAnagraficheCliente->comuneResidenza = $comuneResidenza;
        $newAnagraficheCliente->save();

        return redirect()->route('visualizzaModificaCliente',["idCliente"=>$idCliente]);
    }
}
