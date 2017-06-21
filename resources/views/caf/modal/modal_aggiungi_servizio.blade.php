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

                <div class="form-group label-floating">
                    <label class="control-label">Nome</label>
                    <input type="text" name="nome" class="form-control">
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
                    <div class="form-group label-floating">
                        <label class="control-label">Nome</label>
                        <input type="text" name="nome" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Descrizione</label>
                        <input type="text" name="descrizione" class="form-control">
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