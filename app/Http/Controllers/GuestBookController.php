<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bidang;
use App\Models\Purpose;
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
        View::share([
            'title_page' => 'Buku Tamu Digital',
            'tamu' => GuestBook::with('bidang')->orderBy('created_at', 'DESC')->get(),
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
            'title_page' => 'Buku Tamu Digital',
            'bidangs' => Bidang::orderBy('created_at', 'DESC')->get(),
            'purposes' => Purpose::orderBy('created_at', 'DESC')->get(),
        ]);

        return view('tamu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGuestBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuestBookRequest $request)
    {
        $validatedData = $request->validated();
        // Tambahkan kolom yang diisi otomatis
        $validatedData['jam_masuk'] = now(); // atau Carbon::now()
        $validatedData['user_id'] = auth()->id(); // ambil ID user yang sedang login
        GuestBook::create($validatedData);

        return redirect()->route('tamu.index')->with([
            'message' => 'Data tamu baru berhasil ditambahkan!',
            'status' => 'success'
        ]);
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
    public function edit(GuestBook $tamu)
    {
        return view('tamu.edit', [
            'title_page' => 'Edit Data Tamu',
            'bidangs' => Bidang::orderBy('created_at', 'DESC')->get(),
            'purposes' => Purpose::orderBy('created_at', 'DESC')->get(),
            'tamu' => $tamu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGuestBookRequest  $request
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuestBookRequest $request, GuestBook $tamu)
    {
        $validatedData = $request->validated();

        // Cek apakah jam_masuk berubah | Jika ada perubahan, reset jam_keluar ke null
        if ($validatedData['jam_masuk'] !== $tamu->jam_masuk) {
            $validatedData['jam_keluar'] = null;
        }

        $tamu->update($validatedData);

        return redirect()->route('tamu.index')->with([
            'message' => 'Data tamu berhasil diperbarui!',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuestBook $tamu)
    {
        $tamu->delete();

        return redirect()->route('tamu.index')->with([
            'message' => 'Data tamu berhasil dihapus!',
            'status' => 'success'
        ]);
    }


    public function selesaiKunjungan($id)
    {
        $tamu = GuestBook::findOrFail($id);
        $now = Carbon::now();

        // Jika waktu sekarang kurang dari jam_masuk, anggap kunjungan batal
        if ($now->lt(Carbon::parse($tamu->jam_masuk))) {
            $tamu->jam_keluar = $tamu->jam_masuk;

            // Tambahkan prefix "(KUNJUNGAN BATAL)" jika belum ada
            if (!str_starts_with($tamu->description, '(KUNJUNGAN BATAL)')) {
                $tamu->description = '(KUNJUNGAN BATAL) ' . $tamu->description;
            }
        } else {
            $tamu->jam_keluar = $now;
        }

        $tamu->save();

        return redirect()->route('tamu.index')->with([
            'message' => 'Kunjungan tamu berhasil diselesaikan!',
            'status' => 'success'
        ]);
    }
}
