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
                        <label class="control-label">Sconto</label>
                        <input type="text" value="0" name="sconto" class="form-control" >
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