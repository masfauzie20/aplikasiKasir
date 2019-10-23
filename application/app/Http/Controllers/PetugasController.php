<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Petugas;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
         $data = Petugas::all();
        //  dd($data);
         return view('petugas.grid',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $petugas = new Petugas();
        $petugas->name = $request->input('name');
        $petugas->jabatan = $request->input('jabatan');
        
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('uploads/file',$newName);
        
        $petugas->file = $newName;
        $petugas->save();
        
        alert()->success('Data Berhasil Ditambahkan!', 'Sukses')->persistent('Ok');
        
        return redirect()->route('petugas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data = Petugas::where('id',$id)->get();
        
         return view('petugas.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->name = $request->input('name');
        $petugas->jabatan = $request->input('jabatan');
        
        if (empty($request->file('file'))){
            $petugas->file = $petugas->file;
        
        } else {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $file->move('uploads/file',$newName);
            $petugas->file = $newName;
        }
        $petugas->save();
        
        alert()->success('Data Berhasil Diubah!', 'Sukses')->persistent('Ok');
        return redirect()->route('petugas');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        $petugas = Petugas::findOrFail($id_barang);
        $petugas->delete();
        
        alert()->success('Data Berhasil Dihapus!', 'Sukses')->persistent('Ok');
        return redirect()->route('petugas');
    
    }
}
