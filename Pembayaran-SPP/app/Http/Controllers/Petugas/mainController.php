<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Petugas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class mainController extends Controller
{
    public function dashboard()
    {
        $bayar = Pembayaran::where('status', 'bayar')
        ->where('bulan_bayar', Carbon::now()->Isoformat('MMMM'))
        ->where('updated_at','>',1)
        ->orderBy('updated_at', 'desc')->take(5)->get();
        return view('petugas.dashboard', compact('bayar'));
    }
    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            if($request->check)
            {
                $data = Pembayaran::where('status', 'bayar')->where('bulan_bayar', Carbon::now()->Isoformat('MMMM'))->where('updated_at', Carbon::now())->get();
                return response()->json(compact('data'));
            }else{
                $admin = Petugas::where('level', 'admin')->count();
                $petugas = Petugas::where('level', 'petugas')->count();
                $siswa = Siswa::count();
                $kelas = Kelas::count();
                $bayar = Pembayaran::where('status', 'bayar')->where('bulan_bayar', Carbon::now()->Isoformat('MMMM'))->count();
                $belum = $siswa - $bayar;
                $bulan = Carbon::now()->Isoformat('MMMM');
                return response()->json(compact('admin', 'petugas', 'siswa', 'kelas', 'bayar', 'belum', 'bulan'));
            }

        }
    }
}
