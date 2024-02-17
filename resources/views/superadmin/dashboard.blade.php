@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat datang! {{ Auth::user()->name }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                   <div class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('D, H:i d M Y') }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- *************************************************************** -->
        <!-- Start First Cards -->
        <!-- *************************************************************** -->
        <div class="card-group">
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium"><sup class="set-doller">Rp.</sup>{{ $revenue_today }}</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pendapatan Hari ini</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                    class="set-doller">Rp.</sup>{{ $revenue_week }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pendapatan Minggu ini
                            </h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $revenue_month }}</h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pendapatan Bulan ini</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End First Cards -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Sales Charts Section -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Sales</h4>
                        <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                        <ul class="list-style-none mb-0">
                            <li>
                                <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                <span class="text-muted">Direct Sales</span>
                                <span class="text-dark float-right font-weight-medium">$2346</span>
                            </li>
                            <li class="mt-3">
                                <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                <span class="text-muted">Referral Sales</span>
                                <span class="text-dark float-right font-weight-medium">$2108</span>
                            </li>
                            <li class="mt-3">
                                <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                <span class="text-muted">Affiliate Sales</span>
                                <span class="text-dark float-right font-weight-medium">$1204</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Net Income</h4>
                        <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                        <ul class="list-inline text-center mt-5 mb-2">
                            <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End Sales Charts Section -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Location and Earnings Charts Section -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <h4 class="card-title mb-0">Earning Statistics</h4>
                        </div>
                        <div class="pl-4 mb-5">
                            <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                        </div>
                        <ul class="list-inline text-center mt-4 mb-0">
                            <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End Location and Earnings Charts Section -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Top Leader Table -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- End Top Leader Table -->
        <!-- *************************************************************** -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center text-muted">
       Dibuat dan Dikembangkan oleh <a
       href="https://www.instagram.com/adityaimamz" target="_blank">Aditya Imam Zuhdi</a> dan <a href="https://www.instagram.com/adnangandul" target="_blank">Adnan Ega Maulana</a>
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
@endsection