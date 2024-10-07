@include('template.header')
<link rel="stylesheet" href="{{ asset('css/formtoko.css') }}">
</head>

<body>
    <div class="container col-lg-6">
        <div class="text-center">
            <h1>Edit Toko</h1>
        </div>
        <div class=""></div>
        <form action="{{ url('/updatetoko/'.$stores->id) }}" method="post">
            @method('PUT')
            @csrf
            <!-- kode toko -->
            <div class="form-group mb-3">
                <label for="jenis-transaksi">Kode Toko:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#Jenistoko">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="Jenistoko" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Kode Toko:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan kode toko anda minimal 3 karakter, maksimal 6 karakter!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="text" id="kode_toko" name="kode_toko" value="{{ old('kode_toko') ?? $stores->kode_toko}}" placeholder="Mimimal 3, maksimal 6 karakter" class="form-control @error('kode_toko') is-invalid @enderror" style="width: 50%;">
                @error('kode_toko')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- nama toko -->
            <div class="form-group mb-3">
                <label for="jenis-transaksi">Nama Toko:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#Namatoko">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="Namatoko" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nama Toko:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan nama toko anda!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="nama_toko" name="nama_toko" value="{{ old('nama_toko') ?? $stores->nama_toko}}" placeholder="Masukkan nama toko!" class="form-control @error('nama_toko') is-invalid @enderror" style="width: 80%;">
                @error('nama_toko')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- alamat -->
            <div class="form-group mb-3">
                <label for="alamat">Alamat:</label>
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
                                <p>Inputan alamat toko</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat toko tersebut!" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') ?? $stores->alamat}}</textarea>
                @error('alamat')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- nomor telepon  -->
            <div class="form-group mb-3">
                <label for="nomortelepon">Nomor Telepon:</label>
                <button type="button" class="btn" style="padding: 0.1rem 0.1rem; font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#nomortelepon">
                    <i class="bi bi-info-circle"></i>
                </button>
                <div class="modal fade" id="nomortelepon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Nomor Telepon</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Inputan nomor telepon toko</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="number" id="nomortelepon" name="nomortelepon" value="{{ old('nomor_telepon') ?? $stores->nomor_telepon}}" placeholder="Masukkan nomor telepon disini!" class="form-control @error('nomor_telepon') is-invalid @enderror" style="width: 80%;">
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