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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <input type="number" name="product[]" oninput="updateSubtotal({{ $key }})"
                                            class="qty-input">
                                    </td>
                                    <td id="subtotal_{{ $key }}">Rp. 0</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 mt-1">
                <form method="POST" action="" enctype="multipart/form-data" class="mt-4 mr-5">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Customer</label>
                        <input type="text" name="name" class="form-control border-primary" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nomor Meja</label>
                        <input type="text" name="name" class="form-control border-primary" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Diskon</label>
                        <input type="text" name="name" class="form-control border-primary" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Total Item</label>
                        <input type="text" name="email" class="form-control border-primary" value="6" readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">Total Price</label>
                        <input type="text" name="email" class="form-control border-primary" value="60000" readonly>
                    </div>
                    <div class="row py-2">
                        <div class="col-8 text-center">
                            <button type="button" class="btn btn-lg btn-success btn-block" data-toggle="modal"
                                data-target="#confirmOrderCenter">
                                Create Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateSubtotal(index) {
            // Mendapatkan nilai qty yang dimasukkan
            var qtyInput = document.getElementsByClassName('qty-input')[index];
            var qty = qtyInput.value;

            // Mendapatkan harga produk dari kolom Price
            var priceColumn = document.getElementsByTagName('td')[index * 5 + 2]; // Setiap baris memiliki 5 kolom
            var price = parseFloat(priceColumn.innerText.replace('Rp. ', '').replace('.', ''));
            console.log(price);

            // Menghitung subtotal dan memperbarui tampilan
            var subtotal = qty * price;
            var subtotalColumn = document.getElementById('subtotal_' + index);
            subtotalColumn.innerText = 'Rp. ' + subtotal.toLocaleString('id-ID');
        }
    </script>
@endsection
