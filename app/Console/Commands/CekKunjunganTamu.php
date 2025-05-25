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

        $tamus = Tamu::where('sudah_dikirim_notif', 0)
            ->whereTime('jam_keluar', '<=', $now->copy()->addMinutes(10))
            ->whereTime('jam_keluar', '>', $now)
            ->get();

        foreach ($tamus as $tamu) {
            $message = "Halo {$tamu->nama}, kunjungan Anda akan berakhir dalam 10 menit.";
            
            Http::post('http://127.0.0.1:3000/send-message', [
                'number' => $tamu->no_wa,
                'message' => $message
            ]);

            $tamu->sudah_dikirim_notif = 1;
            $tamu->save();
        }

        $this->info('Pengecekan selesai.');
    }
}
