<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Http\Requests\StoreBidangRequest;
use App\Http\Requests\UpdateBidangRequest;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidangs = Bidang::orderBy('name', 'asc')->get();

        return view('bidang.index', [
            'title_page' => 'Daftar Bidang/Departemen',
            'bidangs' => $bidangs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bidang.create', [
            'title_page' => 'Tambah Bidang/Departemen',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBidangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBidangRequest $request)
    {
        $validatedData = $request->validated();

        Bidang::create($validatedData);

        return redirect()->route('bidang.index')->with([
            'message' => 'Bidang/Departemen baru berhasil ditambahkan!',
            'status' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bidang  $bidang
     * @return \Illuminate\Http\Response
     */
    public function edit(Bidang $bidang)
    {
        return view('bidang.edit', [
            'title_page' => 'Edit Bidang',
            'bidang' => $bidang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBidangRequest  $request
     * @param  \App\Models\Bidang  $bidang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBidangRequest $request, Bidang $bidang)
    {
        $validatedData = $request->validated();

        $bidang->update($validatedData);

        return redirect()->route('bidang.index')->with([
            'message' => 'Data Bidang/Departemen berhasil diperbarui!',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bidang  $bidang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bidang $bidang)
    {
        $bidang->delete();

        return redirect()->route('bidang.index')->with([
            'message' => 'Data Bidang/Departemen berhasil dihapus!',
            'status' => 'success'
        ]);
    }
}
