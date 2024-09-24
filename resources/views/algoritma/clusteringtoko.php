<?php

use App\Models\Sales;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\Log;

function clusteringToko($bulan_periode)
{
    $sales = Sales::where('bulan_periode', $bulan_periode)->get();

    if ($sales->isEmpty()) {
        Log::info('No sales data found for the given month.');
        return 'data tidak ditemukan';
    }

    $storeData = [];
    $storeNames = []; // Menyimpan nama toko

    foreach ($sales as $sale) {
        $storeData[] = [
            'store_id' => $sale->store_id,
            'banyak_terjual' => $sale->banyak_terjual,
            'durasi_penjualan' => $sale->durasi_penjualan
        ];

        $storeNames[$sale->store_id] = $sale->store->nama_toko;
    }

    $samples = [];
    foreach ($storeData as $item) {
        $samples[] = [
                $item['banyak_terjual'],
                $item['durasi_penjualan']
            ];
    }

    mt_srand(42);

    $kmeans = new KMeans(3);
    $clusters = $kmeans->cluster($samples);

    $labels = ['Toko Ramai', 'Toko Normal', 'Toko Sepi'];
    $result = [];
    foreach ($clusters as $index => $cluster) {
        foreach ($cluster as $key => $item) {
            $result[] = [
                'nama_toko' => $storeNames[$storeData[$key]['store_id']],
                'banyak_terjual' => $storeData[$key]['banyak_terjual'],
                'durasi_penjualan' => $storeData[$key]['durasi_penjualan'],
                'cluster' => $labels[$index]
            ];
        }
    }

    Log::info('Clustering Result:', $result);

    return $result;
}


