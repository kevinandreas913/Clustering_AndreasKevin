@include('template.header')
</head>

<body>
    <div class="container">
        <form method="GET" action="{{ url('/analisa') }}">
            <div class="form-group">
                <h2><label for="bulan">Pilih Bulan:</label></h2>
                <input type="month" id="bulan" name="bulan" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Tampilkan Data</button>
        </form>


        @if(isset($salesData))
        <div class="row">
            @foreach ($salesData as $storeName => $data)
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="chart{{ $storeName }}"></canvas>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <br>
        <div class="d-flex justify-content-end mb-3">
            <!-- kembali -->
            <a href="/dashboard"><button type="button" class="btn btn-secondary btn-md">Halaman Utama</button></a>
        </div>
    </div>

    <style>
        .chart-container {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if(isset($salesData))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var salesData = @json($salesData);

            // Fungsi untuk membuat chart
            function createChart(ctx, data, label) {
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            data: data.values,
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 14 // Memperbesar ukuran font legenda
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: label,
                                font: {
                                    size: 18 // Memperbesar ukuran font judul
                                }
                            }
                        }
                    }
                });
            }

            // Membuat chart untuk masing-masing toko
            Object.keys(salesData).forEach(function(storeName) {
                var ctx = document.getElementById('chart' + storeName).getContext('2d');
                var data = salesData[storeName];
                createChart(ctx, data, 'Penjualan ' + storeName);
            });
        });
    </script>
    @endif


</body>

</html>