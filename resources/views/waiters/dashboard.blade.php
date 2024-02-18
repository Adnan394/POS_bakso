@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat datang!
                        {{ Auth::user()->name }}</h3>
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
                        <div
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            {{ \Carbon\Carbon::now('Asia/Jakarta')->format('D, H:i d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="col-5 align-self-center mb-3">
                <div class="customize-input">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                        Tambah Transaksi</a>
                </div>
            </div>
            <div class="card-group d-flex flex-wrap gap-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">
                                {{ \App\Models\Transaction::whereExists(function ($query) {
                                    $query->select(\DB::raw(1))
                                        ->from('transaction_details')
                                        ->whereRaw('transaction_details.transaction_id = transactions.id')
                                        ->where('transaction_details.status', 'Diproses');
                                })
                                ->count();
                                }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Antrian</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right ml-2">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $transaksi_active->count() }}</h2>
                                    <span
                                        class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+{{ number_format($persentase_active, 2) }}</span>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Transaksi Berjalan Hari Ini</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right ml-2">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                        class="set-doller"></sup>{{ $transaksi_done->count()  }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Transaksi Selesai Hari ini
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right ml-2">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">
                                        {{ $transaksi_total }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Semua Transaksi Hari ini</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                <div class="card border-right ml-3">
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
                <div class="card border-right ml-3">
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
            <div class="card-group">
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium"><sup class="set-doller">Rp.</sup>{{ $revenue_total_today }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pendapatan Gabungan Hari ini</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right ml-3">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                        class="set-doller">Rp.</sup>{{ $revenue_total_week }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pendapatan Gabungan Minggu ini
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right ml-3">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $revenue_total_month }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pendapatan Gabungan Bulan ini</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pendapatan Outlet Hari ini</h4>
                            <div id="pendapatan_outlet" class="mt-2" style="height:283px; width:100%;"></div>
                            <ul class="list-style-none mb-0">
                                <li>
                                    <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                    <span class="text-muted">Outlet Depan</span>
                                    <span class="text-dark float-right font-weight-medium">Rp.{{number_format($revenue_outlet_depan_today, 0, ",", ","), }}</span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                    <span class="text-muted">Outlet Belakang</span>
                                    <span class="text-dark float-right font-weight-medium">Rp.{{ number_format($revenue_outlet_belakang_today, 0, ",", ","), }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pendapatan Minggu ini</h4>
                            <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                            <ul class="list-inline text-center mt-5 mb-2">
                                <li class="list-inline-item text-muted font-italic">Sales for this week</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer text-center text-muted">
            Dibuat dan Dikembangkan oleh <a
            href="https://www.instagram.com/adityaimamz" target="_blank">Aditya Imam Zuhdi</a> dan <a href="https://www.instagram.com/adnangandul" target="_blank">Adnan Ega Maulana</a>
         </footer>
    </div>

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

    <script>
        $(function() {
            c3.generate({
                bindto: "#campaign-v2",
                data: {
                    columns: [
                        ["Outlet Depan", {{ $revenue_outlet_depan_today }}],
                        ["Outlet Belakang", {{  $revenue_outlet_belakang_today }}],
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
                    title: "Pendapatan",
                    width: 18
                },
                legend: {
                    hide: !0
                },
                color: {
                    pattern: [ "#ff4f70", "#01caf1"]
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
                    [{{ $revenue_senin_minggu_ini }}, {{ $revenue_selasa_minggu_ini }}, {{ $revenue_rabu_minggu_ini }}, {{ $revenue_kamis_minggu_ini }}, {{ $revenue_jumat_minggu_ini }}, {{ $revenue_sabtu_minggu_ini }}, {{ $revenue_minggu_minggu_ini }}]
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
@endsection
