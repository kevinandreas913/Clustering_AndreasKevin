@include('template.header')
</head>

<body>
    @if(session('berhasil'))
    <div class="alert alert-success">
        <h3>{{ session('berhasil') }}</h3>
    </div>
    @endif

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="py-4">
                        <h1 class="text-center" style="font-weight: bold; font-size: 3rem; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            Tabel Toko
                        </h1>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="button"><a href="/toko" style="color: white">Tambah</a></button>
                            <button class="btn btn-primary me-md-2" type="button"><a href="/kalkulasi" style="color: white">Hitung</a></button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Kode Toko</th>
                            <th>Nama Toko</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Kesepakatan</th>
                            <th>Lokasi</th>
                            <th>Pelayanan</th>
                            <th>Persetujuan Penitipan</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stores as $toko)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <th>{{$toko->kode_toko}}</th>
                            <th>{{$toko->nama_toko}}</th>
                            <th>{{$toko->alamat}}</th>
                            <th>{{$toko->nomor_telepon}}</th>
                            <th>{{$toko->kesepakatan}}</th>
                            <th>{{$toko->lokasi}}</th>
                            <th>{{$toko->pelayanan}}</th>
                            <th>{{$toko->hasil}}</th>
                            <th>
                                <a href="{{ route('view.showtoko', ['toko'=> $toko->id]) }}"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('edit.edittoko', ['toko'=> $toko->id]) }}"><i class="bi bi-pen-fill"></i></a>

                                <!-- bagian ini adalah delete -->
                                <a onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('hapus_{{$toko->id}}').submit();" href="#">
                                    <i class="bi bi-trash"></i>
                                </a>

                                <form id="hapus_{{$toko->id}}" action="{{ route('hapustoko.destroy', ['toko' => $toko->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <!-- bagian ini adalah delete -->

                            </th>
                        </tr>
                        @empty
                        <td colspan="12" class="text-center">Tidak Ada Data...</td>
                        @endforelse
                    </tbody>

                </table>
                <div class="d-flex justify-content-end mb-3">
                    <!-- kembali -->
                    <a href="/dashboard"><button type="button" class="btn btn-secondary btn-md">Kembali</button></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>