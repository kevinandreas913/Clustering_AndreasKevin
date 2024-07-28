@include('template.header')
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">

                <div class="pt-3 text-center">
                    <h1 class="h2">Barang {{$products->nama}}</h1>
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <!-- hapus -->
                    <button onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('hapus').submit();" type="submit" class="btn btn-primary btn-md me-2">Hapus</button>
                    <form id="hapus" action="{{ url('/baranghapus/'.$products->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <!-- edit -->
                    <a href="{{ route('edit.editbarang', ['barang'=> $products->id]) }}" class="btn btn-primary btn-md me-2">Edit</a>
                </div>
                <hr>
                @if(session()->has('pesan'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('pesan')}}
                </div>
                @endif
                <h2>
                    <ul>
                        <li>Kode Barang: {{$products->kode_barang}}</li>
                        <li>Nama: {{$products->nama}}</li>
                        <li>Deskripsi: {{$products->deskripsi}}</li>
                        <li>Harga Barang: {{'Rp' . number_format($products->harga, 0, ',', '.')}}</li>
                    </ul>
                </h2>
                <div class="d-flex justify-content-end mb-3">
                    <!-- kembali -->
                    <a href="/tabelbarang"><button type="button" class="btn btn-secondary btn-md">Kembali</button></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>