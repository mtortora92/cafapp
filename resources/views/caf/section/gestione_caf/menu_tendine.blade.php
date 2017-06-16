<div class="row">
    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h5 class="title">Tipi invalidità</h5>
            </div>
            <div class="card-content table-responsive">
                <form method="post" action="{{ url('/inserisci_tipo_invalidita') }}">
                    {{ csrf_field() }}
                    <div class="form-group label-floating">
                        <label class="control-label">Descrizione</label>
                        <input type="text" name="descrizione" class="form-control" >
                        <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                        <div class="clearfix"></div>
                    </div>
                </form>

                <table class="table">
                    <thead class="text-primary">
                    <th>Tipi invalidità inserite</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($tipiInvalidita as $item)
                        @if($item->id != 1)
                            <tr>
                                <td>{{$item->invalidita}}</td>
                                <td class="td-actions text-right">
                                    <a href="{{url("/rimuovi_tipo_invalidita/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h5 class="title">Documenti d'identità</h5>
            </div>
            <div class="card-content table-responsive">
                <form method="post" action="{{ url('/inserisci_tipo_documento') }}">
                    {{ csrf_field() }}
                    <div class="form-group label-floating">
                        <label class="control-label">Descrizione</label>
                        <input type="text" name="descrizione" class="form-control" >
                        <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                        <div class="clearfix"></div>
                    </div>
                </form>

                <table class="table">
                    <thead class="text-primary">
                    <th>Tipi documenti inseriti</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($tipiDocumenti as $item)
                        @if($item->id != 1)
                            <tr>
                                <td>{{$item->descrizione}}</td>
                                <td class="td-actions text-right">
                                    <a href="{{url("/rimuovi_tipo_documento/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h5 class="title">Titoli di studio</h5>
            </div>
            <div class="card-content table-responsive">
                <form method="post" action="{{ url('/inserisci_titolo_studio') }}">
                    {{ csrf_field() }}
                    <div class="form-group label-floating">
                        <label class="control-label">Descrizione</label>
                        <input type="text" name="descrizione" class="form-control" >
                        <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                        <div class="clearfix"></div>
                    </div>
                </form>

                <table class="table">
                    <thead class="text-primary">
                    <th>Titoli di studio inseriti</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($titoliStudio as $item)
                        @if($item->id != 1)
                            <tr>
                                <td>{{$item->titolo}}</td>
                                <td class="td-actions text-right">
                                    <a href="{{url("/rimuovi_titolo_studio/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h5 class="title">Professioni</h5>
            </div>
            <div class="card-content table-responsive">
                <form method="post" action="{{ url('/inserisci_tipo_professione') }}">
                    {{ csrf_field() }}
                    <div class="form-group label-floating">
                        <label class="control-label">Descrizione</label>
                        <input type="text" name="descrizione" class="form-control" >
                        <button type="submit" class="btn btn-primary btn-sm btn-round">Inserisci campo</button>
                        <div class="clearfix"></div>
                    </div>
                </form>

                <table class="table">
                    <thead class="text-primary">
                    <th>Professioni inserite</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($tipiProfessione as $item)
                        @if($item->id != 1)
                            <tr>
                                <td>{{$item->professione}}</td>
                                <td class="td-actions text-right">
                                    <a href="{{url("/rimuovi_tipo_professione/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>