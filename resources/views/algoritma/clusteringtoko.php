<?php

use App\Models\sales;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\Log;

function clusteringToko($bulan_periode)
{
    $sales = sales::where('bulan_periode', $bulan_periode)->get();

    if ($sales->isEmpty()) {
        Log::info('No sales data found for the given month.');
        return 'data tidak ditemukan';
    }

    $storeData = [];
    $storeNames = [];

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

    // Menggunakan seed untuk KMeans agar hasil konsisten
    mt_srand(42);

    if (count($samples) >= 3) {
        $kmeans = new KMeans(3);
        $clusters = $kmeans->cluster($samples);

        $clusterSums = [];
        foreach ($clusters as $index => $cluster) {
            $totalPenjualan = 0;

            if (count($cluster) > 0) {
                foreach ($cluster as $key => $item) {
                    $totalPenjualan += $storeData[$key]['banyak_terjual'];
                }
                $clusterSums[$index] = $totalPenjualan / count($cluster);
            } else {
                $clusterSums[$index] = 0;
            }
        }

        arsort($clusterSums);
        $sortedClusterIndexes = array_keys($clusterSums);

        $labels = ['Toko Ramai', 'Toko Normal', 'Toko Sepi'];
        $clusterToLabel = [];
        foreach ($sortedClusterIndexes as $i => $clusterIndex) {
            $clusterToLabel[$clusterIndex] = $labels[$i];
        }

        $result = [];
        foreach ($clusters as $index => $cluster) {
            foreach ($cluster as $key => $item) {
                $result[] = [
                    'nama_toko' => $storeNames[$storeData[$key]['store_id']],
                    'banyak_terjual' => $storeData[$key]['banyak_terjual'],
                    'durasi_penjualan' => $storeData[$key]['durasi_penjualan'],
                    'cluster' => $clusterToLabel[$index]
                ];
            }
        }
    } else {
        // Jika data kurang dari 3, semua toko dimasukkan ke dalam cluster "Toko Ramai"
        $result = [];
        foreach ($storeData as $key => $item) {
            $result[] = [
                'nama_toko' => $storeNames[$item['store_id']],
                'banyak_terjual' => $item['banyak_terjual'],
                'durasi_penjualan' => $item['durasi_penjualan'],
                'cluster' => 'Toko Ramai' 
            ];
        }
    }

    Log::info('Clustering Result:', $result);

    return $result;
}
