@include('template.header')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <th>Nama Barang</th>
                    <th>Harga Per Unit</th>
                    <th>Banyak Terjual</th>
                    <th>Durasi Penjualan (Hari)</th>
                    <th>Hasil Clustering</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $item)
                <tr>
                    <td>{{ $item['nama_produk'] }}</td>
                    <td>{{'Rp' . number_format($item['harga_unit'], 0, ',', '.')}}</td>
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

        <div class="mt-4">
            <br>
            @if(isset($nlgDeskripsiBarang) && count($nlgDeskripsiBarang) > 0)
            @foreach ($nlgDeskripsiBarang as $deskripsi)
            <h5>{!! $deskripsi !!}</h5>
            <br>
            @endforeach
            @endif
        </div>

        <!-- <div class="mt-4">
            <div id="data-container" data-labels="{{ implode(',', array_column($result ?? [], 'nama_produk')) }}" data-banyak-terjual="{{ implode(',', array_column($result ?? [], 'banyak_terjual')) }}" data-harga-unit="{{ implode(',', array_column($result ?? [], 'harga_unit')) }}" data-durasi-penjualan="{{ implode(',', array_column($result ?? [], 'durasi_penjualan')) }}" data-cluster="{{ implode(',', array_column($result ?? [], 'cluster')) }}">
            </div>

            <canvas id="clusteringChart"></canvas>
        </div> -->

        <div class="d-flex justify-content-end mb-3">
            <!-- kembali -->
            <a href="/tabelsale"><button type="button" class="btn btn-secondary btn-md">Kembali</button></a>
        </div>
    </div>


</body>

</html>