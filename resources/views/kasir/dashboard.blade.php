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
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $transaksi_active->count() }}</h2>
                                    <span
                                        class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+{{ number_format($persentase_active, 2) }}</span>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Transaksi Berjalan</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                        class="set-doller"></sup>{{ $transaksi_done->count()  }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Transaksi Selesai
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
                                    <h2 class="text-dark mb-1 font-weight-medium">
                                        {{ $transaksi_total }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Semua Transaksi</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $produk }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Menu </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
