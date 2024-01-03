@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <div class="row mt-5">
            <div class="col-8 mt-3">
                <div data-spy="scroll" style="position: relative; height: 570px; overflow: auto;">
                    <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data" class="mt-4 mr-5">
                        @csrf
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
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <input type="hidden" name="produk[]" value="{{ $product->id }}">
                                            <input type="number" name="qty[]" onchange="updateSubtotal(this)"
                                                data-price="{{ $product->price }}">
                                    </td>
                                    <td class="subtotal">Rp. 0</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 mt-1">
                
                    <div class="form-group">
                        <label for="name">Nama Customer</label>
                        <input type="text" name="name_customer" class="form-control border-primary" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nomor Meja</label>
                        <input type="text" name="table_id" class="form-control border-primary" required>
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Price</label>
                        <input type="text" name="price_amount" class="form-control border-primary" value="0" readonly>
                    </div>
                    <div class="row py-2">
                        <div class="col-8 text-center">
                            <button type="submit" class="btn btn-lg btn-success btn-block" data-toggle="modal"
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
        function updateSubtotal(input) {
            var price = parseFloat(input.getAttribute('data-price'));
            var quantity = parseInt(input.value);
            var subtotal = price * quantity;

            // Menemukan elemen td.subtotal terkait dan mengupdate nilainya
            var subtotalElement = input.parentNode.nextElementSibling;
            subtotalElement.innerHTML = 'Rp. ' + subtotal.toLocaleString(); // Menambah format angka dengan toLocaleString()

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
            totalPriceInput.value = totalPrice; // Menambah format angka dengan toLocaleString()
        }
    </script>
@endsection
