<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jumlah_penjualan = 10;

        for ($i = 1; $i <= $jumlah_penjualan; $i++) {
            $penjualan = [
                'user_id' => rand(1, 3), 
                'pembeli' => 'Pembeli ' . $i,
                'penjualan_kode' => 'PJN' . str_pad($i, 3, '0', STR_PAD_LEFT), 
                'penjualan_tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert data seed ke dalam tabel
            DB::table('t_penjualan')->insert($penjualan);
        }
    }
}
