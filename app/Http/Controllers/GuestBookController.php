<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bidang;
use App\Models\Purpose;
use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
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
            'tamu' => [] // atau null jika kamu ingin default kosong
        ]);

        return view('tamu.create');
    }

    // public function previewSpm(StoreGuestBookRequest $request)
    // {
    //     $validatedData = $request->validated();
    //     $validatedData['jam_masuk'] = now();
    //     $validatedData['user_id'] = auth()->id();

    //     $imgPath = public_path('assets/img/spm-qrcode.jpg');

    //     if (!file_exists($imgPath)) {
    //         return back()->withInput()->with([
    //             'message' => 'SPM Link Gagal. File QRCode tidak ditemukan.',
    //             'status' => 'error'
    //         ]);
    //     }

    //     $response = Http::attach('file', file_get_contents($imgPath), 'qrcode.png')
    //         ->post('https://api.qrserver.com/v1/read-qr-code/');

    //     $data = $response->json();

    //     if (empty($data[0]['symbol'][0]['data'])) {
    //         return back()->withInput()->with([
    //             'message' => 'SPM Link Gagal. QRCode tidak dapat dibaca.',
    //             'status' => 'error'
    //         ]);
    //     }

    //     $decodedText = $data[0]['symbol'][0]['data'];

    //     // Kirim data ke create.view untuk ditampilkan di modal
    //     return view('tamu.create', [
    //         'title_page' => 'Buku Tamu Digital',
    //         'bidangs' => Bidang::orderBy('created_at', 'DESC')->get(),
    //         'purposes' => Purpose::orderBy('created_at', 'DESC')->get(),
    //         'tamu' => $validatedData,
    //         'spm_link' => $decodedText
    //     ]);
    // }

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

        // Arahkan agar tamu masuk ke link spm untuk pengisian survei
        // QRCode File Path
        $imgPath = public_path('assets/img/spm-qrcode.jpg');
        // Pastikan file ada
        if (!file_exists($imgPath)) {
            return back()->withInput()->with([
                'message' => 'SPM Link Gagal. Pastikan file QRCode ke SPM ada dan formatnya benar.',
                'status' => 'error'
            ]);
        }
        // Decode QRCode menggunakan API eksternal (API dari api.qrserver.com)
        $response = Http::attach('file', file_get_contents($imgPath), 'qrcode.png')->post('https://api.qrserver.com/v1/read-qr-code/');
        $data = $response->json();
        if (!empty($data[0]['symbol'][0]['data'])) {
            // Simpan data tamu jika SPM Link berhasil
            GuestBook::create($validatedData);
            $decodedText = $data[0]['symbol'][0]['data'];
            // return redirect()->to($decodedText);
            return response()->json([
                'status' => 'success',
                'message' => 'Register Tamu Berhasil, Silahkan isi survei SPM!',
                'spm_link' => $decodedText // hasil decode dari QRCode
            ]);
        } else {
            // dd("Failed to decode QRCode.");
            return back()->withInput()->with([
                'message' => 'SPM Link Gagal. Pastikan file QRCode ke SPM ada dan formatnya benar.',
                'status' => 'error'
            ]);
        }


        // return redirect()->route('tamu.index')->with([
        //     'message' => 'Data tamu baru berhasil ditambahkan!',
        //     'status' => 'success'
        // ]);
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
