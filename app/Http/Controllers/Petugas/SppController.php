<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\kelasReuqest;
use App\Http\Requests\SppRequest;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.data_spp.index', ['spp' => Spp::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.data_spp.create', ['spp'=>Spp::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SppRequest $request)
    {
        $request->validated();
        Spp::create($request->all());
        return redirect()->route('petugas.spp.index')->with('success', 'Data spp berhasil di tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        return view('petugas.data_spp.show', ['spp' => $spp]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $spp)
    {
        return view('petugas.data_spp.edit', ['spp' => $spp]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(SppRequest $request, Spp $spp)
    {
        $request->validated();
        $spp->update($request->all());
        return redirect()->route('petugas.spp.index')->with('success', 'Data spp berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spp $spp)
    {
        Pembayaran::where('spp_id', $spp->id)->update(['spp_id' => null]);
        $spp->delete();
        return redirect()->route('petugas.spp.index')->with('success', 'Data SPP berhasil di hapus');
    }
}
