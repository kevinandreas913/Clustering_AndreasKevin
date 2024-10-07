@include('template.header')
</head>

<body>
    @if(session('berhasil'))
    <div class="alert alert-success">
        <h3> {{ session('berhasil') }}</h3>
    </div>
    @endif

    <div class="container col-lg-6">
        <div class="text-center">
            <h1>Form Barang</h1>
        </div>
        <div class=""></div>
        <form id="form-barang" action="{{ route('barang.store') }}" method="POST">
            @csrf
            <!-- kode barang -->
            <div class="form-group mb-3">
                <label for="jenis-transaksi">Kode Barang Dagang:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#kode_barang">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="kode_barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Kode Barang:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan kode produk anda!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="kode minimal 3 dan maximal 9!" class="form-control @error('kode_barang') is-invalid @enderror" style="width: 50%;">
                @error('kode_barang')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- nama barang -->
            <div class="form-group mb-3">
                <label for="jenis-transaksi">Barang Dagang:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#nama">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="nama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nama Barang:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan nama produk anda!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama barang!" class="form-control @error('nama') is-invalid @enderror" style="width: 80%;">
                @error('nama')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- keterangan -->
            <div class="form-group mb-3">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#keterangan">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="keterangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Keterangan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan rincian barang dagang</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan rincian barang dagang tersebut!" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- harga  -->
            <div class="form-group mb-3">
                <label for="nominal">Nominal:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#nominal">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="nominal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nominal</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan besar nominal (Rp) harga produk</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="harga" name="harga" value="{{ old('harga') }}" placeholder="Masukkan nominal disini! (contoh 150000)" class="form-control @error('harga') is-invalid @enderror" oninput="formatRupiah(this)" style="width: 50%;">
                @error('harga')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                <a href="/tabelbarang"><button type="button" class="btn btn-secondary">KEMBALI</button></a>
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
            let hargaInput = document.getElementById('harga');
            unformatRupiah(hargaInput); // Clean formatting before form submission
        });
    </script>
</body>

</html>