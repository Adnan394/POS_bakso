@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
    <div class="row mt-5">
        <div class="col-8 mt-3">
            <div data-spy="scroll" style="position: relative; height: 570px; overflow: auto;">
                <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td><input type="number" name="product[]" onchange="updateSubtotal(this)"
                                data-price="{{ $product->price }}"></td>
                        <td class="subtotal">Rp. 0</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-4 mt-1">
            <form method="POST" action=""
            enctype="multipart/form-data" class="mt-4 mr-5">
            @csrf
            <div class="form-group">
                <label for="name">Nama Customer</label>
                <input type="text" name="name" class="form-control border-primary"
                    required>
            </div>
            <div class="form-group">
                <label for="price">Total Item</label>
                <input type="text" name="email" class="form-control border-primary" value="6"
                    readonly>
            </div>
            <div class="form-group">
                <label for="price">Total Price</label>
                <input type="text" name="email" class="form-control border-primary" value="60000"
                    readonly>
            </div>
            <div class="form-group">
                <label for="price">Paid</label>
                <input type="text" name="email" class="form-control border-primary" value="60000"
                    readonly>
            </div>
            <div class="form-group">
                <label for="price">Return</label>
                <input type="text" name="email" class="form-control border-primary" value="0"
                    readonly>
            </div>

            <div class="row pt-5">
                <div class="col-6">
                    <button type="button" class="btn btn-lg btn-dark btn-block">Hold</button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-lg btn-danger btn-block">Cancel</button>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-8 text-center">
                    <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#confirmOrderCenter">
                        Finish Order
                    </button>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-lg btn-primary btn-block">Invoice</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
