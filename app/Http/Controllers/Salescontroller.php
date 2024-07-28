<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\sales;
use App\Models\stores;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class Salescontroller extends Controller
{
    // form
    public function formsale()
    {
        $products = products::all();
        $stores = stores::all();
        

        $backgroundImage = '/assets/img/backformsale.jpg';
        return view('/form/formsale', compact('products', 'stores', 'backgroundImage'));
    }

    public function salestore(Request $request)
    {
        $validatedata = $request->validate([
            'product_id' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
            'banyak_terjual' => 'required|integer|min:1',
            'harga_unit' => 'required|numeric|min:0',
            'durasi_penjualan' => 'nullable|integer|min:0',
            'bulan_periode' => 'required|date_format:Y-m',
        ]);

        // Ubah bulan_periode menjadi format YYYY-MM-DD dengan hari default 01
        $validatedata['bulan_periode'] = $validatedata['bulan_periode'] . '-01';
        $validatedata['uuid'] = Str::uuid(); // Generate UUID

        Sales::create($validatedata);
        return redirect('/sale')->with('berhasil', 'Data berhasil tersimpan');
    }

    // view
    public function tabelsale()
    {
        $backgroundImage = '/assets/img/salesback.png';
        $sales = Sales::with(['product', 'store'])->get(); // Mengambil semua data sales dari database beserta relasi

        return view('table.tabelsale', compact('sales', 'backgroundImage')); // Mengirim data toko ke view
    }
    
    public function showsale(sales $sale)
    {
        $backgroundImage = '/assets/img/salesback.png';
        return view('/view/showsale', [
            'backgroundImage' => $backgroundImage,
            'sales' => $sale
        ]);
    }

    // update
    public function updatesale(sales $sale)
    {
        $products = Products::all();
        $stores = Stores::all();
        $backgroundImage = '/assets/img/backformsale.jpg';

        return view('edit.editsale',[
            'sales' => $sale,
            'products' => $products,
            'stores' => $stores,
            'backgroundImage' => $backgroundImage
        ]);
    }

    public function updatessale(Request $request, $uuid)
    {
        $validatedata = $request->validate([
            'product_id' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
            'banyak_terjual' => 'required|integer|min:1',
            'harga_unit' => 'required|numeric|min:0',
            'durasi_penjualan' => 'nullable|integer|min:0',
            'bulan_periode' => 'required|date_format:Y-m',
        ]);

        $validatedata['bulan_periode'] = $validatedata['bulan_periode'] . '-01';

        $sale = Sales::where('uuid', $uuid)->firstOrFail();
        $sale->update($validatedata);

        return redirect()->route('table.tabelsale')->with('berhasil', "Update data berhasil");
    }


    // hapus
    public function destroysale($id)
    {
        $sales = sales::findOrFail($id);
        $sales->delete();
        return redirect()->route('table.tabelsale')->with('berhasil', "Data berhasil dihapus");
    }

    // clustering toko
    public function startClusteringToko(Request $request)
    {
        $request->validate([
            'bulan_periode' => 'required|date_format:Y-m'
        ]);

        $bulan_periode = $request->input('bulan_periode') . '-01';

        $phpScript = base_path('resources/views/algoritma/clusteringtoko.php');

        if (!file_exists($phpScript)) {
            Log::error('Clustering script not found at: ' . $phpScript);
            return redirect()->route('table.tabelsale')->with('error', 'Clustering script not found.');
        }

        require_once $phpScript;

        $result = clusteringToko($bulan_periode);
        if ($result === 'data tidak ditemukan') {
            return redirect()->route('table.tabelsale')->with('error', 'Data tidak ditemukan.');
        }

        Log::info('Result of clustering:', $result);

        return view('hitung.clusteringtoko', [
            'backgroundImage' => '/assets/img/clusteringimg.png',
            'result' => $result,
            'type' => 'Toko'
        ]);
    }

    // clustering barang
    public function startClusteringBarang(Request $request)
    {
        $request->validate([
            'bulan_periode' => 'required|date_format:Y-m'
        ]);

        $bulan_periode = $request->input('bulan_periode') . '-01';

        $phpScript = base_path('resources/views/algoritma/clusteringbarang.php');

        if (!file_exists($phpScript)) {
            Log::error('Clustering script not found at: ' . $phpScript);
            return redirect()->route('table.tabelsale')->with('error', 'Clustering script not found.');
        }

        require_once $phpScript;

        $result = clusteringBarang($bulan_periode);
        if ($result === 'data tidak ditemukan') {
            return redirect()->route('table.tabelsale')->with('error', 'Data tidak ditemukan.');
        }

        Log::info('Result of clustering:', $result);

        return view('hitung.clusteringbarang', [
            'backgroundImage' => '/assets/img/clusteringimg.png',
            'result' => $result,
            'type' => 'Barang'
        ]);
    }

}
