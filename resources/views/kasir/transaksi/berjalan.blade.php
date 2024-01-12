@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5 align-self-center mb-3">
                    <div class="customize-input float-left">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                            Tambah Transaksi</a>
                    </div>
                </div>
                <form class="form searchartikel align-items-center" method="get" action="berjalan">
                    <div class="form-group ">
                        <input type="text" name="keyword" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
                        <button type="submit" class="btn btn-primary mb-1">Cari</button>
                    </div>
                </form> 
                <div class="col-12">
                    <h6 class="">Transaksi Berjalan ({{ $transaksi->count() }})</h6>
                </div>
                @foreach ($transaksi as $item)
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">{{ $item->name_customer }}</a></h5>
                            <small>{{ $item->created_at }}</small>
                            <p class="card-text">For {{ $item->transaction_detail->sum('qty') }} Items</p>
                        </div>
                        <hr class="mt-0">
                        <div class="row">
                            <div class="col-8">
                                <ul class="list-group list-group-flush">
                                    @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->get() as $detail)
                                        <li class="list-group-item border-0">{{ \App\Models\Produk::where('id', $detail->product_id)->first()->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-4">
                                <ul class="list-group list-group-flush">
                                    @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->get() as $detail)
                                        <li class="list-group-item border-0">x{{ $detail->qty }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr class="mb-0">
                        <div class="card-body mx-auto">
                            <a href="{{ route('transaksi.show', $item->id) }}" class="card-link">Tambahkan Orderan Tambahan</a>
                        </div>
                        <div class="card-body mx-auto pt-0">
                            <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-success">Selesaikan Orderan</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
