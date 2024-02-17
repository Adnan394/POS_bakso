<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Admin Bakso Liktono</title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/styletambahan.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="/admin>
                            <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                {{-- <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" /> --}}
                                <!-- Light Logo text -->
                                {{-- <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" /> --}}
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/profile-pic.jpg') }}" alt="user"
                                    class="rounded-circle" width="40">
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark">{{ Auth::user()->name }}</span> <i
                                        data-feather="chevron-down" class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Keluar</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->

            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                @if (Auth::user()->role_id == 1)
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link active" href="/superadmin"
                                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                        class="hide-menu">Dashboard</span></a></li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Data Master</span></li>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow in active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Master Setting</span></a>
                                <ul aria-expanded="false" class="collapse active first-level base-level-line in">
                                    <li class="sidebar-item">
                                        <a href="{{ route('bahan_setengah_jadi.index') }}" class="sidebar-link">
                                            <span class="hide-menu">Bahan Setengah Jadi</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('products.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Produk
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('outlets.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Outlet
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('payments.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Payment Method
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('tables.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Data Meja
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('accounts.index') }}" aria-expanded="false"><i
                                        data-feather="user" class="feather-icon"></i><span class="hide-menu">User
                                        Setting</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('locations.index') }}" aria-expanded="false"><i
                                        data-feather="map-pin" class="feather-icon"></i><span
                                        class="hide-menu">Location Setting</span></a></li>

                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Data Transaksi</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('pengeluaran_admin.index') }}" aria-expanded="false"><i
                                        data-feather="shopping-cart" class="feather-icon"></i><span
                                        class="hide-menu">Pengeluaran
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('rekap_admin') }}" aria-expanded="false"><i
                                        data-feather="dollar-sign" class="feather-icon"></i><span
                                        class="hide-menu">Rekap
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('jurnal_admin.index') }}" aria-expanded="false"><i
                                        data-feather="dollar-sign" class="feather-icon"></i><span
                                        class="hide-menu">Jurnal
                                    </span></a>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Report</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                    aria-expanded="false"><i data-feather="printer" class="feather-icon"></i><span
                                        class="hide-menu">Laporan Pemasukan
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('logout') }}" aria-expanded="false"><i data-feather="log-out"
                                        class="feather-icon"></i><span class="hide-menu">Keluar</span></a></li>
                        </ul>
                    </nav>
                @elseif (Auth::user()->role_id == 2)
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link active" href="/admin"
                                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                        class="hide-menu">Dashboard</span></a></li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Data Master</span></li>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow in active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Master Setting</span></a>
                                <ul aria-expanded="false" class="collapse active first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('products.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Produk
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('outlets.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Outlet
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('payments.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Payment Method
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('tables.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Data Meja
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Data Transaksi</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                    aria-expanded="false"><i data-feather="shopping-cart"
                                        class="feather-icon"></i><span class="hide-menu">Pengeluaran
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                    aria-expanded="false"><i data-feather="dollar-sign"
                                        class="feather-icon"></i><span class="hide-menu">Penjualan
                                    </span></a>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Report</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                    aria-expanded="false"><i data-feather="printer" class="feather-icon"></i><span
                                        class="hide-menu">Laporan Pemasukan
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('logout') }}" aria-expanded="false"><i data-feather="log-out"
                                        class="feather-icon"></i><span class="hide-menu">Keluar</span></a></li>
                        </ul>
                    </nav>
                @elseif (Auth::user()->role_id == 3)
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link active" href="/kasir"
                                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                        class="hide-menu">Dashboard</span></a></li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Pemesanan</span></li>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Transaksi </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('create_transaksi') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Baru
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('transaksi.kasir_berjalan') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Berjalan
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('transaksi.kasir_selesai') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Selesai
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('kasir_konfirmasi') }}"
                                            class="sidebar-link"><span class="hide-menu"> Konfirmasi Transaksi
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Antrian Dapur </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('kasir_pesanan_diproses') }}"
                                            class="sidebar-link"><span class="hide-menu"> Antrian Pesanan
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('kasir_pesanan_selesai') }}"
                                            class="sidebar-link"><span class="hide-menu"> Antrian Selesai
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Laporan
                                        Rekapitulasi</span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('rekap_produk') }}"
                                            class="sidebar-link"><span class="hide-menu">Rekap Produk
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('rekap_harian') }}"
                                            class="sidebar-link"><span class="hide-menu">Rekap Harian
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('pengeluaran_harian.index') }}"
                                            class="sidebar-link"><span class="hide-menu">Pengeluaran Harian
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('jurnal_harian.index') }}"
                                            class="sidebar-link"><span class="hide-menu">Jurnal Harian
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('logout') }}" aria-expanded="false"><i data-feather="log-out"
                                        class="feather-icon"></i><span class="hide-menu">Keluar</span></a></li>
                        </ul>
                    </nav>
                @elseif (Auth::user()->role_id == 4)
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link active" href="/kasir"
                                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                        class="hide-menu">Dashboard</span></a></li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Pesanan</span></li>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Transaksi </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('pesanan.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Pesanan
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('logout') }}" aria-expanded="false"><i data-feather="log-out"
                                        class="feather-icon"></i><span class="hide-menu">Keluar</span></a></li>
                        </ul>
                    </nav>
                @elseif(Auth::user()->role_id == 5)
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link active" href="/kasir"
                                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                        class="hide-menu">Dashboard</span></a></li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Pemesanan</span></li>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Transaksi </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('transaksi.create') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Baru
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('transaksi.berjalan') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Berjalan
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('transaksi.selesai') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Selesai
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active"
                                    href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text"
                                        class="feather-icon"></i><span class="hide-menu">Antrian Dapur </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('pesanan_diproses') }}"
                                            class="sidebar-link"><span class="hide-menu"> Antrian Pesanan
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('pesanan_selesai') }}"
                                            class="sidebar-link"><span class="hide-menu"> Antrian Selesai
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('logout') }}" aria-expanded="false"><i data-feather="log-out"
                                        class="feather-icon"></i><span class="hide-menu">Keluar</span></a></li>
                        </ul>
                    </nav>
                @endif
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>


    <script></script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="{{ asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
    <script>
        $(function() {
            c3.generate({
                bindto: "#campaign-v2",
                data: {
                    columns: [
                        ["Direct Sales", 25],
                        ["Referral Sales", 15],
                        ["Afilliate Sales", 10],
                        ["Indirect Sales", 15]
                    ],
                    type: "donut",
                    tooltip: {
                        show: !0
                    }
                },
                donut: {
                    label: {
                        show: !1
                    },
                    title: "Sales",
                    width: 18
                },
                legend: {
                    hide: !0
                },
                color: {
                    pattern: ["#edf2f6", "#5f76e8", "#ff4f70", "#01caf1"]
                }
            });
            d3.select("#campaign-v2 .c3-chart-arcs-title").style("font-family", "Rubik");
            var e = {
                axisX: {
                    showGrid: !1
                },
                seriesBarDistance: 1,
                chartPadding: {
                    top: 15,
                    right: 15,
                    bottom: 5,
                    left: 0
                },
                plugins: [Chartist.plugins.tooltip()],
                width: "100%"
            };
            new Chartist.Bar(".net-income", {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                series: [
                    [5, 4, 3, 7, 5, 10]
                ]
            }, e, [
                ["screen and (max-width: 640px)", {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function(e) {
                            return e[0]
                        }
                    }
                }]
            ]), jQuery("#visitbylocate").vectorMap({
                map: "world_mill_en",
                backgroundColor: "transparent",
                borderColor: "#000",
                borderOpacity: 0,
                borderWidth: 0,
                zoomOnScroll: !1,
                color: "#d5dce5",
                regionStyle: {
                    initial: {
                        fill: "#d5dce5",
                        "stroke-width": 1,
                        stroke: "rgba(255, 255, 255, 0.5)"
                    }
                },
                enableZoom: !0,
                hoverColor: "#bdc9d7",
                hoverOpacity: null,
                normalizeFunction: "linear",
                scaleColors: ["#d5dce5", "#d5dce5"],
                selectedColor: "#bdc9d7",
                selectedRegions: [],
                showTooltip: !0,
                onRegionClick: function(e, t, o) {
                    var a = 'You clicked "' + o + '" which has the code: ' + t.toUpperCase();
                    alert(a)
                }
            });
            var t = new Chartist.Line(".stats", {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                series: [
                    [11, 10, 15, 21, 14, 23, 12]
                ]
            }, {
                low: 0,
                high: 28,
                showArea: !0,
                fullWidth: !0,
                plugins: [Chartist.plugins.tooltip()],
                axisY: {
                    onlyInteger: !0,
                    scaleMinSpace: 40,
                    offset: 20,
                    labelInterpolationFnc: function(e) {
                        return e / 1 + "k"
                    }
                }
            });
            t.on("draw", function(e) {
                "area" === e.type && e.element.attr({
                    x1: e.x1 + .001
                })
            }), t.on("created", function(e) {
                e.svg.elem("defs").elem("linearGradient", {
                    id: "gradient",
                    x1: 0,
                    y1: 1,
                    x2: 0,
                    y2: 0
                }).elem("stop", {
                    offset: 0,
                    "stop-color": "rgba(255, 255, 255, 1)"
                }).parent().elem("stop", {
                    offset: 1,
                    "stop-color": "rgba(80, 153, 255, 1)"
                })
            }), $(window).on("resize", function() {
                t.update()
            })
        });
    </script>
</body>

</html>
