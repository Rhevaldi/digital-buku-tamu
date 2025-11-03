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
            //  BAGIAN 
            [
                'name' => 'Sub Bagian Umum, Ketatalaksanaan dan Kepegawaian',
                'description' => 'Menangani administrasi umum, tata naskah dinas, ketatalaksanaan, kepegawaian, serta pelayanan internal pada Dinas Perumahan dan Kawasan Permukiman Kabupaten Kutai Kartanegara.'
            ],
            [
                'name' => 'Sub Bagian Keuangan dan Aset',
                'description' => 'Mengelola keuangan, anggaran, serta aset milik Dinas Perumahan dan Kawasan Permukiman secara tertib dan akuntabel.'
            ],

            //  BIDANG 
            [
                'name' => 'Bidang Perumahan',
                'description' => 'Melaksanakan penyusunan dan pelaksanaan kebijakan, pembinaan, serta pengawasan pembangunan rumah layak huni dan perumahan rakyat di wilayah Kabupaten Kutai Kartanegara.'
            ],
            [
                'name' => 'Bidang Kawasan Permukiman',
                'description' => 'Bertugas dalam penataan, pengembangan, dan peningkatan kualitas kawasan permukiman agar sesuai dengan standar lingkungan yang sehat, aman, dan berkelanjutan.'
            ],
            [
                'name' => 'Bidang Prasarana dan Sarana Utilitas Umum',
                'description' => 'Melaksanakan pembangunan, pemeliharaan, dan pengelolaan prasarana serta sarana utilitas umum dalam mendukung penyediaan perumahan dan kawasan permukiman.'
            ],
            [
                'name' => 'Bidang Sertifikasi, Kualifikasi, Klasifikasi, dan Registrasi Perumahan dan Kawasan Permukiman',
                'description' => 'Mengelola kegiatan sertifikasi, kualifikasi, klasifikasi, dan registrasi penyelenggaraan perumahan serta kawasan permukiman di lingkungan Dinas Perumahan dan Kawasan Permukiman Kabupaten Kutai Kartanegara.'
            ],
        ];

        foreach ($bidangs as $bidang) {
            Bidang::firstOrCreate(['name' => $bidang['name']], $bidang);
        }
    }
}
