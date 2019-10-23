<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth/password/reset');
    }

    // public function simpanPassword(Request $req)
    // {
    // 	$session_data = $req->session()->all();
    // 	$id_user = $session_data['id_user'];
    // 	$password_lama = $req->input('password_lama');
    // 	$password_baru = $req->input('password_baru');
    // 	$retype_password = $req->input('retype_password');

    // 	if (empty($password_lama) || empty($password_baru) || empty($retype_password)) {
    // 		return response()->json('Semua field harus diisi!',http_response_code());
    // 	} else {
	// 	    $user = new User;

	// 	    $data = $user->where(['id_user' => $id_user, 'password' => md5("3n3rg33k".md5($password_lama))])->get();
		    
	// 	    if (!$data->isEmpty()) {
	// 	    	if (md5($password_baru) == md5($retype_password)) {
	// 		    	$data = $user->where('id_user', $id_user)->update(['password' => md5("3n3rg33k".md5($password_baru))]);
	// 		    	return response()->json('Password berhasil diubah',http_response_code());
	// 	    	} else {
	// 	    		return response()->json('Password baru dan verifikasi password harus sama!',http_response_code());
	// 	    	}
	// 	    } else {
	// 	    	return response()->json('Password lama tidak cocok!',http_response_code());
	// 	    }
    // 	}
    // }

}
