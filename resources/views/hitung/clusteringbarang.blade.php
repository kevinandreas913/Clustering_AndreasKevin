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

        <div class="container mt-5">
            <h3>Tanya AI</h3>
            <form id="aiForm">
                <div class="mb-3">
                    <label for="question" class="form-label">Masukkan Pertanyaan Anda:</label>
                    <input type="text" class="form-control" id="question" placeholder="Ketik pertanyaan Anda di sini">
                </div>
                <button type="submit" class="btn btn-primary">Tanya AI</button>
            </form>
            <div id="aiResponse" class="mt-3"></div>
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

    <script>
        document.getElementById('aiForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let question = document.getElementById('question').value;

            fetch('{{ route('
                    ask.ai ') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            question: question
                        })
                    })
                .then(response => response.json())
                .then(data => {
                    let answer = data.choices[0].message.content;
                    document.getElementById('aiResponse').innerText = answer;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>


    <!-- <script>
        // Ambil data dari elemen HTML
        var dataContainer = document.getElementById('data-container');

        function stringToArray(str) {
            return str.split(',').map(function(item) {
                return item.trim();
            });
        }

        var banyakTerjualData = stringToArray(dataContainer.getAttribute('data-banyak-terjual')).map(Number);
        var hargaUnitData = stringToArray(dataContainer.getAttribute('data-harga-unit')).map(Number);
        var durasiPenjualanData = stringToArray(dataContainer.getAttribute('data-durasi-penjualan')).map(Number);
        var clusterLabels = stringToArray(dataContainer.getAttribute('data-cluster'));

        var ctx = document.getElementById('clusteringChart').getContext('2d');

        // Data untuk scatter plot
        var scatterData = [];
        var clusterColors = {
            'Produk Laku': 'rgba(54, 162, 235, 0.6)',
            'Produk Kurang Laku': 'rgba(255, 206, 86, 0.6)'
        };

        for (var i = 0; i < banyakTerjualData.length; i++) {
            scatterData.push({
                x: hargaUnitData[i],
                y: banyakTerjualData[i],
                r: 100, // radius titik
                backgroundColor: clusterColors[clusterLabels[i]] || 'rgba(75, 192, 192, 0.6)'
            });
        }

        // Grafik dengan Chart.js
        var clusteringChart = new Chart(ctx, {
            type: 'scatter', // tipe grafik scatter
            data: {
                datasets: [{
                    label: 'Clustering',
                    data: scatterData,
                    backgroundColor: scatterData.map(function(dataPoint) {
                        return dataPoint.backgroundColor;
                    })
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Harga Per Unit'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Banyak Terjual'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Hasil Clustering {{ $type }}'
                    }
                }
            }
        });
    </script> -->


</body>

</html>