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
            'nomor_telepon' => 'nullable|numeric|min:1',
        ], [
            'nomor_telepon.numeric' => 'The nomor telepon must be numberic',
        ]);

        stores::create($validatedata);
        return redirect('/toko')->with('berhasil', 'Data berhasil tersimpan');
    }

    // view
    public function tabeltoko()
    {
        $backgroundImage = '/assets/img/backtabeltoko.jpg';
        $stores = stores::all(); 
        return view('table.tabeltoko', compact('stores'), compact('backgroundImage')); 
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
        $validatedata =
        $request->validate([
            'kode_toko' => 'required|min:3|max:6|unique:stores,kode_toko,' . $toko->id,
            'nama_toko' => 'required',
            'alamat' => '',
            'nomor_telepon' => 'nullable|numeric|min:1',
        ], [
            'nomor_telepon.numeric' => 'The nomor telepon must be numberic',
        ]);

        stores::where('id', $toko->id)->update($validatedata);
        return redirect()->route('table.tabeltoko', ['stores' => $toko->id])->with('berhasil', "Update data {$validatedata['nama_toko']} berhasil");
    }

    // hapus
    public function destroytoko($id)
    {
        $stores = stores::findOrFail($id);
        $storesnama = $stores->nama_toko; 
        $stores->delete();

        return redirect()->route('table.tabeltoko')->with('berhasil', "Hapus data $storesnama berhasil");
    }
}
