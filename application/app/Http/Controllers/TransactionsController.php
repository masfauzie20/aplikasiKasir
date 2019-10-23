<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Barang;
use App\Models\Transactions;
use App\Models\Petugas;
use App\Models\Cart;
use App\Models\Detail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transactions::all();
        $cart = Cart::all();
        
        // $cart = Cart::all();
       
        $delete = Transactions::onlyTrashed()->get();
        
        // dd($delete);
         
        return view('transactions.grid', [
            'data' => $data,
            'cart' => $cart,
            'delete' => $delete
            ]);
    }

    // public function trash()
    // {
    //     $delete = Transactions::onlyTrashed()->get();
        
    //     return view('transactions.grid',[
    //         'delete' => $delete
    //     ]);
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Petugas::all();
        $cart = Cart::all();
        $data_barang = Barang::all();
        // dd(Auth::User()->id_user);

        return view('transactions.create',compact('data','data_barang','cart'));
    }

    public function detail()
    {
        $data = Transactions::all();
        // dd($data);

        return view('transactions.transactions-detail', [
            'data' => $data,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Cart $cart,Request $request)
    {
        $actions = request('actions');
        $total = 0;
        $nama_barang = request('nama_barang');
        $jumlah = request('jumlah');
        $totaljumlah = 0;
        $total_harga = request('total');

        if($actions == 'Create') {
            $transaksi = new Transactions;
            $transaksi->id_petugas = Auth::User()->id_user;
            
            if($transaksi->save()){
                $latest_transaction = Transactions::latest('id')->first();
                foreach($nama_barang as $key => $nambar){
                    $totaljumlah += $jumlah[$key];
                
                    $detail = new Detail;
                    $detail->id_barang = $nambar;
                    $detail->id_transactions = $latest_transaction->id;
                
                    if($detail->save()){
                        // dd($detail);
                        $barang = Barang::find($nambar);
                        $barang->jumlah = $barang->jumlah - $jumlah[$key];
                        // $barang->save();
                        if($barang->save())
                        {
                            $data = Cart::find($detail->id)->first();
                            $data->delete();
                        }
                    }

                    $total += $total_harga[$key];

                }

                $new = Transactions::find($latest_transaction->id);
                $new->jumlah_beli = $totaljumlah;
                $new->total_harga = $total;
                $new->save();
                
                alert()->success('Data Berhasil Ditambahkan!', 'Sukses')->persistent('Ok');
            }

        }

        return redirect()->route('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactions = Transactions::findOrFail($id)->first();
        $transactions->delete();

        alert()->success('Data Berhasil Dihapus!','Sukses')->persistent('OK');

        return redirect()->route('transactions');
    }
}
