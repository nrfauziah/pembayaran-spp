<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\Spp;

use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class mainController extends Controller
{
    public function dashboard()
    {
        return view('siswa.dashboard');
    }
    public function transaksi()
    {
        $transaksi = Pembayaran::where('siswa_id', Auth()->id())->where('status', 'belum')->get();
        return view('siswa.transaksi', compact('transaksi'));
    }
    public function tambah_transaksi(Pembayaran $pembayaran)
    {
        $pembayaran->update(['status' => 'bayar', 'tgl_bayar' => Carbon::now()->format('Y-m-d'), 'jumlah_bayar' => $pembayaran->spp->nominal]);
        Alert::success('Berhasil Dibayar', 'Silahkan Cek History Pembayaran');
        return redirect()->route('siswa.transaksi');
    }
    public function history()
    {
        $history = Pembayaran::where('siswa_id', Auth()->id())->where('status','bayar')->get();
        return view('siswa.history' , compact('history') );
    }
}
