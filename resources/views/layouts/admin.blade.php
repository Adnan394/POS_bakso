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
                                        class="text-dark">{{ Auth::user()->name }}</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
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

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow in active" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                        class="hide-menu">Master Setting</span></a>
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
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('accounts.index') }}"
                                    aria-expanded="false"><i data-feather="user"
                                        class="feather-icon"></i><span class="hide-menu">User Setting</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('locations.index') }}"
                                    aria-expanded="false"><i data-feather="map-pin" class="feather-icon"></i><span
                                        class="hide-menu">Location Setting</span></a></li>

                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Data Transaksi</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                    aria-expanded="false"><i data-feather="shopping-cart" class="feather-icon"></i><span
                                        class="hide-menu">Pengeluaran
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                    aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span
                                        class="hide-menu">Penjualan
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
                                        class="feather-icon"></i><span class="hide-menu">Logout</span></a></li>
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

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow in active" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Master Setting</span></a>
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
                                aria-expanded="false"><i data-feather="shopping-cart" class="feather-icon"></i><span
                                    class="hide-menu">Pengeluaran
                                </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span
                                    class="hide-menu">Penjualan
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
                                    class="feather-icon"></i><span class="hide-menu">Logout</span></a></li>
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

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                        class="hide-menu">Transaksi </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('transaksi.create') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Baru
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('transaksi.berjalan') }}"
                                            class="sidebar-link"><span class="hide-menu"> Transaksi Berjalan
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('logout') }}" aria-expanded="false"><i data-feather="log-out"
                                        class="feather-icon"></i><span class="hide-menu">Logout</span></a></li>
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

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow active" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                        class="hide-menu">Transaksi </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                                    <li class="sidebar-item"><a href="{{ route('minuman.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Pesanan Minuman
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="{{ route('makanan.index') }}"
                                            class="sidebar-link"><span class="hide-menu"> Pesanan Makanan
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{ route('logout') }}" aria-expanded="false"><i data-feather="log-out"
                                        class="feather-icon"></i><span class="hide-menu">Logout</span></a></li>
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

    <script src="{{ asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
</body>

</html>
