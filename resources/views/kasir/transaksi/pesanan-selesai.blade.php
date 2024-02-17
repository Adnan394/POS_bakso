@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Pesanan</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="/superadmin" class="text-muted">Home</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">{{ Request::segment(2) }}
                                </li>
                            </ol>
                        </nav>
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- basic table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pesanan Selesai</h4>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Atas Nama</th>
                                            <th>Pesanan</th>
                                            <th>Pilihan</th>
                                            <th>Nomor Meja</th>
                                            <th>Waktu Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="content-table">
                                        @foreach ($transaksi as $index => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name_customer }}</td>
                                            <td>
                                                @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->where('order_status', 'Jadi')->get() as $transaction_detail)
                                                <div class="d-flex justify-content-between mb-3">
                                                    @if (\App\Models\Produk::where('id', $transaction_detail->product_id)->where('location_id', '!=', null)->first())
                                                        <span>
                                                            {{ \App\Models\Produk::where('id', $transaction_detail->product_id)->where('location_id', '!=', null)->first()->name }}
                                                        </span>
                                                        <span>
                                                            x{{ $transaction_detail->qty }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-muted">Pesan : {{ $transaction_detail->note }}</p>
                                                <hr style="border: 1px solid grey">
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->where('order_status', 'Jadi')->get() as $transaction_detail)
                                                <div class="d-flex justify-content-between mb-3">
                                                    @if (\App\Models\Produk::where('id', $transaction_detail->product_id)->where('location_id', '!=', null)->first())
                                                        <span>{{ $transaction_detail->order_type }}</span>
                                                    @endif
                                                </div>
                                                <p class="text-muted">.</p>
                                                <hr style="border: 1px solid grey">
                                                @endforeach
                                            </td>
                                            <td>{{ $item->table->number }}</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- order table -->
            <!-- ============================================================== -->
        </div>

    </div>
@endsection
