<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Eloquent;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id';
    protected $fillable = [
					'id',
					'name',
					'jabatan',
					'file'];

	protected $hidden = [
					'created_at',
					'created_by',
					'updated_at',
					'updated_by',
					'deleted_at',
					'deleted_by'];

	public function barang()
	{
		return $this->belongsTo(Barang::class);
	}
	public function transaksi()
	{
		return $this->belongsTo(Transactions::class);
	}
	
}
