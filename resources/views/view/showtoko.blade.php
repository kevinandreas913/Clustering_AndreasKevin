@include('template.header')
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">

                <div class="pt-3 text-center">
                    <h1 class="h2">Toko {{$stores->nama_toko}}</h1>
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <!-- hapus -->
                    <button onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('hapus').submit();" type="submit" class="btn btn-primary btn-md me-2" href="/tabeltoko">
                        Hapus </button>

                    <form id="hapus" action="{{ route('hapustoko.destroy', ['toko' => $stores->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <!-- hapus -->
                    <!-- edit -->
                    <a href="{{ route('edit.edittoko', ['toko'=> $stores->id]) }}" class="btn btn-primary btn-md me-2">Edit</a>
                </div>
                <hr>
                @if(session()->has('pesan'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('pesan')}}
                </div>
                @endif
                <h2>
                    <ul>
                        <li>Kode Toko: {{$stores->kode_toko}}</li>
                        <li>Nama Toko: {{$stores->nama_toko}}</li>
                        <li>Alamat: {{$stores->alamat}}</li>
                        <li>Nomor Telepon: {{$stores->nomor_telepon}}</li>
                    </ul>
                </h2>
                <div class="d-flex justify-content-end mb-3">
                    <!-- kembali -->
                    <a href="/tabeltoko"><button type="button" class="btn btn-secondary btn-md">Kembali</button></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>