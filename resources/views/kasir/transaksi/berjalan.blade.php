@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
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
    </div>
</div>
@endsection
