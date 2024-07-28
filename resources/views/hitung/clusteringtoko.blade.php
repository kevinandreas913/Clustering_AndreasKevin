@include('template.header')
</head>

<body>
    <div class="container">
        <div class="mb-5">
            <h1>Hasil Clustering {{ $type }}</h1>
        </div>
        @if(isset($result) && count($result) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Toko</th>
                    <th>Banyak Terjual</th>
                    <th>Durasi Penjualan (Hari)</th>
                    <th>Hasil Clustering</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $item)
                <tr>
                    <td>{{ $item['nama_toko'] }}</td>
                    <td>{{ $item['banyak_terjual'] }}</td>
                    <td>{{ $item['durasi_penjualan'] }}</td>
                    <td>{{ $item['cluster'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Tidak ada hasil clustering.</p>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <!-- kembali -->
            <a href="/tabelsale"><button type="button" class="btn btn-secondary btn-md">Kembali</button></a>
        </div>
    </div>
</body>

</html>