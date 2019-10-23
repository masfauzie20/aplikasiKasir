<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;    

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = ['username', 'email', 'password', 'role'];    
    public $timestamps = false;

    public function transaksi()
    {
        return $this->belongsTo(Transactions::class, 'id_user');
    }
}
