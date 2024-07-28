 @include('template.header')
 </head>

    <body>
        @if(session('berhasil'))
        <div class="alert alert-success">
            <h3>{{ session('berhasil') }}</h3>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <h3>{{ session('error') }}</h3>
        </div>
        @endif

        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="py-4">
                            <h2>Tabel Toko</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary me-md-2" type="button"><a href="/sale" style="color: white">Tambah</a></button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#clusteringModaltoko">
                                    Mulai Clustering Toko
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#clusteringModalbarang">
                                    Mulai Clustering Barang
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Nama Toko</th>
                                <th>Banyak Terjual</th>
                                <th>Harga Per Unit</th>
                                <th>Durasi Penjualan</th>
                                <th>Bulan Periode</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <th>{{$sale->product->nama}}</th>
                                <th>{{$sale->store->nama_toko}}</th>
                                <th>{{$sale->banyak_terjual}}</th>
                                <th>{{'Rp' . number_format($sale->harga_unit, 0, ',', '.')}}</th>
                                <th>{{$sale->durasi_penjualan}}</th>
                                <th>{{ \Carbon\Carbon::parse($sale->bulan_periode)->format('F Y') }}</th>
                                <th>
                                    <a href="{{ route('view.showsale', ['sale'=> $sale->id]) }}"><i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('edit.editsale', ['sale'=> $sale->id]) }}"><i class="bi bi-pen-fill"></i></a>

                                    <!-- bagian ini adalah delete -->
                                    <a onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('hapus_{{$sale->id}}').submit();" href="#">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <form id="hapus_{{$sale->id}}" action="{{ route('hapussale.destroy', ['sale' => $sale->id]) }}" method="POST" style="display: none;">
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
                        <a href="/"><button type="button" class="btn btn-secondary btn-md">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal toko -->
        <div class="modal fade" id="clusteringModaltoko" tabindex="-1" aria-labelledby="clusteringModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clusteringModalLabel">Masukkan Bulan Periode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('clustering.toko') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="bulan_periode" class="form-label">Bulan Periode</label>
                                <input type="month" name="bulan_periode" id="bulan_periode" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Mulai Clustering Toko</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal barang -->
        <div class="modal fade" id="clusteringModalbarang" tabindex="-1" aria-labelledby="clusteringModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clusteringModalLabel">Masukkan Bulan Periode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('clustering.barang') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="bulan_periode" class="form-label">Bulan Periode</label>
                                <input type="month" name="bulan_periode" id="bulan_periode" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Mulai Clustering Barang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fungsi untuk mendapatkan nilai parameter query dari URL
                function getQueryParam(param) {
                    const urlParams = new URLSearchParams(window.location.search);
                    return urlParams.get(param);
                }

                // Ambil parameter 'modal' dari URL
                const modalId = getQueryParam('modal');

                // Jika parameter modal ada, tampilkan modal yang sesuai
                if (modalId) {
                    const modal = document.querySelector(`#${modalId}`);
                    if (modal) {
                        const bootstrapModal = new bootstrap.Modal(modal);
                        bootstrapModal.show();
                    }
                }
            });
        </script>

    </body>


 </html>