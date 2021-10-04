<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Carbon\Carbon;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.data_transaksi.index',['transaksi' => Pembayaran::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = CarbonPeriod::create("2021-01-01", "1 month", "2021-12-01");
        $bulan = [];
        foreach ($result as $key => $value) {
            $bulan[] = $value->isoFormat('MMMM');
        }
        $siswa = Siswa::all();
        $tahun = Spp::all();
        return view('petugas.data_transaksi.create', compact('bulan','siswa','tahun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiRequest $request)
    {
        $request->validated();
        $spp = Spp::where('id' , $request->spp_id)->first();
        $request->request->add(['tahun_bayar'=> $spp->tahun , 'petugas_id' => Auth()->id()]);
        Pembayaran::create($request->all());
        return redirect()->route('petugas.transaksi.index')->with('success', 'Data transaksi berhasil di hapus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $transaksi)
    {
        return view('petugas.data_transaksi.show', ['Transaksi' => $transaksi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $transaksi)
    {
        $result = CarbonPeriod::create("2021-01-01", "1 month", "2021-12-01");
        $bulan = [];
        foreach ($result as $key => $value) {
            $bulan[] = $value->isoFormat('MMMM');
        }
        $siswa = Siswa::all();
        $tahun = Spp::all();
        $Transaksi = $transaksi;
        return view('petugas.data_transaksi.edit', compact('bulan', 'siswa', 'tahun','Transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiRequest $request, Pembayaran $transaksi)
    {
        $request->validated();
        $spp = Spp::where('id', $request->spp_id)->first();
        $request->request->add(['tahun_bayar' => $spp->tahun, 'petugas_id' => Auth()->id()]);
        $transaksi->update($request->all());
        return redirect()->route('petugas.transaksi.index')->with('success', 'Data transaksi berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('petugas.transaksi.index')->with('success', 'Data transaksi berhasil di hapus');
    }
}
