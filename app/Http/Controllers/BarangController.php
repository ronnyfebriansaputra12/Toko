<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::orderBy('id', 'asc')->paginate(10);

        if(session('success_message')){
            Alert::toast( session('success_message'),'success');
        }

        return view('admins.barang.index')->with('barangs', $barangs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $title = 'Barang';
        return view('admins.barang.create')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_brg' => 'required',
            'nama_brg' => 'required',
            'harga_brg' => 'required|numeric',
            'stok_brg' => 'required|numeric',
            'foto_brg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [

            'kode_brg.required' => 'Kode Barang Harus Diisi',
            'nama_brg.required' => 'Nama Barang Harus Diisi',
            'harga_brg.required' => 'Harga Barang Harus Diisi',
            'stok_brg.required' => 'Stok Barang Harus Diisi',
            'foto_brg.required' => 'Foto Barang Harus Diisi',
            'harga_brg.numeric' => 'Harga Barang Harus Angka',
            'stok_brg.numeric' => 'Stok Barang Harus Angka',
            'foto_brg.image' => 'Foto Barang Harus Gambar',
            'foto_brg.mimes' => 'Foto Barang Harus Berformat jpeg,png,jpg,gif,svg',
        ]);

        $foto_file = $request->file('foto_brg');
        $foto_ekstensi = $foto_file->getClientOriginalExtension();
        $nama_foto = time() . '.' . $foto_ekstensi;
        $foto_file->move(public_path('images'), $nama_foto);

        $data = [
            'kode_brg' => $request->kode_brg,
            'nama_brg' => $request->nama_brg,
            'harga_brg' => $request->harga_brg,
            'stok_brg' => $request->stok_brg,
            'foto_brg' => $nama_foto    
        ];

        $title = 'Tambah Barang';

        Barang::create($data);
        return redirect()->route('barang.index')->withSuccessMessage('Data Barang Berhasil Ditambahkan', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        $barang = Barang::find($barang->id);
        $breadcrum = 'Details Barang';
        return view('admins.barang.details')->with('barang', $barang,compact('breadcrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {   
        $data = Barang::where('id', $barang->id)->first();
        return view('admins.barang.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode_brg' => 'required',
            'nama_brg' => 'required',
            'harga_brg' => 'required|numeric',
            'stok_brg' => 'required|numeric',
            'foto_brg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [

            'kode_brg.required' => 'Kode Barang Harus Diisi',
            'nama_brg.required' => 'Nama Barang Harus Diisi',
            'harga_brg.required' => 'Harga Barang Harus Diisi',
            'stok_brg.required' => 'Stok Barang Harus Diisi',
            'foto_brg.required' => 'Foto Barang Harus Diisi',
            'harga_brg.numeric' => 'Harga Barang Harus Angka',
            'stok_brg.numeric' => 'Stok Barang Harus Angka',
            'foto_brg.image' => 'Foto Barang Harus Gambar',
            'foto_brg.mimes' => 'Foto Barang Harus Berformat jpeg,png,jpg,gif,svg',
        ]);

        $data = [
            'kode_brg' => $request->kode_brg,
            'nama_brg' => $request->nama_brg,
            'harga_brg' => $request->harga_brg,
            'stok_brg' => $request->stok_brg,
            // 'foto_brg' => $nama_foto
        ];

        if ($request->hasFile('foto_brg')) {
            $foto_file = $request->file('foto_brg');
            $foto_ekstensi = $foto_file->getClientOriginalExtension();
            $nama_foto = time() . '.' . $foto_ekstensi;
            $foto_file->move(public_path('images'), $nama_foto);
            $data_foto = Barang::where('id', $barang->id)->first();
            File::delete(public_path('images/' . $data_foto->foto_brg));
        }

        $data['foto_brg'] = $nama_foto;
        $title = 'Edit Barang';


        Barang::where('id', $barang->id)->update($data);
        return redirect()->route('barang.index')->withSuccessMessage('Data Barang Berhasil Diubah', compact('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $data = Barang::where('id', $barang->id)->first();
        File::delete(public_path('images/' . $data->foto_brg));
        Barang::where('id', $barang->id)->delete();
        return redirect()->route('barang.index')->withSuccessMessage('Data Barang Berhasil Dihapus');
    }
}
