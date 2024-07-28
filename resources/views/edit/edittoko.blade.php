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
                                <p>Inputan kode toko anda!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="text" id="kode_toko" name="kode_toko" value="{{ old('kode_toko') ?? $stores->kode_toko}}" placeholder="Masukkan kode barang!" class="form-control @error('kode_toko') is-invalid @enderror">
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
                <input type="text" id="nama_toko" name="nama_toko" value="{{ old('nama_toko') ?? $stores->nama_toko}}" placeholder="Masukkan nama toko!" class="form-control @error('nama_toko') is-invalid @enderror">
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
                <input type="text" id="nomortelepon" name="nomortelepon" value="{{ old('nomor_telepon') ?? $stores->nomor_telepon}}" placeholder="Masukkan nomor telepon disini!" class="form-control @error('nomor_telepon') is-invalid @enderror">{{ old('nomor_telepon') ?? $stores->nomor_telepon}}</input>
                @error('nomor_telepon')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- kesepakatan -->
            <div class="form-group mb-3">
                <label for="kesepakatan">Kesepakatan:</label>
                <div class="rating">
                    @for($i = 1; $i <= 5; $i++) <input type="radio" id="kesepakatan{{ $i }}" name="kesepakatan" value="{{ $i }}" @if(old('kesepakatan')==$i || $stores->kesepakatan == $i) checked @endif>
                        <label for="kesepakatan{{ $i }}"></label>
                        @endfor
                </div>
                @error('kesepakatan')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- lokasi -->
            <div class="form-group mb-3">
                <label for="lokasi">Lokasi:</label>
                <div class="rating">
                    @for($i = 1; $i <= 5; $i++) <input type="radio" id="lokasi{{ $i }}" name="lokasi" value="{{ $i }}" @if(old('lokasi')==$i || $stores->lokasi == $i) checked @endif>
                        <label for="lokasi{{ $i }}"></label>
                        @endfor
                </div>
                @error('lokasi')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- pelayanan -->
            <div class="form-group mb-3">
                <label for="pelayanan">Pelayanan:</label>
                <div class="rating">
                    @for($i = 1; $i <= 5; $i++) <input type="radio" id="pelayanan{{ $i }}" name="pelayanan" value="{{ $i }}" @if(old('pelayanan')==$i || $stores->pelayanan == $i) checked @endif>
                        <label for="pelayanan{{ $i }}"></label>
                        @endfor
                </div>
                @error('pelayanan')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- hasil -->
            <div class="form-group mb-3">
                <label for="hasil">Hasil:</label>
                <select id="hasil" name="hasil" class="form-control @error('hasil') is-invalid @enderror">
                    <option value="Ya" @if(old('hasil')==1) selected @endif>Ya</option>
                    <option value="Tidak" @if(old('hasil')==0) selected @endif>Tidak</option>
                </select>
                @error('hasil')
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