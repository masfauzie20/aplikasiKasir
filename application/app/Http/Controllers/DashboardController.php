<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terlambat;
use App\Http\Requests;
use Kyslik\ColumnSortable\Sortable;
use Charts;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $terlambat = Terlambat::query();
        
        // $tahun = $terlambat->get();


        // if ($request->has('year')) {
        //     $terlambat->where('tahun', '=', $request->get('year'))
        //               ->orderBy('bulan','asc');
        // }
        // $chart = Charts::create('bar', 'google')
        // ->title("Statistik Keterlambatan")
        // ->elementLabel("Total Terlambat")
        // ->dimensions(975, 500)
        // ->responsive(false)
        // ->labels($terlambat->pluck('bulan'))
        // ->values($terlambat->pluck('telat'));
        
        // $data = [
        //     'tahun' => $tahun,
        //     'data' => $terlambat,
        //     'chart' => $chart
        // ];
        
        return view('dashboard.grid');
    }
    
    public function update($data)
    {
        $ticket = $this->find($data['id']);
        $ticket->user_id = auth()->user()->id;
        $ticket->title = $data['title'];
        $ticket->description = $data['description'];
        $ticket->save();
        
    }
}
