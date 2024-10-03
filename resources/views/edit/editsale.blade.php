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
            <h1>Edit Penjualan</h1>
        </div>
        <div class=""></div>
        <form id="form-penjualan" action="{{ url('/updatesale/'.$sales->uuid) }}" method="post">
            @method('PUT')
            @csrf

            <!-- Nama Produk -->
            <div class="form-group mb-3">
                <label for="product_id">Nama Produk:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#productInfo">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="productInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nama Produk</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Pilih nama produk yang dijual!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                    <option value="">Pilih Nama Produk</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id || $sales->product_id == $product->id ? 'selected' : '' }}>
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
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#storeInfo">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="storeInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nama Toko</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Pilih nama toko yang menjual produk!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <select id="store_id" name="store_id" class="form-control @error('store_id') is-invalid @enderror">
                    <option value="">Pilih Nama Toko</option>
                    @foreach($stores as $store)
                    <option value="{{ $store->id }}" {{ old('store_id') == $store->id || $sales->store_id == $store->id ? 'selected' : '' }}>
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
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#banyakTerjualInfo">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="banyakTerjualInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Banyak Terjual</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Masukkan jumlah produk yang terjual!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="number" id="banyak_terjual" name="banyak_terjual" value="{{ old('banyak_terjual') ?? $sales->banyak_terjual }}" placeholder="Masukkan jumlah produk terjual" class="form-control @error('banyak_terjual') is-invalid @enderror">
                @error('banyak_terjual')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Harga Unit -->
            <div class="form-group mb-3">
                <label for="harga_unit">Harga Unit:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#hargaUnitInfo">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="hargaUnitInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Harga Unit</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Masukkan harga per unit produk!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" step="0.01" id="harga_unit" name="harga_unit" value="{{ old('harga_unit') ?? $sales->harga_unit }}" placeholder="Masukkan harga unit produk pada toko tersebut" class="form-control @error('harga_unit') is-invalid @enderror" oninput="formatRupiah(this)">
                @error('harga_unit')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Durasi Penjualan -->
            <div class="form-group mb-3">
                <label for="durasi_penjualan">Durasi Penjualan (dalam hari):</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#durasiPenjualanInfo">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="durasiPenjualanInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Durasi Penjualan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Masukkan durasi penjualan dalam satuan hari!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="number" id="durasi_penjualan" name="durasi_penjualan" value="{{ old('durasi_penjualan') ?? $sales->durasi_penjualan }}" placeholder="Masukkan durasi penjualan" class="form-control @error('durasi_penjualan') is-invalid @enderror">
                @error('durasi_penjualan')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="form-group mb-3">
                <label for="tanggal">Bulan:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#tanggalInfo">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="tanggalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Bulan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Masukkan Bulan penjualan dilakukan!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="month" id="bulan_periode" name="bulan_periode" value="{{ old('bulan_periode') ?? $sales->bulan_periode }}" class="form-control @error('bulan_periode') is-invalid @enderror">
                @error('bulan_periode')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- submit -->
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