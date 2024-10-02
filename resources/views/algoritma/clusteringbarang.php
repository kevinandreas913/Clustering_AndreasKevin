<?php

use App\Models\sales;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\Log;

function clusteringBarang($bulan_periode)
{
    $sales = sales::where('bulan_periode', $bulan_periode)->get();
    if ($sales->isEmpty()) {
        Log::info('No sales data found for the given month.');
        return 'data tidak ditemukan';
    }
    
    $storeData = [];
    $productNames = []; // Menyimpan nama produk

    foreach ($sales as $sale) {
        $storeData[] = [
            'product_id' => $sale->product_id,
            'banyak_terjual' => $sale->banyak_terjual,
            'harga_unit' => $sale->harga_unit,
            'durasi_penjualan' =>$sale->durasi_penjualan
        ];

        $productNames[$sale->product_id] = $sale->product->nama;
    }

    $samples = [];
    foreach ($storeData as $item) {
        $samples[] = [
            $item['banyak_terjual'],
            $item['harga_unit'],
            $item['durasi_penjualan']
        ];
    }

    mt_srand(42);

    $kmeans = new KMeans(2);
    $clusters = $kmeans->cluster($samples);

    $labels = ['Produk Laku', 'Produk Kurang Laku'];
    $result = [];
    foreach ($clusters as $index => $cluster) {
        foreach ($cluster as $key => $item) {
            $result[] = [
                'nama_produk' => $productNames[$storeData[$key]['product_id']],
                'banyak_terjual' => $storeData[$key]['banyak_terjual'],
                'durasi_penjualan' => $storeData[$key]['durasi_penjualan'],
                'harga_unit' => $storeData[$key]['harga_unit'],
                'cluster' => $labels[$index]
            ];
        }
    }

    Log::info('Clustering Result:', $result);

    return $result;
}
