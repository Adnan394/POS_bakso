@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
    <div class="mt-5 mx-5">
        <div class="row d-flex justify-content-between">
            <div class="mb-5">
                <h1>Laporan Rekapitulasi Produk</h1>
                {{-- <h3 id="humanTime">{{ $human_time }}</h3> --}}
            </div>
            <div class="">
                <label for="" class="form-label">Ganti Tanggal</label>
                <input type="date" name="" id="date" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="d-flex flex-wrap">
                <div class="card border-right" style="width: 20rem">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center justify-content-between">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium" id="pendapatan"></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Bakso Polos</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right" style="width: 20rem">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center justify-content-between">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium" id="cash"></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Bakso Urat</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right" style="width: 20rem">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center justify-content-between">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium" id="qris"></h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Bakso Daging</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-5" style="position: relative; overflow-x:scroll;">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead class="text-center"> 
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Terjual</th>
                    </tr>
                </thead>
                <tbody id="report">
                    @foreach ($data as $key => $transaksi)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $transaksi['menu'] }}</td>
                            <td>{{ $transaksi['porsi'] }} Porsi</td>
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
            url: "{{ route('rekap_produk') }}",
            dataType: "JSON",
            data: {
                date : $("#date").val(),
            },
            success: function(data) {
                html = "";
                $.each(data, function(i, item) {
                    html += `
                        <tr>
                            <th scope="row">${i+1}</th>
                            <td>${item.menu}</td>
                            <td>${item.porsi}</td>
                        </tr>
                    `
                }); 
                $("#report").html(html);   
            }
        });
        });
    });
</script>