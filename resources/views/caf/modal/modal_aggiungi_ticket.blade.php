<!-- Modal chiudi ticket -->
<div id="modalChiudiTicket" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  enctype="multipart/form-data" id="" method="post" action="{{url('chiudi_ticket')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chiudi ticket</h4>
                </div>
                <div class="modal-body">
                    Stai per chiudere la lavorazione di questo ticket. Se non hai un documento da allegare clicca su SALVA, altrimenti clicca su ALLEGA
                    <input type="hidden" name="id_ticket_in_modal_chiudi_ticket" id="id_ticket_in_modal_chiudi_ticket" value="">
                    <input type="hidden" name="clienti_id" value="{{$cliente->id}}">
                    <input name="documento_allegato_chiusura_ticket" onchange="this.form.submit()" style="display:none" type="file" id="allegaDocumentoChiusuraTicket">
                    <br>
                    <button onclick="$('#allegaDocumentoChiusuraTicket').click();" type="button" class="btn btn-primary">
                        Allega
                    </button>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Salva"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Apri Tiket -->
<div id="modalApriTicket" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAperturaTicket" method="post" action="{{url('ticket')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Apertura Tiket</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="clienti_id" value="{{$cliente->id}}">

                    <div class="form-group label-floating">
                        <label class="control-label">Gruppo Servizio</label>
                        <select onchange="popolaSelectServizi()" id="gruppoServizioTicket" name="gruppoServizioTicket" class="form-control">
                            @foreach($gruppoServizi as $gruppo)
                                <option value="{{$gruppo->id}}">{{$gruppo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Servizio</label>
                        <select id="serviziTicket" name="servizi_id" data-placeholder="Servizio" class="form-control">
                            @foreach($servizi as $servizio)
                                <option value="{{$servizio->id}}">{{$servizio->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Importo (&euro;)</label>
                        <input type="text" value="{{$servizio->prezzo}}" name="importo" class="form-control" >
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Note</label>
                        <textarea id="noteTicket" name="note" class="form-control"></textarea>
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
    function popolaSelectServizi(){
        var idGruppoServizio = $('#gruppoServizioTicket').val();

        $.get('/ticket_select_servizi/'+idGruppoServizio, function(data){
            $(".modal-body #serviziTicket").html(data.listaOptionServizi);
        });
    }
</script>