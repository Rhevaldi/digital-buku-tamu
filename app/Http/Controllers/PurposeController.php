<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use App\Http\Requests\StorePurposeRequest;
use App\Http\Requests\UpdatePurposeRequest;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Purpose::orderBy('created_at', 'desc')->get();

        return view('purpose.index', [
            'title_page' => 'Daftar Keperluan',
            'purposes' => $purposes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purpose.create', [
            'title_page' => 'Tambah Keperluan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurposeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurposeRequest $request)
    {
        $validatedData = $request->validated();

        Purpose::create($validatedData);

        return redirect()->route('purpose.index')->with([
            'message' => 'Keperluan baru berhasil ditambahkan!',
            'status' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function edit(Purpose $purpose)
    {
        return view('purpose.edit', [
            'title_page' => 'Edit Keperluan',
            'purpose' => $purpose,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurposeRequest  $request
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurposeRequest $request, Purpose $purpose)
    {
        $validatedData = $request->validated();

        $purpose->update($validatedData);

        return redirect()->route('purpose.index')->with([
            'message' => 'Data Keperluan berhasil diperbarui!',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purpose $purpose)
    {
        $purpose->delete();

        return redirect()->route('purpose.index')->with([
            'message' => 'Data Keperluan berhasil dihapus!',
            'status' => 'success'
        ]);
    }
}
