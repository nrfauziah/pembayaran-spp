<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Models\Kelas;
use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.data_siswa.index', ['siswa' => Siswa::orderby('nisn','ASC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('petugas.data_siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaRequest $request)
    {
        $request->validated();
        $request->request->add(['password' => Hash::make('password')]);
        Siswa::create($request->all());
        return redirect()->route('petugas.siswa.index')->with('success','Data siswa berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return view('petugas.data_siswa.show', ['siswa'=> $siswa]);
    }

    public function siswa_transaksi(Siswa $siswa)
    {
        return view('petugas.data_siswa.siswa_transaksi', ['transaksi' => $siswa->transaksi , 'siswa' => $siswa]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return view('petugas.data_siswa.edit',['siswa' => $siswa , 'kelas' => Kelas::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $request->validated();
        $siswa->update($request->all());
        return redirect()->route('petugas.siswa.index')->with('success', 'Data siswa berhasil di edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('petugas.siswa.index')->with('success', 'Data siswa berhasil di hapus');
    }
}
