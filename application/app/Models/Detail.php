<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Transactions;
// use App\Models\Barang;
class Detail extends Model
{
    protected $table = 'transactions_detail';

    public function transaksi()
    {
        return $this->belongsTo(Transactions::class, 'id_transactions', 'id');
    }
    public function barang()
    {
        return $this->hasOne(Barang::class,'id_barang' , 'id_barang');
    }
}
