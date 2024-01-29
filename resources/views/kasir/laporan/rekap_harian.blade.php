@extends('layouts.admin')

@section('content')
    <div class="page-wrapper" id="report">
        <div class="mt-5 mx-5">
            <div class="row d-flex justify-content-between">
                <div class="mb-5">
                    <h1>Laporan Rekapitulasi Harian</h1>
                    <h3>{{ $human_time }}</h3>
                </div>
                <div class="">
                    <label for="" class="form-label">Ganti Tanggal</label>
                    <input type="date" name="" id="date" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="d-flex gap-3">
                    <div class="card border-right" style="width: 20rem">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center justify-content-between">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">Rp. {{ number_format($data->sum('pay_amount'), 0, ",", ",") }}</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Pendapatan</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <table id="zero_confi" class="table table-striped table-bordered no-wrap">
                <thead class="text-center"> 
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Penanggung Jawab</th>
                        <th scope="col" colspan="3">Pesanan</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $transaksi)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $transaksi->name_customer }}</td>
                            <td>{{ \App\Models\User::where('id', $transaksi->user_id)->first()->name }}</td>
                            <td>
                                @foreach (\App\Models\transaction_detail::where('transaction_id', $transaksi->id)->get() as $item)
                                    <p>{{ \App\Models\Produk::where('id', $item->product_id)->first()->name }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach (\App\Models\transaction_detail::where('transaction_id', $transaksi->id)->get() as $item)
                                    <p>{{ $item->qty }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach (\App\Models\transaction_detail::where('transaction_id', $transaksi->id)->get() as $item)
                                    <p>{{ \App\Models\Produk::where('id', $item->product_id)->first()->price * $item->qty }}</p>
                                @endforeach
                            </td>
                            <td>{{ number_format($transaksi->pay_amount, 0, ",", ",") }}</td>
                            <td>{{ $transaksi->payment->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#date").on("change", function() {
            $.ajax({
            type: 'GET',
            url: "{{ route('rekap_harian') }}",
            dataType: "JSON",
            data: {
                date : $("#date").val(),
            },
            success: function(data) {
                console.log(data);
            }
        });
        });
    });
</script>