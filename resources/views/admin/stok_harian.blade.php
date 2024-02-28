@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Stok Harian</h4>
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
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-tambah">Tambah Stok Harian</button>
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
                        <h4 class="card-title">List Of Stok</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bakso Polos</th>
                                        <th>Bakso Urat</th>
                                        <th>bakso Daging</th>
                                        <th>Lokasi</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->bakso_polos }}</td>
                                            <td>{{ $item->bakso_urat }}</td>
                                            <td>{{ $item->bakso_daging }}</td>
                                            <td>{{ $item->location->locations }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="" data-toggle="modal"
                                                    data-target="#modal-edit{{ $item->id }}" style="width: 50px"
                                                    class="btn btn-warning"><i class="bi bi-pencil"><span
                                                            class="fas fa-edit"></span></i></a>
                                                <form action="{{ route('stok_harian.destroy', $item->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" style="width: 50px" class="btn btn-danger"><i
                                                            class="bi bi-trash3">
                                                            <span class="fas fa-trash-alt"></span></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div id="modal-edit{{ $item->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="modal-editLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-colored-header bg-primary">
                                                        <h4 class="modal-title" id="modal-editLabel">Form Edit Stok
                                                        </h4>
                                                        <button type="reset" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Edit Stok</h4>
                                                                    <form method="POST"
                                                                        action="{{ route('stok_harian.update', $item->id) }}"
                                                                        enctype="multipart/form-data" class="mt-4">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label for="name">Stok Bakso Polos</label>
                                                                            <input type="number" name="bakso_polos" value="{{ $item->bakso_polos }}" class="form-control border-primary"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">Stok Bakso Urat</label>
                                                                            <input type="number" name="bakso_urat" value="{{ $item->bakso_urat }}" class="form-control border-primary"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">Stok Bakso Daging</label>
                                                                            <input type="number" name="bakso_daging" value="{{ $item->bakso_daging }}" class="form-control border-primary"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="location_id">Lokasi
                                                                                Cabang</label>
                                                                            <select name="location_id" id="location_id" required>
                                                                                <option
                                                                                    value="{{ $item->location_id }}"
                                                                                    readonly selected>
                                                                                    {{ $item->location->locations }}
                                                                                </option>
                                                                                @foreach ($locations as $location)
                                                                                    <option
                                                                                        value="{{ $location->id }}">
                                                                                        {{ $location->locations }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
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
                    <h4 class="modal-title" id="modal-tambahLabel">Form Tambah Stok
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambahkan Stok</h4>
                                <form method="POST" action="{{ route('stok_harian.store') }}"
                                    enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Stok Bakso Polos</label>
                                        <input type="number" name="bakso_polos" class="form-control border-primary"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Stok Bakso Urat</label>
                                        <input type="number" name="bakso_urat" class="form-control border-primary"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Stok Bakso Daging</label>
                                        <input type="number" name="bakso_daging" class="form-control border-primary"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="location_id">Lokasi Cabang</label>
                                        <select name="location_id" id="location_id" required>
                                            <option disabled selected>Pilih Lokasi Cabang</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">
                                                    {{ $location->locations }}
                                                </option>
                                            @endforeach
                                        </select>
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