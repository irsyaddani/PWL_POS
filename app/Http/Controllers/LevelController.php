<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Monolog\Level;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level  yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; 

        $level=LevelModel::all();

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level'=>$level, 'activeMenu' => $activeMenu]);
    }    

    public function list(Request $request)
    {
        $levels = LevelModel::query();

        if ($request->level_id) {
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Tambah level Baru'
        ];
    
        $level = LevelModel::all(); 
        $activeMenu = 'level'; 
    
        return view ('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            'level_kode' => 'required|string|max:10',
            'level_nama' => 'required|min:1',
        ]);
    
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);
    
        return redirect('/level')->with('success', 'Data level berhasil disimpan'); 
    }
    public function show (string $id) {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level'; 

        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function edit (string $id) {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Level user'
        ];

        $activeMenu = 'level';

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,  'activeMenu' => $activeMenu]);
    }
    public function update (Request $request, string $id) {

        $request->validate([
            'level_kode' => 'required|string|max:10', 
            'level_nama' => 'required|min:1', 
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);
    
        return redirect('/level')->with('success', 'Data level berhasil diubah'); 
    }

    public function destroy (string $id) {
        $check = LevelModel::find($id);
        if (!$check) { 
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }
        try {
            LevelModel::destroy($id);
            return redirect ('/level')->with('success', 'Data level berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}