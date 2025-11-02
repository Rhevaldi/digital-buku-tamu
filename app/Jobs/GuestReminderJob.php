<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\GuestBook;

class GuestReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nama;
    protected $no_wa;
    protected $id;

    public function __construct($nama, $no_wa, $id)
    {
        $this->nama = $nama;
        $this->no_wa = $no_wa;
        $this->id = $id;
    }

    public function handle(): void
    {
        try {
            $nomor = preg_replace('/^0/', '62', $this->no_wa);
            $pesan = "Halo {$this->nama}, waktu kunjungan Anda akan segera berakhir dalam 10 menit. Terima kasih atas kunjungannya 🙏";

            $response = Http::post('http://localhost:3000/send-message', [
                'number' => "{$nomor}@c.us",
                'message' => $pesan
            ]);
            
                $guestbook = GuestBook::findOrFail($this->id);
                $guestbook->update([
                    'jam_keluar' => now()->addMinutes(10)->format('H:i:s'),
                    'sudah_dikirim_notif' => 1,
                ]);

            if ($response->successful()) {
                Log::info("✅ Reminder terkirim ke {$this->nama} ({$nomor})");

            } else {
                Log::error("❌ Gagal kirim reminder ke {$this->nama} ({$nomor})");
            }
        } catch (\Exception $e) {
            Log::error("⚠️ Error kirim pengingat: " . $e->getMessage());
        }
    }
}
