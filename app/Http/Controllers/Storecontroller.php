<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\sales;
use App\Models\stores;
use Illuminate\Support\Facades\Log;

class Storecontroller extends Controller
{
    //form
    public function formtoko(){
        $backgroundImage = '/assets/img/backformtoko.jpg';
        return view('/form/formtoko', [
            'backgroundImage' => $backgroundImage,
        ]);
    }
    public function tokostore(Request $request)
    {
        $validatedata =
            $request->validate([
                'kode_toko' => 'required|min:3|max:6|unique:stores',
                'nama_toko' => 'required',
                'alamat' => '',
                'nomor_telepon' => '',
                'kesepakatan' => 'required|numeric|min:0|max:5',
                'lokasi' => 'required|numeric|min:0|max:5',
                'pelayanan' => 'required|numeric|min:0|max:5',
                'hasil' => 'required'
            ]);

        stores::create($validatedata);
        return redirect('/toko')->with('berhasil', 'Data berhasil tersimpan');
    }

    // view
    public function tabeltoko()
    {
        $backgroundImage = '/assets/img/backtabeltoko.jpg';
        $stores = stores::all(); // Mengambil semua data toko dari database
        return view('table.tabeltoko', compact('stores'), compact('backgroundImage')); // Mengirim data toko ke view
    }
    public function showtoko(stores $toko)
    {
        $backgroundImage = '/assets/img/backtabeltoko.jpg';
        return view('/view/showtoko', [
            'backgroundImage' => $backgroundImage,
            'stores' => $toko
        ]);
    }

    // update
    public function updatetoko(stores $toko)
    {
        $backgroundImage = '/assets/img/backformtoko.jpg';
        return view('edit.edittoko', [
            'backgroundImage' => $backgroundImage,
            'stores' => $toko
        ]);
    }

    public function updatestoko(Request $request, stores $toko)
    {
        $validatedata = $request->validate([
            'kode_toko' => 'required|min:3|max:6|unique:stores,kode_toko,' . $toko->id,
            'nama_toko' => 'required',
            'alamat' => '',
            'nomor_telepon' => '',
            'kesepakatan' => 'required|numeric|min:0|max:5',
            'lokasi' => 'required|numeric|min:0|max:5',
            'pelayanan' => 'required|numeric|min:0|max:5',
            'hasil' => 'required'
        ]);

        stores::where('id', $toko->id)->update($validatedata);
        return redirect()->route('table.tabeltoko', ['stores' => $toko->id])->with('berhasil', "Update data {$validatedata['nama_toko']} berhasil");
    }

    // hapus
    public function destroytoko($id)
    {
        $stores = Stores::findOrFail($id);
        $storesnama = $stores->nama_toko; // Simpan nama toko sebelum dihapus
        $stores->delete();

        return redirect()->route('table.tabeltoko')->with('berhasil', "Hapus data $storesnama berhasil");
    }

    // // kalkulasi
    // public function kalkulasi()
    // {
    //     $backgroundImage = '/assets/img/backformtoko.jpg';
    //     return view('/hitung/formhitung', [
    //         'backgroundImage' => $backgroundImage,
    //     ]);
    // }

    // public function startkalkulasi(Request $request)
    // {
    //     // Validasi input dari form
    //     $validatedata = $request->validate([
    //         'kesepakatan' => 'required|numeric|min:0|max:5',
    //         'lokasi' => 'required|numeric|min:0|max:5',
    //         'pelayanan' => 'required|numeric|min:0|max:5'
    //     ]);


    //     // Ambil semua data dari database
    //     $stores = stores::all();

    //     // Format data untuk decision tree
    //     // $data = [];
    //     // $labels = [];
    //     // foreach ($stores as $store) {
    //     //     $data[] = [$store->kesepakatan, $store->lokasi, $store->pelayanan];
    //     //     $labels[] = $store->hasil;
    //     // }
    //     $data = [];
    //     $labels = [];
    //     foreach ($stores as $store) {
    //         $data[] = [(float) $store->kesepakatan, (float) $store->lokasi, (float) $store->pelayanan]; // Menggunakan (float) untuk memastikan nilai float
    //         $labels[] = $store->hasil;
    //     }
    //     $validatedata = [
    //         'kesepakatan' => (int) $request->kesepakatan,
    //         'lokasi' => (int) $request->lokasi,
    //         'pelayanan' => (int) $request->pelayanan
    //     ];


    //     // Path ke script Python dan interpreter Python
    //     $pythonScript = base_path('resources/views/algoritma/decisiontree.py');
    //     $pythonPath = 'C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python311\\python.exe';

    //     // Menjalankan script Python dengan input data yang diperlukan
    //     $command = "$pythonPath $pythonScript " . escapeshellarg(json_encode($data)) . " " . escapeshellarg(json_encode($labels)) . " " . escapeshellarg(json_encode($validatedata));
    //     $output = shell_exec($command . ' 2>&1'); // Capture standard error output


    //     // Log the command and output for debugging
    //     Log::info("Executing command: $command");
    //     Log::info("Output: $output");

    //     // Menangani output dari script Python
    //     $prediction = trim($output);

    //     // Kembali ke view dengan hasil prediksi
    //     return view('/hitung/formhitung', [
    //         'backgroundImage' => '/assets/img/backformtoko.jpg',
    //         'prediction' => $prediction
    //     ]);
    // }

    public function kalkulasi()
    {
        $backgroundImage = '/assets/img/backformtoko.jpg';
        return view('/hitung/formhitung', [
            'backgroundImage' => $backgroundImage,
        ]);
    }

    public function startkalkulasi(Request $request)
    {
        // Validasi input dari form
        $validatedata = $request->validate([
            'kesepakatan' => 'required|numeric|min:1|max:5',
            'lokasi' => 'required|numeric|min:1|max:5',
            'pelayanan' => 'required|numeric|min:1|max:5'
        ]);

        // Ambil semua data dari database
        $stores = Stores::all();

        // Format data untuk decision tree
        $data = [];
        $labels = [];
        foreach ($stores as $store) {
            $data[] = [(float) $store->kesepakatan, (float) $store->lokasi, (float) $store->pelayanan];
            $labels[] = $store->hasil;
        }

        if (count($data) < 5 || count($labels) < 5) {
            return redirect()->back()->with('error', 'Input minimal 5 data terlebih dahulu');
        }

        // Data instance yang akan diprediksi
        $instance = [
            'kesepakatan' => (float) $request->kesepakatan,
            'lokasi' => (float) $request->lokasi,
            'pelayanan' => (float) $request->pelayanan
        ];

        // Path ke script PHP decisiontree.php
        $phpScript = base_path('resources/views/algoritma/decisiontree.php');

        // Include script PHP untuk menggunakan fungsi dari decision tree
        require_once $phpScript;

        // Jalankan algoritma decision tree
        $tree = build_tree($data, $labels, ['kesepakatan', 'lokasi', 'pelayanan']);
        $prediction = predict($tree, $instance);

        // Simpan gambar tree
        // $treeImage = $this->save_tree_image($tree);

        // Kembali ke view dengan hasil prediksi
        return view('/hitung/formhitung', [
            'backgroundImage' => '/assets/img/backformtoko.jpg',
            'prediction' => $prediction
        ]);
    }

}
