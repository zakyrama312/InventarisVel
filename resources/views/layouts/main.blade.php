<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ventera</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/')}}assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/styles.min.css" />
    <link rel="stylesheet" href="{{ asset('/')}}assets/css/mystyle.css" />
    <link rel="stylesheet" href="{{ asset('/')}}assets/datatables/datatables.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/datatables/Buttons-2.4.2/css/buttons.bootstrap.min.css">
    <!-- atau -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/datatables/Buttons-2.4.2/css/buttons.bootstrap4.min.css">
    <!-- Tambahkan CSS Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/select2/select2.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"> --}}



</head>
<style>
    /* CSS untuk mengatur posisi ikon panah */
    .sidebar-link .toggle-arrow {
        float: right;
        transition: transform 0.3s ease;
    }

    /* CSS untuk mengubah arah panah saat dropdown dibuka */
    .sidebar-link[aria-expanded="true"] .toggle-arrow {
        transform: rotate(180deg);
    }

    .dataTables_length {
        margin-left: -30px;
        margin-top: 15px;
    }

    .dt-buttons {
        /* margin-left: 15px; */
    }

    .dataTables_filter {
        color: black;
    }

    .select2-container {
        z-index: 9999 !important;
        /* Atur z-index lebih tinggi dari modal */
    }

    .select2-container .select2-results__option {
        color: #000;
        /* Warna teks di dropdown menjadi hitam */
    }

    .table-responsive {
        overflow: auto;
        /* Masih memungkinkan scroll */
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* Internet Explorer 10+ */
    }

    .table-responsive::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }

    #sidebar {
        transition: all 0.3s;
    }

    #content {
        transition: all 0.3s;
    }

    /* Saat collapse */
    .sidebar-collapsed #sidebar {
        margin-left: -280px;
        /* sidebar geser */
    }

    .sidebar-collapsed #content {
        margin-left: 0;

    }
</style>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')


            <!--  Header End -->

            <div class="container">

                <!--  Row 1 -->
                <div class="row" id="content">
                    <div class="col-lg-12 d-flex align-items-strech" style="margin-top: 100px;">
                        <div class="card card-content w-100">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @yield('dashboard')
            </div>

        </div>
    </div>
    @include('layouts.footer')