<?php


namespace App\Http\Controllers\Profile;


use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.profile');
    }
}
