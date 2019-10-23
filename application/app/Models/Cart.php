<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Cart extends Model
{

    protected $table = 'cart';

    public function barang(){
    	return $this->hasOne(Barang::class, 'id_barang','id_barang');
    }
}
