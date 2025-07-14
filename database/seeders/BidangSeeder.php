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
            ['name' => 'Bagian Umum'],
            ['name' => 'Bagian Keuangan'],
            ['name' => 'Perumahan'],
            ['name' => 'Kawasan Permukiman'],
            ['name' => 'Prasarana dan Sarana Utilitas Umum (PSU)'],
            ['name' => 'Sertifikasi, Kualifikasi, Klasifikasi, dan Regestrasi'],
             ];

             foreach ($bidangs as $bidang) {
                Bidang::create([
                    'name' => $bidang['name'],
                ]);
             }
        //
    }
}
