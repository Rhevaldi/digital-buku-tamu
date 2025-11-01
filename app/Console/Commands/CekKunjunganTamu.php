<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GuestBook as Tamu;
use Illuminate\Support\Facades\Http;

class CekKunjunganTamu extends Command
{
    protected $signature = 'tamu:cek-kunjungan';
    protected $description = 'Kirim WA ke tamu yang sisa 10 menit lagi';

    public function handle()
    {
        $now = now();
        $this->info('Waktu sekarang: ' . $now->format('H:i:s'));

        $tamus = Tamu::where('sudah_dikirim_notif', 0)
            ->whereBetween('jam_keluar', [$now, $now->copy()->addMinutes(10)])
            ->get();

        $this->info('Jumlah tamu ditemukan: ' . $tamus->count());

        foreach ($tamus as $tamu) {
            $message = "Halo {$tamu->nama}, kunjungan Anda akan berakhir dalam 10 menit.";

            // Format nomor: ubah 08 jadi 628
            $nomor = $tamu->no_wa;
            if (preg_match('/^08/', $nomor)) {
                $nomor = preg_replace('/^08/', '628', $nomor);
            }
            if (preg_match('/^\+62/', $nomor)) {
                $nomor = preg_replace('/^\+62/', '62', $nomor);
            }
            $nomor = preg_replace('/\D/', '', $nomor); // Hapus karakter non-angka

            try {
                $response = Http::post('http://127.0.0.1:3000/send-message', [
                    'number' => $nomor,
                    'message' => $message
                ]);

                $this->info("✅ WA terkirim ke: $nomor");

                $tamu->sudah_dikirim_notif = 1;
                $tamu->save();
            } catch (\Exception $e) {
                $this->error("❌ Gagal kirim WA ke $nomor: " . $e->getMessage());
            }
        }

        $this->info('Pengecekan selesai.');
    }
}
