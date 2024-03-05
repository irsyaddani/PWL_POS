<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jumlah_barang = 10;

        for ($i = 1; $i <= $jumlah_barang; $i++) {
            $barang = [
                'kategori_id' => rand(1,5), 
                'barang_kode' => 'BRG' . str_pad($i, 3, '0', STR_PAD_LEFT), 
                'barang_nama' => 'Barang ' . $i,
                'harga_beli' => rand(1000, 10000),
                'harga_jual' => rand(10000, 20000), 
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert data seed ke dalam tabel
            DB::table('m_barang')->insert($barang);
        }
    }
}
