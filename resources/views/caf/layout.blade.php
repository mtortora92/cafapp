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
    <link href="{{URL::asset('assets/css/demo.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>

    <!-- DataTables CSS -->
    <link href="{{URL::asset('assets/dataTables/dataTables.css')}}" rel="stylesheet"/>
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
            <a href="" class="simple-text">
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
                @if(Auth::user()->isSupervisor())
                <li @yield('activeGestioneUtentiSidebar')>
                    <a href="/account">
                        <i class="material-icons">content_paste</i>
                        <p>Amministrazione</p>
                    </a>
                </li>
                @endif
                <li @yield('activeListaClientiSidebar')>
                    <a href="/clienti">
                        <i class="material-icons text-gray">person</i>
                        <p>Clienti</p>
                    </a>
                </li>
                @if(Auth::user()->isSuperAdmin())
                <li class="active-pro">
                    <a href="/caf">
                        <i class="material-icons">unarchive</i>
                        <p>Gestione Caf</p>
                    </a>
                </li>
                @endif
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
<script src="{{URL::asset('assets/dataTables/dataTables.js')}}" type="text/javascript"></script>

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

@yield('modal')
@yield('functionJavascript')

@if(session()->has('alert_success'))
    <script type="text/javascript">
        $(document).ready(function() {
            $.notify({
                icon: "notifications",
                message: "{{session('alert_success')}}"

            },{
                type: type[2],
                timer: 4000,
                placement: {
                    from: "top",
                    align: "right"
                }
            });
        });
    </script>
@elseif(session()->has('alert_error'))
    <script type="text/javascript">
        $(document).ready(function() {
            $.notify({
                icon: "notifications",
                message: "{{session('alert_error')}}"

            },{
                type: type[4],
                timer: 4000,
                placement: {
                    from: "top",
                    align: "right"
                }
            });
        });
    </script>
@endif
</html>