@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
        <div class="row mt-5">
            <div class="col-12 col-lg-8 mt-3"> <!-- Mengubah lebar kolom menjadi 12 pada tampilan mobile -->
                <div data-spy="scroll" style="position: relative; height: 570px; overflow: auto;">
                    <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Menu</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
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
            <div class="col-12 col-lg-4 mt-1 px-lg-5"> <!-- Mengubah lebar kolom menjadi 12 pada tampilan mobile -->
                <div class="">
                    <div class="form-group">
                        <label for="name">Nama Customer</label>
                        <input type="text" name="name_customer" id="nama_customer" class="form-control border-primary"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nomor Meja</label>
                        <select name="table_id" id="table_id" required>
                            <option value="" disabled selected>Pilih Nomor Meja</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}">
                                    {{ $table->number }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Harga</label>
                        <input type="text" name="price_amount" class="form-control border-primary" value="0"
                            readonly>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 col-md-8 text-center">
                            <!-- Mengubah lebar kolom menjadi 12 pada tampilan mobile -->
                            <button type="submit" id="btn-selesai" class="btn btn-lg btn-success btn-block"
                                data-toggle="modal" data-target="#confirmOrderCenter" disabled>
                                Buat Transaksi
                            </button>
                        </div>
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

            // Memastikan quantity valid sebelum melakukan perhitungan
            if (!isNaN(quantity) && quantity >= 0) {
                var subtotal = price * quantity;

                // Menemukan elemen td.subtotal terkait dan mengupdate nilainya
                var subtotalElement = input.parentNode.nextElementSibling;
                subtotalElement.innerHTML = 'Rp. ' + subtotal
                    .toLocaleString(); // Menambah format angka dengan toLocaleString()

                // Mengupdate nilai Total Price
                updateTotalPrice();
            } else {
                // Jika quantity tidak valid, atur subtotal dan total price menjadi 0
                var subtotalElement = input.parentNode.nextElementSibling;
                subtotalElement.innerHTML = 'Rp. 0';
                updateTotalPrice();
            }
        }

        function updateTotalPrice() {
            var subtotalElements = document.getElementsByClassName('subtotal');
            var totalPrice = 0;

            for (var i = 0; i < subtotalElements.length; i++) {
                var subtotalText = subtotalElements[i].innerText;
                var subtotalValue = parseFloat(subtotalText.replace('Rp. ', '').replace(/,/g,
                '')); // Menggunakan replace dengan regular expression

                totalPrice += subtotalValue;
            }

            // Menemukan elemen input Total Price dan mengupdate nilainya
            var totalPriceInput = document.getElementsByName('price_amount')[0];
            totalPriceInput.value = totalPrice; // Menggunakan toLocaleString untuk menambah format angka
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $('#nama_customer, #table_id').on('input', function() {
            var customerName = $('#nama_customer').val();
            var tableId = $('#table_id').val();
            var btnSelesai = document.getElementById("btn-selesai");

            if (customerName && tableId) {
                btnSelesai.disabled = false;
            } else {
                btnSelesai.disabled = true;
            }
        });

        // Menangkap perubahan pada input #paid
        $('#nama_customer, #table_id').on('input', function() {
            var customerName = $('#nama_customer').val();
            var tableId = $('#table_id').val();

            let btn_selesai = document.getElementById("btn-selesai");

            // Memeriksa apakah nilai paid kosong
            if (!customerName && !tableId) {
                // Menonaktifkan tombol
                btn_selesai.disabled = true;
            }
        });
    </script>
@endsection
