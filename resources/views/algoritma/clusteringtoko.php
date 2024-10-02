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

    $kmeans = new KMeans(3);
    $clusters = $kmeans->cluster($samples);

    // Menghitung rata-rata penjualan dari setiap cluster untuk menentukan label secara dinamis
    $clusterSums = [];
    foreach ($clusters as $index => $cluster) {
        $totalPenjualan = 0;
        foreach ($cluster as $key => $item) {
            $totalPenjualan += $storeData[$key]['banyak_terjual'];
        }
        $clusterSums[$index] = $totalPenjualan / count($cluster); // Rata-rata penjualan per cluster
    }

    // Mengurutkan index cluster berdasarkan nilai rata-rata penjualan (desc untuk ramai, normal, sepi)
    arsort($clusterSums);
    $sortedClusterIndexes = array_keys($clusterSums);

    // Tetapkan label berdasarkan urutan cluster
    $labels = ['Toko Ramai', 'Toko Normal', 'Toko Sepi'];
    $clusterToLabel = [];
    foreach ($sortedClusterIndexes as $i => $clusterIndex) {
        $clusterToLabel[$clusterIndex] = $labels[$i];
    }

    // Membuat hasil akhir dengan label yang sesuai
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

    Log::info('Clustering Result:', $result);

    return $result;
}



