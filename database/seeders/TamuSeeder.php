<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bidang;
use App\Models\GuestBook;
use App\Models\Purpose;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidang = Bidang::inRandomOrder()->first() ?? Bidang::factory()->create();
        $purpose = Purpose::inRandomOrder()->first() ?? Purpose::factory()->create();
        $user = User::inRandomOrder()->first();

        $tamus = [
            [
                'bidang_id' => $bidang->id,
                'purpose_id' => $purpose->id,
                'user_id' => $user?->id,
                'nama' => 'Andi Pratama',
                'description' => 'Menghadiri rapat koordinasi dengan bidang pemerintahan.',
                'no_identitas' => '6471051201900001',
                'alamat' => 'Jl. Mawar No. 15, Tenggarong',
                'no_wa' => '6285156789012',
                'instansi' => 'Dinas Kominfo Kukar',
                'keperluan' => 'Rapat koordinasi program desa digital',
                'hari' => Carbon::now()->translatedFormat('l'),
                'tanggal' => Carbon::now()->toDateString(),
                'jam_masuk' => Carbon::now()->format('H:i:s'),
                'jam_keluar' => null,
                'sudah_dikirim_notif' => false,
            ],
            [
                'bidang_id' => $bidang->id,
                'purpose_id' => $purpose->id,
                'user_id' => $user?->id,
                'nama' => 'Rina Marlina',
                'description' => 'Mengantarkan surat resmi dari instansi terkait.',
                'no_identitas' => '6471052203900002',
                'alamat' => 'Jl. Pahlawan No. 10, Tenggarong',
                'no_wa' => '6285245678901',
                'instansi' => 'Dinas Pendidikan Kukar',
                'keperluan' => 'Mengantar surat undangan rapat',
                'hari' => Carbon::now()->translatedFormat('l'),
                'tanggal' => Carbon::now()->toDateString(),
                'jam_masuk' => Carbon::now()->subHours(1)->format('H:i:s'),
                'jam_keluar' => Carbon::now()->format('H:i:s'),
                'sudah_dikirim_notif' => true,
            ],
            [
                'bidang_id' => $bidang->id,
                'purpose_id' => $purpose->id,
                'user_id' => $user?->id,
                'nama' => 'Fahmi Saputra',
                'description' => 'Kunjungan kerja dalam rangka koordinasi antar bidang.',
                'no_identitas' => '6471050504800003',
                'alamat' => 'Jl. Melati No. 23, Loa Kulu',
                'no_wa' => '6285745673210',
                'instansi' => 'Bappeda Kukar',
                'keperluan' => 'Koordinasi program kerja tahunan',
                'hari' => Carbon::now()->translatedFormat('l'),
                'tanggal' => Carbon::now()->toDateString(),
                'jam_masuk' => Carbon::now()->subHours(2)->format('H:i:s'),
                'jam_keluar' => Carbon::now()->subHour()->format('H:i:s'),
                'sudah_dikirim_notif' => true,
            ],
        ];

        foreach ($tamus as $data) {
            GuestBook::create($data);
        }
    }
}
