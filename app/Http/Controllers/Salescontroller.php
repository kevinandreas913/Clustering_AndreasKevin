<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\sales;
use App\Models\stores;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

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
            'banyak_terjual' => 'required|integer|min:1|max:9999',
            'harga_unit' => 'required|numeric|min:1|max:9999999.99',
            'durasi_penjualan' => 'required|integer|min:1|max:999',
            'bulan_periode' => 'required|date_format:Y-m',
        ]);
            
        $validatedata['bulan_periode'] = $validatedata['bulan_periode'] . '-01';
        $validatedata['uuid'] = Str::uuid(); // Generate UUID

        sales::create($validatedata);
        return redirect('/sale')->with('berhasil', 'Data berhasil tersimpan');
    }

    public function viewTableSale() {
        $backgroundImage = '/assets/img/salesback.png';

        return view('table.tabelsale', compact('backgroundImage'));
    }
    public function tabelsale(Request $request)
    {
        $filterBulan = $request->input('filter_bulan_periode');

        $salesQuery = sales::with(['product', 'store']);

        if ($filterBulan) {
            $bulan = \Carbon\Carbon::parse($filterBulan)->month;
            $tahun = \Carbon\Carbon::parse($filterBulan)->year;
            $salesQuery->whereMonth('bulan_periode', $bulan)
            ->whereYear('bulan_periode', $tahun);
        }

        return DataTables::of($salesQuery)
            ->addIndexColumn()
            ->addColumn('action', function ($sale) {
                $viewUrl = route('view.showsale', ['sale' => $sale->id]);
                $editUrl = route('edit.editsale', ['sale' => $sale->id]);
                $deleteUrl = route('hapussale.destroy', ['sale' => $sale->id]);

                $buttons = '<a href="' . $viewUrl . '" class="btn btn-sm btn-primary"><i class="bi bi-eye-fill"></i></a> ';
                $buttons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-warning"><i class="bi bi-pen-fill"></i></a> ';
                $buttons .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteSale(' . $sale->id . ')"><i class="bi bi-trash"></i></button>';
                return $buttons;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $products = products::all();
        $stores = stores::all();
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
            'banyak_terjual' => 'required|integer|min:1|max:9999',
            'harga_unit' => 'required|numeric|min:1|max:9999999.99',
            'durasi_penjualan' => 'required|integer|min:1|max:999',
            'bulan_periode' => 'required|date_format:Y-m',
        ]);

        $validatedata['bulan_periode'] = $validatedata['bulan_periode'] . '-01';

        $sale = sales::where('uuid', $uuid)->firstOrFail();
        $sale->update($validatedata);

        return redirect()->route('view.tabelsale')->with('berhasil', "Update data berhasil");
    }

    // hapus
    public function destroysale($id)
    {
        $sales = sales::findOrFail($id);
        $sales->delete();
        return redirect()->route('view.tabelsale')->with('berhasil', "Data berhasil dihapus");
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
            return redirect()->route('view.tabelsale')->with('error', 'Clustering script not found.');
        }

        require_once $phpScript;

        $result = clusteringToko($bulan_periode);
        if ($result === 'data tidak ditemukan') {
            return redirect()->route('view.tabelsale')->with('error', 'Data tidak ditemukan.');
        }

        Log::info('Result of clustering:', $result);

        // Generate NLG descriptions
        $nlgDeskripsiToko = $this->generateNLGDescriptionsToko($result);

        return view('hitung.clusteringtoko', [
            'backgroundImage' => '/assets/img/clustertoko.png',
            'result' => $result,
            'nlgDeskripsiToko' => $nlgDeskripsiToko,
            'type' => 'Toko'
        ]);
    }


    private function generateNLGDescriptionsToko($clusters)
    {
        $descriptions = [];

        foreach ($clusters as $cluster) {
            $label = $cluster['cluster'];
            if (!isset($descriptions[$label])) {
                $descriptions[$label] = [];
            }
            $descriptions[$label][] = " - {$cluster['nama_toko']} dengan penjualan {$cluster['banyak_terjual']} pcs, dalam jangka waktu {$cluster['durasi_penjualan']} hari.";
        }

        $formattedDescriptions = [];
        foreach ($descriptions as $label => $stores) {
            $formattedDescriptions[] = "Dari data diperoleh '$label' :<br>" . implode("<br> ", $stores);
        }

        return $formattedDescriptions;
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
            return redirect()->route('view.tabelsale')->with('error', 'Clustering script not found.');
        }

        require_once $phpScript;

        $result = clusteringBarang($bulan_periode);
        if ($result === 'data tidak ditemukan') {
            return redirect()->route('view.tabelsale')->with('error', 'Data tidak ditemukan.');
        }

        Log::info('Result of clustering:', $result);

        
        $nlgDeskripsiBarang = $this->generateNLGDescriptionsBarang($result);

        return view('hitung.clusteringbarang', [
            'backgroundImage' => '/assets/img/clusterbarang.png',
            'result' => $result,
            'nlgDeskripsiBarang' => $nlgDeskripsiBarang,
            'type' => 'Barang', 
            'kesimpulan' => '$kesimpulan',
        ]);
    }

    private function generateNLGDescriptionsBarang($clusters)
    {
        $descriptions = [];

        foreach ($clusters as $cluster) {
            $label = $cluster['cluster'];
            if (!isset($descriptions[$label])) {
                $descriptions[$label] = [];
            }
            $descriptions[$label][] = " - {$cluster['nama_produk']} dengan harga satuan Rp{$cluster['harga_unit']}/pcs, banyak terjual {$cluster['banyak_terjual']}, dalam jangka waktu hari {$cluster['durasi_penjualan']}.";
        }

        $formattedDescriptions = [];
        foreach ($descriptions as $label => $products) {
            $formattedDescriptions[] = "Dari data diperoleh '$label' :<br>" . implode("<br> ", $products);
        }

        return $formattedDescriptions;
    }


}
