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
                            Tabel Barang
                        </h1>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="button"><a href="/barang" style="color: white">Tambah</a></button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Produk</th>
                            <th>Rincian Produk</th>
                            <th>Harga</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $produk)
                        <tr>
                            <th class="text-center">{{$loop->iteration}}</th>
                            <th>{{$produk->kode_barang}}</th>
                            <th>{{$produk->nama}}</th>
                            <th>{{$produk->deskripsi}}</th>
                            <th>{{'Rp' . number_format($produk->harga, 0, ',', '.')}}</th>
                            <th>
                                <a href="{{ route('view.showbarang', ['barang'=> $produk->id]) }}"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('edit.editbarang', ['barang'=> $produk->id]) }}"><i class="bi bi-pen-fill"></i></a>
                                <!-- bagian ini adalah delete -->
                                <a onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('hapus_{{$produk->id}}').submit();" href="#">
                                    <i class="bi bi-trash"></i>
                                </a>

                                <form id="hapus_{{$produk->id}}" action="{{ url('/baranghapus/'.$produk->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <!-- bagian ini adalah delete -->
                            </th>
                        </tr>
                        @empty
                        <td colspan="6" class="text-center">Tidak Ada Data...</td>
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