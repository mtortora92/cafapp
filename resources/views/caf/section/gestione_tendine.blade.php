@php
    $tipiInvalidita = \cafapp\Models\TipoInvaliditum::all();
    $tipiDocumenti = \cafapp\Models\TipiDocumentiIdentitum::all();
    $tipiProfessione = \cafapp\Models\TipoProfessione::all();
    $titoliStudio = \cafapp\Models\TitoloStudio::all();
@endphp

@extends('caf.layout')

@section('title', 'Gestione tendine')

@section('titleSection', 'Gestione tendine')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tipi invalidità</h4>
                        <p class="category">Gestisci tipi di invalidità</p>
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
                            <tr>
                                <td>{{$item->invalidita}}</td>
                                <td class="td-actions text-right">
                                    <a href="{{url("/rimuovi_tipo_invalidita/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tipi documenti di identità</h4>
                        <p class="category">Gestisci tipologie documenti di identità</p>
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
                                <tr>
                                    <td>{{$item->descrizione}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{url("/rimuovi_tipo_documento/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Titoli di studio</h4>
                        <p class="category">Gestisci titoli di studio</p>
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
                            <th>Tipi titoli di studio inseriti</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($titoliStudio as $item)
                                <tr>
                                    <td>{{$item->titolo}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{url("/rimuovi_titolo_studio/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tipi di professione</h4>
                        <p class="category">Gestisci tipi di professione</p>
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
                            <th>Tipi professione inseriti</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($tipiProfessione as $item)
                                <tr>
                                    <td>{{$item->professione}}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{url("/rimuovi_tipo_professione/$item->id")}}" type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="material-icons">close</i>
                                        </a>
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
@endsection


@section('activeGestioneTendineSidebar')
    class="active"
@endsection