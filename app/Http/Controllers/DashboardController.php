<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Buku;
use App\History;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
    
             
        //chart berdasarkan jenis kelamin
        $jenis_kelamin =  Anggota::groupBy('jenis_kelamin')->select('jenis_kelamin',DB::raw('count(*) as total'))->get();

        // $pria = $jenis_kelamin[0]['jenis_kelamin'];
        // $priaTot = $jenis_kelamin[0]['total'];
        // $wanita = $jenis_kelamin[1]['jenis_kelamin'];
        // $wanitaTot = $jenis_kelamin[1]['total'];

        $data = [
           'buku' =>  Buku::count(),
           'anggota' => Anggota::count(),
           'transaksi' => Transaksi::count(),
           'riwayat' => Transaksi::withTrashed()->count(),
           'jenis_kelamin' => $jenis_kelamin
        ];

        // dd($buku_kategori);
        return view('dashboard',$data);

        
    }
}
