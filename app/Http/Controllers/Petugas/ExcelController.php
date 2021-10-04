<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Models\Siswa;
use App\Exports\Siswa\SiswaExport;
use App\Exports\Siswa\MultiExport as SiswaMultiExport;
use App\Models\Kelas;
use App\Exports\Kelas\KelasExport;
use App\Models\Spp;
use App\Exports\Spp\SppExport;
use App\Models\Petugas;
use App\Exports\Petugas\PetugasExport;
use App\Models\Pembayaran;
use App\Exports\Transaksi\TransaksiExport;

class ExcelController extends Controller
{
    private $excel;
    public function __construct(Excel $excel)
    {
        return $this->excel = $excel;
    }

    public function siswa()
    {
        $siswa = Siswa::select('kelas_id')->with('kelas')->distinct()->get();
        return $this->excel->download(new SiswaMultiExport($siswa), 'Data-siswa.xlsx');
    }

    public function kelas()
    {
        $getdata = kelas::all();
        return $this->excel->download(new KelasExport($getdata), 'Data-kelas.xlsx');
    }
    public function spp()
    {
        $getdata = Spp::all();
        return $this->excel->download(new SppExport($getdata), 'Data-spp.xlsx');
    }
    public function petugas()
    {
        $getdata = Petugas::all();
        return $this->excel->download(new PetugasExport($getdata), 'Data-petugas.xlsx');
    }
    public function transaksi()
    {
        $getdata = Pembayaran::all();
        return $this->excel->download(new TransaksiExport($getdata), 'Data-transaksi.xlsx');
    }
}
