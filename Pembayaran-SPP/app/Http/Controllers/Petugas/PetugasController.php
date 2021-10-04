<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasRequest;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.data_petugas.index', ['petugas' => Petugas::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.data_petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetugasRequest $request)
    {
        $request->validated();
        $request->request->add(['password'=> Hash::make($request->password)]);
        Petugas::create($request->all());
        return redirect()->route('petugas.main.index')->with('success', 'Data petugas berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $main)
    {
        return view('petugas.data_petugas.show', ['petugas' => $main]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $main)
    {
        return view('petugas.data_petugas.edit', ['petugas' => $main]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasRequest $request, Petugas $main)
    {
        $request->validated();
        $request->request->add(['password' => Hash::make($request->password)]);
        $main->update($request->all());
        return redirect()->route('petugas.main.index')->with('success', 'Data petugas berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $main)
    {
        $main->delete();
        return redirect()->route('petugas.main.index')->with('success', 'Data petugas berhasil di hapus');
    }
}
