<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sortable;
use Eloquent;

class Barang extends Model
{
    protected $table = 'barang';
	protected $primaryKey = 'id_barang';
	protected $fillable = [
					'pegawai_id',
                    'nama',
                    'jumlah',
                    'harga'];

	protected $hidden = [
					'id',
					'created_at',
					'created_by',
					'updated_at',
					'updated_by',
					'deleted_at',
					'deleted_by'];

	public function petugas()
	{
		return $this->hasMany(Petugas::class, 'id');
	}
	
	public function transactions()
	{
		return $this->belongsTo(Transactions::class);
	}

	public function cart()
	{
		return $this->belongsTo(Cart::class);
	}

}