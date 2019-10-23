<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Barang;
use App\Models\Petugas;
use App\Models\Cart;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;
use Validator;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::join('petugas','petugas.id','=','barang.id')
                        ->select('petugas.*','barang.*')
                        ->get();
         return view('barang.grid',compact('data'));
    }

    public function edit($id){
        // dd($id);
        $data = Barang::select('barang.*', 'petugas.name')
                      ->join('petugas','petugas.id','=','barang.id')
                      ->where('barang.id_barang',$id)
                      ->get();
        // dd($data);
        // $petugas = Petugas::all();
        
        return view('barang.edit',compact('data'));
    }

    public function create()
    {
         $data = Petugas::get();
          
         return view('barang.create',compact('data'));
    }
    
    public function store(Request $request)
    {
        // dd($request);
        $nama_barang = request('nama_barang');
        $nama_pegawai = request('nama_pegawai');
        $jumlah = request('jumlah');
        $harga = request('harga');

        $cek = Barang::where([
                ['nama_barang',$nama_barang],
                ['jumlah',$jumlah],
                ['harga',$harga]
            ]);
        
        if($cek->count()){
             alert()->error('Data Sudah Ada!', 'Gagal')->persistent('Ok');
        
        } else{

            $barang = new Barang;
            $barang->id = $request->input('nama_pegawai');
            $barang->nama_barang = $request->input('nama_barang');
            $barang->jumlah = $request->input('jumlah');
            $barang->harga = $request->input('harga');
            $barang->save();
        
        alert()->success('Data Berhasil Ditambahkan!', 'Sukses')->persistent('Ok');
        
    }
        return redirect()->route('barang');
    }

    public function update(Request $request)
    {
        // dd($request);
        $id_barang = request('id_barang');
        $nama_barang = request('nama_barang');
        $jumlah = request('jumlah');
        $harga = request('harga');

        $data = Barang::where('id_barang',$id_barang)->first();
        $data->nama_barang = $nama_barang;
        $data->jumlah = $jumlah;
        $data->harga = $harga;

        $data->save();

        alert()->success('Data Berhasil Diubah!', 'Sukses')->persistent('Ok');
        
        return redirect()->route('barang');
    }
    public function destroy($id_barang) {
        $data = Barang::where('id_barang',$id_barang)->first();
        $data->delete();
        alert()->success('Data Berhasil Dihapus!', 'Sukses')->persistent('Ok');
        return redirect('barang');
    }
}


