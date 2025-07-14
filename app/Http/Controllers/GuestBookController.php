<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreGuestBookRequest;
use App\Http\Requests\UpdateGuestBookRequest;

class GuestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(GuestBook::with('bidang')->orderBy('created_at','DESC')->get());
        View::share([
            'title_page' => 'Buku Tamu',
            'tamu' => GuestBook::with('bidang')->orderBy('created_at','DESC')->get(),
        ]);
        return view('tamu.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            View::share([
            'title_page' => 'Buku Tamu',
            'bidangs' => Bidang::orderBy('created_at','DESC')->get(),
        ]);
        
        return view('tamu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGuestBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi manual
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'keperluan' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidangs,id',
        ]);

        GuestBook::create([
            'nama' => $validated['nama'],
            'no_ktp' => $validated['no_ktp'],
            'alamat' => $validated['alamat'],
            'no_wa' => $validated['no_wa'],
            'keperluan' => $validated['keperluan'],
            'bidang_id' => $validated['bidang_id'],
            'hari' => \Carbon\Carbon::now()->locale('id')->isoFormat('dddd'),
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
            'jam_keluar' => now()->addHour()->toTimeString(),
            "sudah_dikirim_notif" => 0,
        ]);
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function show(GuestBook $guestBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data= GuestBook::findOrFail($id);
        // dd($data);
            View::share([
            'title_page' => 'Edit Data Tamu',
            'tamu' => $data,
            'bidangs' => Bidang::orderBy('created_at','DESC')->get(),
        ]);
        
        return view('tamu.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGuestBookRequest  $request
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'keperluan' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidangs,id',

        ]);


        $data = GuestBook::findOrFail($id);
        // Pastikan hanya mengupdate data yang diizinkan
        // dd($data);

        $data->update([
            'nama' => $validated['nama'],
            'no_ktp' => $validated['no_ktp'],
            'alamat' => $validated['alamat'],
            'no_wa' => $validated['no_wa'],
            'keperluan' => $validated['keperluan'],
            'bidang_id' => $validated['bidang_id'],
        ]);
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil di Edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = GuestBook::findOrFail($id);
        $data->delete();
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil dihapus.');        
    }
}
