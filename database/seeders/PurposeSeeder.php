<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purpose;

class PurposeSeeder extends Seeder
{
    public function run(): void
    {
        $purposes = [
            ['name' => 'Mengantar Proposal', 'description' => 'Tamu datang untuk menyerahkan proposal kegiatan, kerja sama, atau permohonan kepada bidang terkait.'],
            ['name' => 'Rapat / Koordinasi', 'description' => 'Kunjungan untuk menghadiri rapat atau pertemuan koordinasi dengan pihak dinas.'],
            ['name' => 'Konsultasi Teknis', 'description' => 'Tamu berkonsultasi terkait pembangunan, perumahan, atau kawasan permukiman.'],
            ['name' => 'Pengurusan Surat / Dokumen', 'description' => 'Mengurus administrasi seperti surat rekomendasi, permohonan izin, atau dokumen lain.'],
            ['name' => 'Penyerahan Surat / Berkas', 'description' => 'Menyerahkan dokumen resmi atau berkas administrasi tanpa proses diskusi panjang.'],
            ['name' => 'Wawancara / Observasi', 'description' => 'Kunjungan dalam rangka penelitian, wawancara, atau observasi lapangan.'],
            ['name' => 'Monitoring / Evaluasi', 'description' => 'Kunjungan lapangan atau koordinasi untuk kegiatan monitoring dan evaluasi program.'],
            ['name' => 'Audiensi', 'description' => 'Pertemuan resmi antara pihak luar dengan pejabat atau kepala bidang.'],
            ['name' => 'Magang / PKL', 'description' => 'Kunjungan atau kehadiran peserta magang/PKL dalam rangka pelaksanaan kegiatan belajar.'],
            ['name' => 'Lainnya', 'description' => 'Keperluan lain di luar kategori di atas.'],
        ];

        foreach ($purposes as $purpose) {
            Purpose::firstOrCreate(['name' => $purpose['name']], $purpose);
        }
    }
}
