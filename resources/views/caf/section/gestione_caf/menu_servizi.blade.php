<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Inserisci nuovo servizio</h4>
                <p class="category">Tutti i campi sono obbligatori</p>
            </div>
            <div class="card-content">
                <form id="formInserimentoServizio" role="form" method="POST" action="{{ url('') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Gruppo Servizio</label>
                                <select class="form-control" data-placeholder="Gruppo servizio" name="gruppi_servizi_id">
                                    @foreach($gruppoServizi as $gruppo)
                                        <option value="{{$gruppo->id}}">{{$gruppo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Nome</label>
                                <input type="text" class="form-control" data-placeholder="Nome" name="nome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Descrizione</label>
                                <input type="text" class="form-control" data-placeholder="Descrizione" name="descrizione">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Prezzo</label>
                                <input type="text" class="form-control" data-placeholder="Prezzo" name="prezzo">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round">Inserisci servizio</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Gruppi servizi</h4>
                    <p class="category"></p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>Nome</th>
                        <th><i data-toggle="modal" data-target="#modalAggiungiGruppoServizio" role="button" class="material-icons">control_point</i></th>
                        </thead>
                        <tbody>
                        @foreach($gruppoServizi as $gruppo)
                            @php($id = $gruppo->id)
                            <tr>
                                <td>{{$gruppo->nome}}</td>
                                <td>
                                    <form method="post" action="" id="formEliminaGruppo{{$id}}">
                                        {{csrf_field()}}
                                        <button onclick="window.alert('Funzione ancora non disponibile')//$('#formEliminaGruppo{{$id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Documenti</h4>
                    <p class="category"></p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>Nome</th>
                        <th><i data-toggle="modal" data-target="#modalAggiungiDocumento" role="button" class="material-icons">control_point</i></th>
                        </thead>
                        <tbody>
                        @foreach($documentiServizi as $doc)
                            @php($id = $doc->id)
                            <tr>
                                <td>{{$doc->nome}}</td>
                                <td>
                                    <form method="post" action="" id="formEliminaDocumentoServizio{{$id}}">
                                        {{csrf_field()}}
                                        <button onclick="window.alert('Funzione ancora non disponibile')//$('#formEliminaDocumentoServizio{{$id}}').submit()" type="button" rel="tooltip" title="Elimina" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>