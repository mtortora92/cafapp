<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Inserisci caf</h4>
                <p class="category">Tutti i campi sono obbligatori</p>
            </div>
            <div class="card-content">
                <form id="formInserimentoCaf" role="form" method="POST" action="{{ url('/caf') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group label-floating">
                                <label class="control-label">Nome Caf</label>
                                <input type="text" name="nome" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Inserire un utente amministratore per il caf selezionato</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Nome</label>
                                <input type="text" name="utente[nome]" class="form-control" >
                                @if ($errors->has("nome"))
                                    <span>
                                                <strong>{{ $errors->first("nome") }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Cognome</label>
                                <input type="text" name="utente[cognome]" class="form-control" >

                                @if ($errors->has("cognome"))
                                    <span>
                                                <strong>{{ $errors->first("cognome") }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Username</label>
                                <input type="text" name="utente[username]" class="form-control" >

                                @if ($errors->has("username"))
                                    <span>
                                                <strong>{{ $errors->first("username") }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Password</label>
                                <input type="password" name="passwordUtente" class="form-control" >

                                @if ($errors->has("password"))
                                    <span>
                                                <strong>{{ $errors->first("password") }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Conferma Password</label>
                                <input type="password" name="passwordUtente_confirmation" class="form-control" >
                            </div>
                            <!-- Hidden per specificare che ruolo è Supervisore -->
                            <input type="hidden" name="utente[role]" value="1">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-round">Inserisci caf</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Lista Uffici Caf</h4>
                <p class="category"></p>
            </div>
            <div class="card-content table-responsive">
                <table class="table table-hover">
                    <thead>
                    <th>id</th>
                    <th>Nome</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($caf as $caf)
                        @php($id = $caf->id)
                        <tr>
                            <td>{{$caf->id}}</td>
                            <td>{{$caf->nome}}</td>
                            <td>
                                <form method="post" action="" id="formEliminaCaf{{$id}}">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <button onclick="window.alert('Funzione ancora non disponibile')//$('#formEliminaCaf{{$id}}').submit()" type="button" rel="tooltip" title="Elimina Caf" class="btn btn-danger btn-simple btn-xs">
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