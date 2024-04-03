<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\LevelModel;

class LevelController extends Controller
{
    public function index()
    {
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' .$row . ' baris';

        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row . ' baris';

        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }

    public function tambah() {
        return view('level_tambah');
    }
    public function tambah_simpan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'level_id' => 'required|unique:m_level|max:255',
            'level_nama' => 'required',
            'level_kode' => 'required',
            
        ]);

        LevelModel::create($validated);
        return redirect('/level');
    }
}
