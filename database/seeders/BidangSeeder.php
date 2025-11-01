<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidangs = [
            [
                'name' => 'Bidang Pemerintahan',
                'description' => 'Mengurusi administrasi pemerintahan dan pelayanan publik.'
            ],
            [
                'name' => 'Bidang Keuangan',
                'description' => 'Mengelola keuangan dan anggaran instansi.'
            ],
            [
                'name' => 'Bidang Pembangunan',
                'description' => 'Mengawasi dan melaksanakan kegiatan pembangunan fisik dan non-fisik.'
            ],
            [
                'name' => 'Bidang Kesejahteraan Rakyat',
                'description' => 'Menangani urusan sosial, pendidikan, dan kesehatan masyarakat.'
            ],
            [
                'name' => 'Bidang Umum dan Kepegawaian',
                'description' => 'Mengatur urusan kepegawaian, tata usaha, dan umum.'
            ],
        ];

        foreach ($bidangs as $bidang) {
            Bidang::firstOrCreate(['name' => $bidang['name']], $bidang);
        }
    }
}
