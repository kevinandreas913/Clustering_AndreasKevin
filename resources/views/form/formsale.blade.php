@include('template.header')
<link rel="stylesheet" href="{{ asset('css/formtoko.css') }}">
</head>

<body>
    @if(session('berhasil'))
    <div class="alert alert-success">
        <h3>{{ session('berhasil') }}</h3>
    </div>
    @endif

    <div class="container col-lg-6">
        <div class="text-center">
            <h1>Form Penjualan</h1>
        </div>
        <div class=""></div>
        <form id="form-penjualan" action="{{ route('sale.store') }}" method="POST">
            @csrf
            <!-- Nama Produk -->
            <div class="form-group mb-3">
                <label for="product_id">Nama Produk:</label>
                <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                    <option value="">Pilih Nama Produk</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }}
                    </option>
                    @endforeach
                </select>
                @error('product_id')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Nama Toko -->
            <div class="form-group mb-3">
                <label for="store_id">Nama Toko:</label>
                <select id="store_id" name="store_id" class="form-control @error('store_id') is-invalid @enderror">
                    <option value="">Pilih Nama Toko</option>
                    @foreach($stores as $store)
                    <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                        {{ $store->nama_toko }}
                    </option>
                    @endforeach
                </select>
                @error('store_id')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Banyak Terjual -->
            <div class="form-group mb-3">
                <label for="banyak_terjual">Banyak Terjual:</label>
                <input type="number" id="banyak_terjual" name="banyak_terjual" value="{{ old('banyak_terjual') }}" placeholder="Masukkan jumlah produk terjual" class="form-control @error('banyak_terjual') is-invalid @enderror" style="width: 50%;">
                @error('banyak_terjual')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Harga Unit -->
            <div class="form-group mb-3">
                <label for="harga_unit">Harga Unit:</label>
                <input type="text" id="harga_unit" name="harga_unit" value="{{ old('harga_unit') }}" placeholder="Masukkan harga unit produk pada toko tersebut (contoh 20000)" class="form-control @error('harga_unit') is-invalid @enderror" oninput="formatRupiah(this)" style="width: 50%;">
                @error('harga_unit')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Durasi Penjualan -->
            <div class="form-group mb-3">
                <label for="durasi_penjualan">Durasi Penjualan (dalam hari):</label>
                <input type="number" id="durasi_penjualan" name="durasi_penjualan" value="{{ old('durasi_penjualan') }}" placeholder="Masukkan durasi penjualan konsinyasi" class="form-control @error('durasi_penjualan') is-invalid @enderror" style="width: 50%;">
                @error('durasi_penjualan')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Bulan Periode -->
            <div class="form-group mb-3">
                <label for="bulan_periode">Bulan Periode:</label>
                <input type="month" id="bulan_periode" name="bulan_periode" value="{{ old('bulan_periode') }}" placeholder="Masukkan bulan periode penjualan" class="form-control @error('bulan_periode') is-invalid @enderror" style="width: 50%;">
                @error('bulan_periode')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                <a href="/viewtabelsale"><button type="button" class="btn btn-secondary">KEMBALI</button></a>
            </div>
        </form>
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            if (value) {
                input.value = parseInt(value).toLocaleString('id-ID'); // Format with comma
            } else {
                input.value = '';
            }
        }

        // Function to remove formatting before submitting
        function unformatRupiah(input) {
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            input.value = value;
        }

        // Add event listener to the form before submitting
        document.querySelector('form').addEventListener('submit', function(event) {
            let hargaInput = document.getElementById('harga_unit');
            unformatRupiah(hargaInput); // Clean formatting before form submission
        });
    </script>
</body>

</html>