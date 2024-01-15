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
                            <h4 class="card-title">List Of Pesanan</h4>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Table</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name_customer }}</td>
                                                <td>{{ $item->table->number }}</td>
                                                <?php $statusCount = 0;
                                                foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->get() as $transactionStatus) {
                                                    if ($transactionStatus->status == 'Diproses') {
                                                        $statusCount += 1;
                                                    }
                                                } ?>
                                                <td><span
                                                        class="badge text-white {{ $statusCount == 0 ? 'bg-success' : 'bg-danger' }}">{{ $statusCount == 0 ? 'Selesai' : 'Belum selesai' }}</span>
                                                </td>
                                                <td>
                                                    <a href="" data-toggle="modal"
                                                        data-target="#modal-edit{{ $item->id }}" style="width: 50px"
                                                        class="btn btn-warning"><i class="bi bi-pencil"><span
                                                                class="fas fa-edit"></span></i></a>
                                                </td>
                                            </tr>
                                            <div id="modal-edit{{ $item->id }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="modal-editLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-primary">
                                                            <h4 class="modal-title" id="modal-editLabel">Detail Pesanan
                                                            </h4>
                                                            <button type="reset" class="close" data-bs-dismiss="modal"
                                                                aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Pesanan</h4>
                                                                        <p class="">Nama : {{ $item->name_customer }}</p>
                                                                        <p class="">No Meja : {{ $item->table->number }}</p>
                                                                        <form method="POST"
                                                                            action="{{ route('pesanan.update', $item->id) }}"
                                                                            enctype="multipart/form-transaction"
                                                                            class="mt-4">
                                                                            @method('PUT')
                                                                            @csrf
                                                                            @foreach (\App\Models\Transaction_detail::where('transaction_id', $item->id)->get() as $trans)
                                                                            <div class="row">
                                                                                <div class="col-10">
                                                                                    <div class="form-check">
                                                                                        <input {{ ($trans->status == "Jadi") ? 'checked disabled' : '' }} class="form-check-input" type="checkbox" value="{{ $trans->product_id }}" id="flexCheckDefault" name="produk[]">
                                                                                        <label class="form-check-label" for="flexCheckDefault">
                                                                                          {{ \App\Models\Produk::where('id', $trans->product_id)->first()->name }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <p>x{{ $trans->qty }}</p>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                            <div class="modal-footer">
                                                                                <button type="submiy"
                                                                                    class="btn btn-primary">Tambahkan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
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
        <div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-tambahLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="modal-tambahLabel">Form Tambah Produl
                        </h4>
                        <button type="button" class="close" transaction-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Tambahkan Akun Cabang</h4>
                                    <form method="POST" action="{{ route('accounts.store') }}"
                                        enctype="multipart/form-transaction" class="mt-4">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" class="form-control border-primary"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Email</label>
                                            <input type="email" name="email" class="form-control border-primary"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Password</label>
                                            <input type="password" name="password" class="form-control border-primary"
                                                required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-light">Kosongkan</button>
                                            <button type="submiy" class="btn btn-primary">Tambahkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
@endsection
