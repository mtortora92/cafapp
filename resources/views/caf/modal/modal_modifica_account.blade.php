<!-- Modal Aggiungi Gruppo Servizio -->
<div id="modalModificaAccount" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formModificaAccount" method="post" action="">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modifica password</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="">
                    <div class="form-group label-floating">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" id="password_update" class="form-control">
                        @if ($errors->errorsInsertUser->has('password'))
                            <span>
                                <strong>{{ $errors->errorsInsertUser->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Conferma Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
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
    $(document).ready(function() {
        $("#formModificaAccount").validate({
            rules: {
                'password': {
                    required: true,
                    minlength: 6,
                },
                'password_confirmation': {
                    equalTo: "#password_update",
                }
            },
            messages: {
                'password': {
                    required: "La password deve avere almeno 6 caratteri",
                    minlength: "La password deve avere almeno 6 caratteri"
                },
                'password_confirmation': {
                    equalTo: "Le password non corrispondono"
                }
            }
        });
    });

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