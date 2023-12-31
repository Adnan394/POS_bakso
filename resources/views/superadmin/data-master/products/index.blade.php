@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Products</h4>
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
                            data-target="#modal-tambah">Tambah Product</button>
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
                            <h4 class="card-title">List Of Products</h4>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Status Stock</th>
                                            <th>Gambar</th>
                                            <th>Outlet</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->status_stock }}</td>
                                                <td><img src="{{ asset($item->image) }}" alt="Image"
                                                        style="max-width: 100px; max-height: 100px;">
                                                </td>
                                                <td>{{ $item->outlet->name }}</td>
                                                <td>
                                                    <a href="" data-toggle="modal"
                                                        data-target="#modal-edit{{ $item->id }}" style="width: 50px"
                                                        class="btn btn-warning"><i class="bi bi-pencil"><span
                                                                class="fas fa-edit"></span></i></a>
                                                    <form action="{{ route('products.destroy', $item->id) }}"
                                                        method="POST">
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
                                                            <h4 class="modal-title" id="modal-editLabel">Form Tambah Produl
                                                            </h4>
                                                            <button type="reset" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Edit Product</h4>
                                                                        <form method="POST"
                                                                            action="{{ route('products.update', $item->id) }}"
                                                                            enctype="multipart/form-data" class="mt-4">
                                                                            @method('PUT')
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="name">Nama Product</label>
                                                                                <input type="text" name="name"
                                                                                    class="form-control border-primary"
                                                                                    value="{{ $item->name }}" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="price">Harga Product</label>
                                                                                <input type="text" name="price"
                                                                                    class="form-control border-primary"
                                                                                    value="{{ $item->price }}" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="status">Status Product</label>
                                                                                <select name="status_stock"
                                                                                    class="form-control border-primary"
                                                                                    id="status"
                                                                                    value="{{ $item->status_stock }}"
                                                                                    required>
                                                                                    <option value="Tersedia" selected>Ada
                                                                                    </option>
                                                                                    <option value="Habis">Habis</option>
                                                                                </select>
                                                                            </div>
                                                                            <fieldset class="form-group">
                                                                                <label for="customFile">Upload
                                                                                    Gambar</label>
                                                                                <input type="file" name="image"
                                                                                    accept=".jpg , .jpeg , .png"
                                                                                    value="{{ $item->image }}"
                                                                                    class="form-control-file"
                                                                                    id="exampleInputFile" required>
                                                                            </fieldset>
                                                                            <div class="form-group">
                                                                                <label for="outlet_id">Lokasi
                                                                                    Cabang</label>
                                                                                <select name="outlet_id"
                                                                                    id="outlet_id">
                                                                                    <option value="{{ $item->outlet_id }}"
                                                                                        disabled selected>
                                                                                        {{ $item->outlet->name }}
                                                                                    </option>
                                                                                    @foreach ($outlets as $outlet)
                                                                                        <option
                                                                                            value="{{ $outlet->id }}">
                                                                                            {{ $outlet->name }}
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
                        <h4 class="modal-title" id="modal-tambahLabel">Form Tambah Produl
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Tambahkan Product</h4>
                                    <form method="POST" action="{{ route('products.store') }}"
                                        enctype="multipart/form-data" class="mt-4">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nama Product</label>
                                            <input type="text" name="name" class="form-control border-primary"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Harga Product</label>
                                            <input type="text" name="price" class="form-control border-primary"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status Product</label>
                                            <select name="status_stock" class="form-control border-primary"
                                                id="status" required>
                                                <option value="Tersedia" selected>Ada</option>
                                                <option value="Habis">Habis</option>
                                            </select>
                                        </div>
                                        <fieldset class="form-group">
                                            <label for="customFile">Upload Gambar</label>
                                            <input type="file" name="image" accept=".jpg , .jpeg , .png"
                                                class="form-control-file" id="exampleInputFile" required>
                                        </fieldset>
                                        <div class="form-group">
                                            <label for="outlet_id">Lokasi
                                                Cabang</label>
                                            <select name="outlet_id"
                                                id="outlet_id">
                                                <option value=""
                                                    disabled selected>
                                                    pilih outlet/dapur
                                                </option>
                                                @foreach ($outlets as $outlet)
                                                    <option
                                                        value="{{ $outlet->id }}">
                                                        {{ $outlet->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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
