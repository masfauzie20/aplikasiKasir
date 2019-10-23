<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::all();
        dd($cart);

        return view('transactions.create',['cart' => $cart]);
    }

    public function create(Request $request)
    {
        $nama_barang = request('nama_barang');
        $jumlah_beli = request('jumlah');
        $total_harga = request('total');

        $data = new Cart;
        $data->id_barang = $request->nama_barang;
        $data->jumlah_beli = $request->jumlah;
        $data->total_harga = $request->total;
        $data->save();
 
        // return view('transactions.create',compact('data'));
        return redirect()->route('transactions.create');
    }
    
    public function destroy($id) 
    {
        // $detail - Detail::findOrFail($id);
        $data = Cart::findOrFail($id)->first();
        // dd($data);
        $data->delete();
        
        return redirect()->route('transactions.create');
    }
}
