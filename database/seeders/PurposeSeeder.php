<?php

namespace Database\Seeders;

use App\Models\Purpose;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purposes = [
            [
                'name' => 'Kunjungan Kerja',
                'description' => 'Kedatangan tamu dalam rangka kunjungan kerja resmi.'
            ],
            [
                'name' => 'Rapat / Meeting',
                'description' => 'Tamu datang untuk menghadiri rapat atau pertemuan.'
            ],
            [
                'name' => 'Mengantar Surat / Dokumen',
                'description' => 'Kunjungan untuk mengantarkan surat, berkas, atau dokumen penting.'
            ],
            [
                'name' => 'Wawancara / Lamaran Pekerjaan',
                'description' => 'Tamu datang untuk proses wawancara atau melamar pekerjaan.'
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Tujuan kedatangan lain di luar daftar yang disebutkan.'
            ],
        ];

        foreach ($purposes as $purpose) {
            Purpose::firstOrCreate(['name' => $purpose['name']], $purpose);
        }
    }
}
