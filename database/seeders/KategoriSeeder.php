<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data seed
        $kategori = [
            [
                'kategori_kode' => 'KTG001',
                'kategori_nama' => 'Kategori A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'KTG002',
                'kategori_nama' => 'Kategori B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'KTG003',
                'kategori_nama' => 'Kategori C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'KTG004',
                'kategori_nama' => 'Kategori D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'KTG005',
                'kategori_nama' => 'Kategori E',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data seed ke dalam tabel
        DB::table('m_kategori')->insert($kategori);
    }
}
