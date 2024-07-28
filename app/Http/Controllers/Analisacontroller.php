<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\sales;
use App\Models\stores;

class Analisacontroller extends Controller
{
    public function analisa(Request $request)
    {
        $bulan = $request->query('bulan');
        $backgroundImage = '/assets/img/backtabel.jpg';

        if ($bulan) {
            $salesData = sales::with('product', 'store')
                ->whereMonth('bulan_periode', date('m', strtotime($bulan)))
                ->whereYear('bulan_periode', date('Y', strtotime($bulan)))
                ->get()
                ->groupBy('store_id')
                ->map(function ($storeSales) {
                    return $storeSales->groupBy('product_id')
                        ->map(function ($productSales) {
                            return $productSales->sum('banyak_terjual');
                        });
                });

            $formattedSalesData = $salesData->mapWithKeys(function ($sales, $storeId) {
                $store = stores::find($storeId); // Ambil nama toko dari database
                $storeName = $store->nama_toko;

                $labels = $sales->keys()->map(function ($productId) {
                    $product = products::find($productId); // Ambil nama produk dari database
                    return $product->nama;
                });

                return [
                    $storeName => [
                        'labels' => $labels->toArray(),
                        'values' => $sales->values()->toArray(),
                    ],
                ];
            });

            return view('analisa', [
                'salesData' => $formattedSalesData,
                'backgroundImage' => $backgroundImage,
                'bulan' => $bulan
            ]);
        }

        return view('analisa', [
            'backgroundImage' => $backgroundImage
        ]);
    }
}
