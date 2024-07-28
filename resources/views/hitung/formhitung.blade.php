@include('template.header')

</head>

<body>
    <div class="container col-lg-6">
        <div class="text-center">
            <h1>Form Analisis Toko</h1>
        </div>

        <form id="form-barang" action="{{ route('toko.kalkulasi') }}" method="POST">
            @csrf

            <!-- kesepakatan -->
            <div class="form-group mb-3">
                <label for="kesepakatan">Kesepakatan:</label>
                <div class="rating">
                    @for($i = 1; $i <= 5; $i++) <input type="radio" id="kesepakatan{{ $i }}" name="kesepakatan" value="{{ $i }}" @if(old('kesepakatan')==$i) checked @endif>
                        <label for="kesepakatan{{ $i }}"></label>
                        @endfor
                </div>
                @error('kesepakatan')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- lokasi -->
            <div class="form-group mb-3">
                <label for="lokasi">Lokasi:</label>
                <div class="rating">
                    @for($i = 1; $i <= 5; $i++) <input type="radio" id="lokasi{{ $i }}" name="lokasi" value="{{ $i }}" @if(old('lokasi')==$i) checked @endif>
                        <label for="lokasi{{ $i }}"></label>
                        @endfor
                </div>
                @error('lokasi')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- pelayanan -->
            <div class="form-group mb-3">
                <label for="pelayanan">Pelayanan:</label>
                <div class="rating">
                    @for($i = 1; $i <= 5; $i++) <input type="radio" id="pelayanan{{ $i }}" name="pelayanan" value="{{ $i }}" @if(old('pelayanan')==$i) checked @endif>
                        <label for="pelayanan{{ $i }}"></label>
                        @endfor
                </div>
                @error('pelayanan')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>

            <!-- hitung button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Hitung</button>
                <a href="/tabeltoko"><button type="button" class="btn btn-secondary">KEMBALI</button></a>
            </div>

            <!-- hasil -->
            @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
            @endif
            
            @if(isset($prediction))
            <div class="form-group mt-3">
                <label for="hasil">Hasil:</label>
                <input type="text" id="hasil" name="hasil" value="{{ $prediction }}" class="form-control" readonly>
            </div>
            @endif

            <!-- tree image -->
            <!-- @if(isset($treeImage))
            <div class="form-group mt-3">
                <label for="tree_image">Decision Tree:</label>
                <img src="{{ $treeImage }}" alt="Decision Tree" class="img-fluid">
            </div>
            @endif -->
        </form>
    </div>

</body>