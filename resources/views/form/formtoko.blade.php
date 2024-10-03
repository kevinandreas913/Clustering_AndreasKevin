@include('template.header')
<link rel="stylesheet" href="{{ asset('css/formtoko.css') }}">
</head>

<body>
    @if(session('berhasil'))
    <div class="alert alert-success">
        <h3> {{ session('berhasil') }}</h3>
    </div>
    @endif

    <div class="container col-lg-6">
        <div class="text-center">
            <h1>Form Toko</h1>
        </div>
        <div class=""></div>
        <form id="form-barang" action="{{ route('toko.store') }}" method="POST">
            @csrf
            <!-- kode toko -->
            <div class="form-group mb-3">
                <label for="jenis-transaksi">Kode Toko:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#kode_toko">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="kode_toko" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Kode Toko:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan kode toko!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="kode_toko" name="kode_toko" value="{{ old('kode_toko') }}" placeholder="Masukkan  kode toko!" class="form-control @error('kode_toko') is-invalid @enderror">
                @error('kode_toko')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- nama toko -->
            <div class="form-group mb-3">
                <label for="jenis-transaksi">Nama Toko:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#nama_toko">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="nama_toko" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nama Toko:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan nama toko!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="nama_toko" name="nama_toko" value="{{ old('nama_toko') }}" placeholder="Masukkan nama toko!" class="form-control @error('nama_toko') is-invalid @enderror">
                @error('nama_toko')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- alamat -->
            <div class="form-group mb-3">
                <label for="keterangan">Alamat:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#alamat">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Alamat</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan alamat toko!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea id="alamat" name="alamat" placeholder="Masukkan rincian alamat toko!" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                @error('alamat')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- nomor telepon  -->
            <div class="form-group mb-3">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#nomor_telepon">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="nomor_telepon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nominal</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan nomor telepon toko!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="number" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Masukkan nomor telepon disini!" class="form-control @error('nomor_telepon') is-invalid @enderror">
                @error('nomor_telepon')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                <a href="/tabeltoko"><button type="button" class="btn btn-secondary">KEMBALI</button></a>
            </div>
        </form>
    </div>

</body>

</html>