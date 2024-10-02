<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\sales;
use App\Models\stores;

class Productcontroller extends Controller
{
    // form
    public function formbarang(){
        $backgroundImage = '/assets/img/backform.jpg';
        return view('/form/formbarang', compact('backgroundImage'));
    }
    public function barangstore(Request $request)
    {
        $validatedata =
        $request->validate([
            'kode_barang' => 'required|min:3|max:10|unique:products',
            'nama' => 'required',
            'deskripsi' => '',
            'harga' => 'required|numeric',
        ]);

        products::create($validatedata);
        return redirect('/barang')->with('berhasil', 'Data berhasil tersimpan');
    }


    // view
    public function tabelbarang()
    {
        $backgroundImage = '/assets/img/backtabel.jpg';
        $products = products::all(); // Mengambil semua data produk dari database
        return view('table.tabelbarang', compact('products'), compact('backgroundImage')); // Mengirim data produk ke view
    }
    public function showbarang(products $barang)
    {
        $backgroundImage = '/assets/img/backtabel.jpg';
        return view('/view/showbarang', [
            'backgroundImage' => $backgroundImage,
            'products' => $barang
        ]);
    }

    // update
    public function updatebarang(products $barang)
    {
        $backgroundImage = '/assets/img/backform.jpg';
        return view('edit.editbarang', [
            'backgroundImage' => $backgroundImage,
            'products' => $barang
        ]);
    }

    public function updatesbarang(Request $request, products $barang)
    {
        $validatedata = $request->validate([
            'kode_barang' => 'required|min:3|max:10|unique:products,kode_barang,' . $barang->id,
            'nama' => 'required',
            'deskripsi' => '',
            'harga' => 'required',
        ]);

        products::where('id', $barang->id)->update($validatedata);
        return redirect()->route('table.tabelbarang', ['products' => $barang->id])->with('berhasil', "Update data {$validatedata['nama']} berhasil");
    }

    // hapus
    public function destroybarang($id)
    {
        $products = Products::findOrFail($id);
        $productsnama = $products->nama; // Simpan nama produk sebelum dihapus
        $products->delete();

        return redirect()->route('table.tabelbarang')->with('berhasil', "Hapus data $productsnama berhasil");
    }
}
