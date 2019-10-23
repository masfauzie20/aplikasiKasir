<!doctype html>
<html lang="en">

<head>
    @php 
        $sesi = Auth::user(); 
    @endphp
    
    <title>aplikasiKasir</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
    <link rel="stylesheet" href="assets/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">

    <!-- MAIN CSS -->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/png" sizes="96x96" href="{{asset('assets/img/icon.jpg')}}">
    <script src=https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js></script>
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

</head>

<body>
    @include('sweet::alert')
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="{{ route('dashboard') }}"><img src="{{asset('assets/img/logo-word.jpg')}}" style="margin-bottom: -16px; width: 50%; margin-top:-7px;" alt="TimeLate Logo" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth" style="margin-left:-100px;"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <div class="navbar-btn navbar-btn-right">
                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('assets/img/default-user.png')}}" class="img-circle" alt="Avatar">
                                <span> Hi , {{ $sesi['username'] }} !</span>
                                <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('logout') }}"><i class="lnr lnr-power-switch"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Home</span></a></li>
                        <li><a href="{{ route('petugas') }}" class="{{ Request::is('petugas') ? 'active' : '' }}"><i class="lnr lnr-users"></i> <span>Petugas</span></a></li>
                        <li><a href="{{ route('barang') }}" class="{{ Request::is('barang') ? 'active' : '' }}"><i class="lnr lnr-inbox"></i> <span>Barang</span></a></li>
                        <li><a href="{{ route('transactions') }}" class="{{ Request::is('transactions') ? 'active' : '' }}"><i class="lnr lnr-list"></i> <span>Transaksi</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            @yield('content')
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid" style="position:">
                <p class="copyright">&copy; 2019 aplikasiKasir. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/scripts/klorofil-common.js')}}"></script>
    <script src="{{asset('assets/scripts/datatables.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    {{-- Custom Javascript --}}
    @stack('js')
</body>

</html>