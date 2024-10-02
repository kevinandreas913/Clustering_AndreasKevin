 @include('template.header')
 <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"> -->
 <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
 <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
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
                         <h1 class="text-center" style="font-weight: bold; font-size: 3rem; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                             Tabel Penjualan
                         </h1>
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
                 <div class="table-responsive">
                     <table class="table table-striped" id="sales-table">
                         <thead>
                             <tr>
                                 <div class="d-flex">
                                     <h3>Filter Bulan Disini!</h3>
                                 </div>
                             </tr>
                             <tr>
                                 <div>
                                     <input type="month" id="filter_bulan_periode" class="form-control mt-2" style="width: 150px;" value="{{ request('filter_bulan_periode') }}">
                                 </div>
                             </tr>
                             <br>
                             <tr class="text-center">
                                 <th>#</th>
                                 <th>Nama Produk</th>
                                 <th>Nama Toko</th>
                                 <th>Banyak Terjual</th>
                                 <th>Harga Per Unit</th>
                                 <th>Durasi Penjualan</th>
                                 <th>
                                     Bulan Periode
                                 </th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>

                         </tbody>

                     </table>
                 </div>
                 <tr>
                     <br>
                     <div class="d-flex justify-content-end mb-3">
                         <!-- kembali -->
                         <a href="/dashboard"><button type="button" class="btn btn-secondary btn-md">Kembali</button></a>
                     </div>
                 </tr>
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

     <!-- <script>
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

         document.getElementById('filter_bulan_periode').addEventListener('change', function() {
             const selectedMonth = this.value; // Ambil nilai bulan yang dipilih
             const currentUrl = new URL(window.location.href); // Ambil URL saat ini
             currentUrl.searchParams.set('filter_bulan_periode', selectedMonth); // Set query parameter
             window.location.href = currentUrl.href; // Redirect dengan parameter baru
         });
     </script> -->

     <script>
         function getFilterBulan() {
             return $('#filter_bulan_periode').val();
         }
         // Inisialisasi DataTable
         const table = $('#sales-table').DataTable({
             processing: true,
             serverSide: true,
             responsive: true,
             ajax: {
                 url: "{{ route('table.tabelsale') }}",
                 data: function(d) {
                     d.filter_bulan_periode = getFilterBulan();
                 }
             },
             columns: [
                {
                     data: 'DT_RowIndex',
                     name: 'DT_RowIndex',
                     orderable: false,
                     searchable: false
                 },
                 {
                     data: 'product.nama',
                     name: 'product.nama'
                 },
                 {
                     data: 'store.nama_toko',
                     name: 'store.nama_toko'
                 },
                 {
                     data: 'banyak_terjual',
                     name: 'banyak_terjual'
                 },
                 {
                     data: 'harga_unit',
                     name: 'harga_unit',
                     render: function(data, type, row) {
                         return 'Rp' + parseInt(data).toLocaleString('id-ID');
                     }
                 },
                 {
                     data: 'durasi_penjualan',
                     name: 'durasi_penjualan'
                 },
                 {
                     data: 'bulan_periode',
                     name: 'bulan_periode',
                     render: function(data, type, row) {
                         return moment(data).format('MMMM YYYY');
                     }
                 },
                 {
                     data: 'action',
                     name: 'action',
                     orderable: false,
                     searchable: false
                 },
             ],
             order: [
                 [0, 'desc']
             ],

         });

         // Event listener untuk filter bulan
         $('#filter_bulan_periode').change(function() {
             table.ajax.reload();
         });

         $(document).ready(function() {
            table();
         });
     </script>

     <script>
         function deleteSale(id) {
             if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                 // Buat formulir secara dinamis
                 var form = document.createElement('form');
                 form.method = 'POST';
                 form.action = '/salehapus/' + id;

                 // Tambahkan input untuk method DELETE
                 var methodInput = document.createElement('input');
                 methodInput.type = 'hidden';
                 methodInput.name = '_method';
                 methodInput.value = 'DELETE';
                 form.appendChild(methodInput);

                 // Tambahkan input untuk CSRF token
                 var csrfInput = document.createElement('input');
                 csrfInput.type = 'hidden';
                 csrfInput.name = '_token';
                 csrfInput.value = '{{ csrf_token() }}';
                 form.appendChild(csrfInput);

                 // Tambahkan formulir ke body dan kirim
                 document.body.appendChild(form);
                 form.submit();
             }
         }
     </script>

     <script>
         document.addEventListener('DOMContentLoaded', function() {
             // Mendapatkan URL query parameter
             const params = new URLSearchParams(window.location.search);
             const modal = params.get('modal'); // Mengambil nilai modal dari query parameter

             // Cek jika ada nilai modal di URL
             if (modal) {
                 // Pilih modal yang sesuai berdasarkan query parameter
                 const modalElement = document.getElementById(modal);

                 // Jika elemen modal ditemukan, buka modal
                 if (modalElement) {
                     const bootstrapModal = new bootstrap.Modal(modalElement);
                     bootstrapModal.show(); // Buka modal sesuai dengan target
                 }
             }
         });
     </script>
     <!-- Pastikan Anda sudah menyertakan moment.js untuk format tanggal -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
 </body>


 </html>