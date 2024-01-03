@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat datang! {{ Auth::user()->name }}</h3>
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
                   <div class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('D, H:i d M Y') }}</div>
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
        <div class="row">
          <div class="col-5 align-self-center mb-3">
            <div class="customize-input float-left">
               <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Transaksi</a>
            </div>
        </div>
            <div class="col-12">
                <h6 class="">Transaksi Berjalan (4)</h6>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#">#ORD5519001</a></h5>
                      <small>Thu, 5 May, 2019 | 08:25 AM</small>
                      <p class="card-text">For 6 Items</p>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                      <div class="col-8">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">Cras justo odio</li>
                          <li class="list-group-item border-0">Dapibus ac facilisis</li>
                          <li class="list-group-item border-0">Vestibulum at eros</li>
                        </ul>
                      </div>
                      <div class="col-4">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                        </ul>
                      </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body mx-auto">
                      <a href="cashier_detailorder.html" class="card-link">Detail Order</a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#">#ORD5519001</a></h5>
                      <small>Thu, 5 May, 2019 | 08:25 AM</small>
                      <p class="card-text">For 6 Items</p>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                      <div class="col-8">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">Cras justo odio</li>
                          <li class="list-group-item border-0">Dapibus ac facilisis</li>
                          <li class="list-group-item border-0">Vestibulum at eros</li>
                        </ul>
                      </div>
                      <div class="col-4">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                        </ul>
                      </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body mx-auto">
                      <a href="cashier_detailorder.html" class="card-link">Detail Order</a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#">#ORD5519001</a></h5>
                      <small>Thu, 5 May, 2019 | 08:25 AM</small>
                      <p class="card-text">For 6 Items</p>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                      <div class="col-8">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">Cras justo odio</li>
                          <li class="list-group-item border-0">Dapibus ac facilisis</li>
                          <li class="list-group-item border-0">Vestibulum at eros</li>
                        </ul>
                      </div>
                      <div class="col-4">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                        </ul>
                      </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body mx-auto">
                      <a href="cashier_detailorder.html" class="card-link">Detail Order</a>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h6 class="">Transaksi Selesai (4)</h6>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#">#ORD5519001</a></h5>
                      <small>Thu, 5 May, 2019 | 08:25 AM</small>
                      <p class="card-text">For 6 Items</p>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                      <div class="col-8">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">Cras justo odio</li>
                          <li class="list-group-item border-0">Dapibus ac facilisis</li>
                          <li class="list-group-item border-0">Vestibulum at eros</li>
                        </ul>
                      </div>
                      <div class="col-4">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                        </ul>
                      </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body mx-auto">
                      <a href="cashier_detailorder.html" class="card-link">Detail Order</a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#">#ORD5519001</a></h5>
                      <small>Thu, 5 May, 2019 | 08:25 AM</small>
                      <p class="card-text">For 6 Items</p>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                      <div class="col-8">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">Cras justo odio</li>
                          <li class="list-group-item border-0">Dapibus ac facilisis</li>
                          <li class="list-group-item border-0">Vestibulum at eros</li>
                        </ul>
                      </div>
                      <div class="col-4">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                        </ul>
                      </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body mx-auto">
                      <a href="cashier_detailorder.html" class="card-link">Detail Order</a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="#">#ORD5519001</a></h5>
                      <small>Thu, 5 May, 2019 | 08:25 AM</small>
                      <p class="card-text">For 6 Items</p>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                      <div class="col-8">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">Cras justo odio</li>
                          <li class="list-group-item border-0">Dapibus ac facilisis</li>
                          <li class="list-group-item border-0">Vestibulum at eros</li>
                        </ul>
                      </div>
                      <div class="col-4">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                          <li class="list-group-item border-0">x2</li>
                        </ul>
                      </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body mx-auto">
                      <a href="cashier_detailorder.html" class="card-link">Detail Order</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center text-muted">
        All Rights Reserved by Adminmart. Designed and Developed by <a
            href="https://wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
@endsection
