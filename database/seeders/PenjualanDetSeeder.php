<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jumlah_penjualan_detail = 30;

        for ($i = 1; $i <= $jumlah_penjualan_detail; $i++) {
            $penjualan_detail = [
                'penjualan_id' => rand(1, 10), 
                'barang_id' => rand(1, 10), 
                'harga' => rand(1000, 20000), 
                'jumlah' => rand(1, 10), 
                'updated_at' => now(),
            ];

            DB::table('t_penjualan_detail')->insert($penjualan_detail);
        }
    }
}
