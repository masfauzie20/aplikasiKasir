<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
	use SoftDeletes;
	
    protected $table = 'transactions';
	protected $primaryKey = 'id';
	protected $fillable = ['id'];

	public function barang()
	{
		return $this->hasOne(Barang::class, 'id_barang');
	}
	
	public function details()
	{
		return $this->hasMany(Detail::class, 'id_transactions');
	}

	public function petugas()
	{
		return $this->hasOne(User::class, 'id_petugas', 'id_user');
	}
}
