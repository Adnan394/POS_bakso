@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <div class="row mt-5">
            <div class="col-12 col-lg-8 mt-3"> <!-- Mengubah lebar kolom menjadi 12 pada tampilan mobile -->
                <div data-spy="scroll" style="position: relative; height: 570px; overflow: auto;">
                    <div class="col-5 align-self-center mb-3">
                        <div class="customize-input">
                            <a href="{{ route('transaksi.edit', $data->id) }}" class="btn btn-primary">
                                Edit Transaksi</a>
                        </div>
                    </div>
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ \App\Models\Produk::find($product->product_id)->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td><input type="number" name="product[]" value="{{ $product->qty }}" onchange="updateSubtotal(this)"
                                            data-price="{{ $product->price }}" ></td>
                                    <td class="subtotal">Rp. 0</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4 mt-1 px-lg-5"> <!-- Mengubah lebar kolom menjadi 12 pada tampilan mobile -->
                <div class="">
                <form method="POST" action="" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Customer</label>
                        <input type="text" name="name" class="form-control border-primary"
                            value="{{ $data->name_customer }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Total Item</label>
                        <input type="number" name="total_item" class="form-control border-primary"
                            value="{{ $data->transaction_detail->sum('qty') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">Total Price</label>
                        <input type="number" name="price_amount" class="form-control border-primary" value="0"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">Paid</label>
                        <input type="number" name="paid" class="form-control border-primary" value="0"
                            onchange="updateReturn()">
                    </div>
                    <div class="form-group">
                        <label for="price">Return</label>
                        <input type="number" name="return" class="form-control border-primary" value="0" readonly>
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
                            <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal"
                                data-target="#confirmOrderCenter">
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
    </div>

    <script>
        function updateSubtotal(input) {
            var price = parseFloat(input.getAttribute('data-price'));
            var quantity = parseInt(input.value);
            var subtotal = price * quantity;

            // Menemukan elemen td.subtotal terkait dan mengupdate nilainya
            var subtotalElement = input.parentNode.nextElementSibling;
            subtotalElement.innerHTML = 'Rp. ' + subtotal.toLocaleString();

            // Mengupdate nilai Total Price
            updateTotalPrice();
        }

        function updateTotalPrice() {
            var subtotalElements = document.getElementsByClassName('subtotal');
            var totalPrice = 0;

            for (var i = 0; i < subtotalElements.length; i++) {
                var subtotalText = subtotalElements[i].innerText;
                var subtotalValue = parseFloat(subtotalText.replace('Rp. ', '').replace(',', ''));

                totalPrice += subtotalValue;
            }

            // Menemukan elemen input Total Price dan mengupdate nilainya
            var totalPriceInput = document.getElementsByName('price_amount')[0];
            totalPriceInput.value = totalPrice;
        }

        function updateReturn() {
            var totalPrice = parseFloat(document.getElementsByName('price_amount')[0].value);
            var paid = parseFloat(document.getElementsByName('paid')[0].value);

            var returnInput = document.getElementsByName('return')[0];
            returnInput.value = (paid - totalPrice).toFixed(2);
        }
    </script>
@endsection
