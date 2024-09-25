<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\Salescontroller;
use App\Http\Controllers\Storecontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\stores;
use App\Models\products;
use App\Http\Controllers\Analisacontroller;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::match(['GET', 'POST'], '/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login.proses');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Ambil jumlah toko dari database
        $storeCount = stores::count();
        $productCount = products::count();
        // Kirim data ke view
        return view('home', ['storeCount' => $storeCount, 'productCount' => $productCount]);
    });

    Route::get('/analisa', [Analisacontroller::class, 'analisa']);

    // barang
    Route::get('/barang', [Productcontroller::class, 'formbarang']);
    Route::post('/barangstore', [Productcontroller::class, 'barangstore'])->name('barang.store');

    Route::get('/tabelbarang', [Productcontroller::class, 'tabelbarang'])->name('table.tabelbarang');
    route::get('/showbarang/{barang}', [Productcontroller::class, 'showbarang'])->name('view.showbarang');

    Route::get('/updatebarang/{barang}/edit', [Productcontroller::class, 'updatebarang'])->name('edit.editbarang');
    Route::put('/updatebarang/{barang}', [Productcontroller::class, 'updatesbarang'])->name('barang.update');

    route::delete('/baranghapus/{barang}', [Productcontroller::class, 'destroybarang'])->name('hapusbarang.destroy');

    // toko
    Route::get('/toko', [Storecontroller::class, 'formtoko']);
    Route::post('/tokostore', [Storecontroller::class, 'tokostore'])->name('toko.store');

    Route::get('/tabeltoko', [Storecontroller::class, 'tabeltoko'])->name('table.tabeltoko');
    route::get('/showtoko/{toko}', [Storecontroller::class, 'showtoko'])->name('view.showtoko');

    Route::get('/updatetoko/{toko}/edit', [Storecontroller::class, 'updatetoko'])->name('edit.edittoko');
    Route::put('/updatetoko/{toko}', [Storecontroller::class, 'updatestoko'])->name('toko.update');

    Route::delete('/tokohapus/{toko}', [Storecontroller::class, 'destroytoko'])->name('hapustoko.destroy');

    Route::get('/kalkulasi', [Storecontroller::class, 'kalkulasi'])->name('hitung.formhitung');
    Route::post('/startkalkulasi', [Storecontroller::class, 'startkalkulasi'])->name('toko.kalkulasi');


    // konsinyasi
    Route::get('/sale', [Salescontroller::class, 'formsale']);
    Route::post('/salestore', [Salescontroller::class, 'salestore'])->name('sale.store');

    Route::get('/tabelsale', [Salescontroller::class, 'tabelsale'])->name('table.tabelsale');
    route::get('/showsale/{sale}', [Salescontroller::class, 'showsale'])->name('view.showsale');

    Route::get('/updatesale/{sale}/edit', [Salescontroller::class, 'updatesale'])->name('edit.editsale');
    Route::put('/updatesale/{sale}', [Salescontroller::class, 'updatessale'])->name('sale.update');

    Route::delete('/salehapus/{sale}', [Salescontroller::class, 'destroysale'])->name('hapussale.destroy');

    Route::post('/startclusteringtoko', [Salescontroller::class, 'startClusteringToko'])->name('clustering.toko');
    Route::post('/startclusteringbarang', [Salescontroller::class, 'startClusteringBarang'])->name('clustering.barang');
    }
);