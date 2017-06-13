@extends('caf.layout')

@section('title', 'Dashboard')

@section('titleSection', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                @if(Auth::user()->isSupervisor() || Auth::user()->isSuperAdmin())
                <div onclick="location.href='{{url('/account')}}'" style="cursor:pointer" class="card card-stats">
                @else
                <div onclick="window.alert('Solo gli utenti supervisori possono accedere alla sezione')" class="card card-stats">
                @endif
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">content_paste</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Solo utenti supervisori</p>
                        <h3 class="title">Amministrazione</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            Gestisci account e menù a tendina delle anagrafiche
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div onclick="location.href='{{url('/clienti')}}'" style="cursor:pointer" class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="card-content">
                        <p class="category">&nbsp;</p>
                        <h3 class="title">Gestisci clienti</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            Visualizza clienti inseriti e gestisci quelli esistenti
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('activeDashboardSidebar')
    class="active"
@endsection