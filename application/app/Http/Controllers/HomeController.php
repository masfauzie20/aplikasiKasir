<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terlambat;
use Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
    $terlambat = Terlambat::query();
        $tahun = $terlambat->get();

        if ($request->has('year')) {
            $terlambat->where('tahun', '=', $request->get('year'))
                      ->orderBy('bulan','asc');
        }
        $chart = Charts::create('bar', 'google')
                ->title("Statistik Keterlambatan")
                ->elementLabel("Total Terlambat")
                ->dimensions(975, 500)
                ->responsive(false)
                ->labels($terlambat->pluck('bulan'))
                ->values($terlambat->pluck('telat'));
        
        $data = [
            'tahun' => $tahun,
            'data' => $terlambat,
            'chart' => $chart
        ];
        
        return view('dashboard.grid', $data, compact('chart','tahun','terlambat'));
    }
}
