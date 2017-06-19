<!-- Modal Aggiungi Voce Diario -->
<div id="modalAggiungiVoceDiario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formInserimentoEvento" method="post" action="{{url('/diario')}}" onsubmit="controllaInserisciEvento()">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Inserisci Evento</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group label-floating">
                        <label class="control-label">Descrizione</label>
                        <textarea id="descrizioneInserisciEvento" name="descrizione" class="form-control"></textarea>
                    </div>
                    <input type="hidden" class="form-control" name="clienti_id" value="{{$clienteId}}"/>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Salva"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                </div>
            </form>
        </div>
    </div>
</div>