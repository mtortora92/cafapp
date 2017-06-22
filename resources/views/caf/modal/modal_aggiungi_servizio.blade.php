<!-- Modal Aggiungi Gruppo Servizio -->
<div id="modalAggiungiGruppoServizio" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formInserisciGruppoServizio" method="post" action="{{url('/inserisci_gruppo_servizi')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Inserisci Gruppo Servizio</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_gruppo_servizio_modal" name="id_gruppo_servizio_modal">
                <div class="form-group label-floating">
                    <label class="control-label">Nome</label>
                    <input type="text" id="nome_gruppo_servizio_modal" name="nome" class="form-control">
                </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Salva"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setModalAddServizio(urlOperazione, nome, idGruppoServizio){
        $('.modal-body #id_gruppo_servizio_modal').val(idGruppoServizio);
        $('.modal-body #nome_gruppo_servizio_modal').val(nome);
        $('#formInserisciGruppoServizio').attr('action', urlOperazione);
    }
</script>

<!-- Modal Aggiungi Documento -->
<div id="modalAggiungiDocumento" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formInserisciServizio" method="post" action="{{url('/inserisci_documento_servizi')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Inserisci Documento Servizi</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_documento_modal" name="id_documento_modal">
                    <div class="form-group label-floating">
                        <label class="control-label">Nome</label>
                        <input type="text" id="nome_documento_modal" name="nome" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Descrizione</label>
                        <input type="text" id="descrizione_documento_modal" name="descrizione" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Salva"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setModalAddDocumento(urlOperazione, nome, descrizione, idDocumento){
        window.alert(descrizione);
        $('.modal-body #id_documento_modal').val(idDocumento);
        $('.modal-body #descrizione_documento_modal').val(descrizione);
        $('.modal-body #nome_documento_modal').val(nome);
        $('#formInserisciServizio').attr('action', urlOperazione);
    }

    $(document).ready(function(){
        var regoleValidate = {
            rules: {
                'nome': {
                    required:true,
                },
                'descrizione':{
                    required: true,
                },
            },
            messages: {
                'nome':{
                    required: "Nome obbligatorio",
                },
                'descrizione':{
                    required: "Descrizione obbligatoria",
                },
            }
        };

        $("#formInserisciGruppoServizio").validate(regoleValidate);
        $("#formInserisciServizio").validate(regoleValidate);
    });
</script>