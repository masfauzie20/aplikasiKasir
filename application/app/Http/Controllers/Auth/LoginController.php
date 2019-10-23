<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->title = 'Login';
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        if(Auth::check()){
            return redirect('dashboard');
        }else{
            $data['title'] = $this->title;
            return view('auth/login', $data);
        }
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    // public function username()
    // {
    //     return 'email';
    // }

    public function authenticate(Request $request)
    {
        if(Auth::check()){
            return $request->expectsJson() ? response()->json(helpResponse(200, [], 'Anda sudah login')) : redirect()->intended('dashboard');
        }else{
            $credentials = $request->only('email', 'password');
            $usr_email = $request->input('email');
            $usr_pwd = $request->input('password');

            $data = ['email' => $usr_email, 'password' => $usr_pwd];

            if (Auth::attempt($data)) {
                $user = Auth::user();
                $alerts[] = array('success', 'Anda berhasil login', 'OK');
                $request->session()->flash('alerts', $alerts);
                
                return $request->expectsJson() ? response()->json(helpResponse(200, $user, 'Selamat Anda berhasil login'), 200) : redirect()->intended('dashboard');
            
            }else{
                $alerts[] = array('warning','Pemberitahuan', 'Username atau Password Anda salah');
                $request->session()->flash('alerts', $alerts);
                
                return $request->expectsJson() ? response()->json(helpResponse(401, [], 'Username atau Password Anda salah'), 401) : redirect()->intended('/');
            }

        }
    }

    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
        }

        return redirect('/');
    }
}
