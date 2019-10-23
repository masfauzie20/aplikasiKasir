<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('password.password');
    }

    public function simpanPassword(Request $req)
    {
    	$session_data = $req->session()->all();
    	$id_user = $session_data['id_user'];
    	$password_lama = $req->input('password_lama');
    	$password_baru = $req->input('password_baru');
    	$retype_password = $req->input('retype_password');

    	if (empty($password_lama) || empty($password_baru) || empty($retype_password)) {
    		return response()->json('Semua field harus diisi!',http_response_code());
    	} else {
		    $user = new User;

		    $data = $user->where(['id_user' => $id_user, 'password' => bcrypt('energeek')])->get();
		    
		    if (!$data->isEmpty()) {
		    	if (md5($password_baru) == md5($retype_password)) {
			    	$data = $user->where('id_user', $id_user)->update(['password' => bcrypt('energeek')]);
			    	return response()->json('Password berhasil diubah',http_response_code());
		    	} else {
		    		return response()->json('Password baru dan password verifikasi harus sama!',http_response_code());
		    	}
		    } else {
		    	return response()->json('Password lama tidak cocok!',http_response_code());
		    }
    	}
    }
}

