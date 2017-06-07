@php
    if(Auth::check()){
        if(Auth::user()->idRuolo==1){
            $connessoComeSupervisor = true;
        } else {
            $connessoComeSupervisor = false;
        }
    }
@endphp
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!--  Material Dashboard CSS    -->
    <link href="{{URL::asset('assets/css/material-dashboard.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>

    @yield('styleCSS')
</head>

<body>

<div class="wrapper">

    <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
        <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->

        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                La galleria dei servizi
            </a>
        </div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li @yield('activeDashboardSidebar')>
                    <a href="/dashboard">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if($connessoComeSupervisor)
                <li @yield('activeGestioneUtentiSidebar')>
                    <a href="/gestione_utenti">
                        <i class="material-icons">person</i>
                        <p>Gestione utenti</p>
                    </a>
                </li>
                @endif
                @if($connessoComeSupervisor)
                    <li @yield('activeGestioneTendineSidebar')>
                        <a href="/gestione_tendine">
                            <i class="material-icons">person</i>
                            <p>Gestione tendine</p>
                        </a>
                    </li>
                @endif
                <li @yield('activeInserisciClientiSidebar')>
                    <a href="/clienti/create">
                        <i class="material-icons">person</i>
                        <p>Inserisci clienti</p>
                    </a>
                </li>
                <li @yield('activeListaClientiSidebar')>
                    <a href="/clienti">
                        <i class="material-icons">person</i>
                        <p>Lista clienti</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">@yield('titleSection')</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">dashboard</i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="hidden-lg hidden-md">Notifications</p>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Mike John responded to your email</a></li>
                                <li><a href="#">You have 5 new tasks</a></li>
                                <li><a href="#">You're now friend with Andrew</a></li>
                                <li><a href="#">Another Notification</a></li>
                                <li><a href="#">Another One</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">person</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group  is-empty">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i><div class="ripple-container"></div>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="content">
            @yield('content')
        </div>

        <footer class="footer">

        </footer>
    </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="{{URL::asset('assets/js/jquery-3.1.0.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/js/material.min.js')}}" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="{{URL::asset('assets/js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{URL::asset('assets/js/bootstrap-notify.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Material Dashboard javascript methods -->
<script src="{{URL::asset('assets/js/material-dashboard.js')}}"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{URL::asset('assets/js/demo.js')}}"></script>

@yield('functionJavascript')

</html>