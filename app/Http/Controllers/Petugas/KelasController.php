<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\kelasReuqest;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Siswa;
class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.data_kelas.index', ['kelas' => Kelas::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.data_kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(kelasReuqest $request)
    {
        $request->validated();
        Kelas::create($request->all());
        return redirect()->route('petugas.kelas.index')->with('success', 'Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kela)
    {
        return view('petugas.data_kelas.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        return view('petugas.data_kelas.edit', ['kelas'=> $kela]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(kelasReuqest $request, Kelas $kela)
    {
        $request->validated();
        $kela->update($request->all());
        return redirect()->route('petugas.kelas.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        Siswa::where('kelas_id',$kela->id)->update(['kelas_id'=> null]);
        $kela->delete();
        return redirect()->route('petugas.kelas.index')->with('success', 'Data kelas berhasil di hapus');
    }
}
