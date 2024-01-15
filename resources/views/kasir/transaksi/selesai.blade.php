@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 align-self-center ml-2 mb-3">
                    <div class="customize-input float-left">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                            Tambah Transaksi</a>
                    </div>
                </div>
                <form class="form searchartikel align-items-center ml-4" method="get" action="berjalan">
                    <div class="form-group ">
                        <a href="{{ route('transaksi.berjalan') }}" ><button class="btn btn-primary"><i class="fas fa-sync-alt"></i></button></a>
                        <input type="text" name="keyword" class="form-control w-50 d-inline" id="search" placeholder="Masukkan kata kunci">
                        <button type="submit" class="btn btn-primary mb-1">Cari</button>
                    </div>
                </form> 
                <div class="col-12">
                    <h6 class="">Transaksi Selesai ({{ $transaksi->count() }})</h6>
                </div>
                @foreach ($transaksi as $item)
                <div class="col-lg-4 col-md-12">
                    <div class="card pb-5">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#">{{ $item->name_customer }}</a></h5>
                            <small>{{ $item->created_at }}</small>
                            <p class="card-text mt-2">Meja {{ $item->table->number }}</p>
                            <p class="card-text">Untuk {{ $item->transaction_detail->sum('qty') }} items</p>
                            <p class="card-text">Total Harga <strong>Rp.{{ number_format($item->price_amount, 0, ',', '.') }}</strong></p>
                        </div>
                        <hr class="mt-0">
                        <div class="row">
                            <div class="col-6 pr-0">
                                <ul class="list-group list-group-flush">
                                    @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->get() as $detail)
                                        <li class="list-group-item border-0">{{ \App\Models\Produk::where('id', $detail->product_id)->first()->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-2 px-0 mx-0">
                                <ul class="list-group list-group-flush">
                                    @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->get() as $detail)
                                        <li class="list-group-item border-0">x{{ $detail->qty }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-4 pl-0">
                                <ul class="list-group list-group-flush">
                                    @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->get() as $detail)
                                        <li class="list-group-item border-0">Rp.{{ number_format($detail->price, 0, ',', '.') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
