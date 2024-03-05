<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jumlah_stok = 10;

        for ($i = 1; $i <= $jumlah_stok; $i++) {
            $stok = [
                'barang_id' => rand(1, 10), 
                'user_id' => rand(1, 3), 
                'stok_tanggal' => now(),
                'stok_jumlah' => rand(10, 100), 
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert data seed ke dalam tabel
            DB::table('t_stok')->insert($stok);
        }
    }
}
