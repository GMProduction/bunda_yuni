<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skripsi || Admin</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/appstyle/genosstyle.1.0.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet"
        href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> --}}

    {{-- ICON --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vitalets-bootstrap-datepicker/css/datepicker.css') }}" />

</head>

<body>

    <div class="header">
        <div class="header-panel-kiri">
            <a class="btn-icon " onclick="openNav()">
                <span class="material-icons">menu
                </span>
            </a>

            <p class="title">
                Katering Mbak Endang
            </p>
        </div>

        <p class="text-title text-center">
            Beranda
        </p>

        <div class="header-panel-kanan">
            <a class="profil dropdown-toggle" href="#" role="button" id="dropdownprofile"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/local/nobody.png') }}" />
            </a>

            <ul class="dropdown-menu custom" aria-labelledby="dropdownprofile">
                <li><a class="dropdown-item disabled" href="#">{{ auth()->user()->nama }}</a></li>
                <hr>
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>

        </div>

    </div>

    <div class="d-flex">

        {{-- <div class="sidebar"> --}}
        <nav id="sidebar" class="sidebar card py-2">
            <ul class="nav flex-column" id="nav_accordion">

                <li class="nav-item">
                    <a class="title-role" href="#"> Admin </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="title-role" href="#"> Admin </a>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link menu" href="#">
                        <i class="material-icons menu-icon">perm_identity</i>
                        <p class="menu-text">Admin</p>
                    </a>
                    <ul class="submenu  collapse">
                        <li><a class="nav-link menu" href="#"><i class="material-icons menu-icon">perm_identity</i>
                                <p class="menu-text">Submenu item 4</p>
                            </a></li>
                        <li><a class="nav-link menu" href="#">
                                <i class="material-icons menu-icon">perm_identity</i>
                                <p class="menu-text">Submenu item 4</p>
                            </a></li>
                        <li><a class="nav-link menu" href="#">
                                <i class="material-icons menu-icon">perm_identity</i>
                                <p class="menu-text">Submenu item 4</p>
                            </a> </li>
                    </ul>
                </li> --}}


                {{-- <li class="nav-item">
                    <a class="nav-link menu @if ($sidebar == 'beranda') active @endif " href="/admin">
                        <i class="material-icons menu-icon">home</i>
                        <p class="menu-text">Beranda</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu @if ($sidebar == 'user') active @endif" href="/admin">
                        <i class="material-icons menu-icon">person</i>
                        <p class="menu-text">User</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu @if ($sidebar == 'barang') active @endif" href="/admin/barang">
                        <i class="material-icons menu-icon">list_alt</i>
                        <p class="menu-text">Data Menu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu @if ($sidebar == 'transaksi') active @endif" href="/admin/transaksi">
                        <i class="material-icons menu-icon">assignment</i>
                        <p class="menu-text">Transaksi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu @if ($sidebar == 'laporan') active @endif" href="/admin/laporan">
                        <i class="material-icons menu-icon">analytics</i>
                        <p class="menu-text">Laporan</p>
                    </a>
                </li>


            </ul>
        </nav>



        <div class="w-100 p-4">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="{{ asset('js/base.js') }}"></script>
    <script src="{{ asset('js/swal.js') }}"></script>
    <script src="{{ asset('js/dialog.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('datatable/select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vitalets-bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    @yield('morejs')

</body>

</html>
