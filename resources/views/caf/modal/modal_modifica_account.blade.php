<!-- Modal Aggiungi Gruppo Servizio -->
<div id="modalModificaAccount" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formModificaAccount" method="post" action="">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modifica account</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="">
                    <div class="form-group label-floating">
                        <label class="control-label">Nome</label>
                        <input type="text" id="modalModificaAccountNome" value="prova" name="nome" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Cognome</label>
                        <input type="text" id="modalModificaAccountCognome" value="prova" name="cognome" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Username</label>
                        <input type="text" id="modalModificaAccountUsername" value="prova" name="username" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Password</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Conferma Password</label>
                        <input type="text" name="password_confirmation" class="form-control">
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" id="modalRadioRoleOperatore" name="role" value="2">
                            Operatore
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" id="modalRadioRoleSupervisore" name="role" value="1">
                            Supervisore
                        </label>
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
    function setModalEditUser(urlOperazione, nome, cognome, username, ruolo){
        $('.modal-body #modalModificaAccountNome').val(nome);
        $('.modal-body #modalModificaAccountCognome').val(cognome);
        $('.modal-body #modalModificaAccountUsername').val(username);
        $('#formModificaAccount').attr('action', urlOperazione);

        if(ruolo == 1){
            $(".modal-body #modalRadioRoleOperatore").attr('checked', false);
            $(".modal-body #modalRadioRoleSupervisore").attr('checked', true);
        } else if (ruolo == 2){
            $(".modal-body #modalRadioRoleSupervisore").attr('checked', false);
            $(".modal-body #modalRadioRoleOperatore").attr('checked', true);
        }
    }
</script>