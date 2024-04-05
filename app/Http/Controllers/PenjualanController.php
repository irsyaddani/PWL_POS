<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    //menampilkan halaman awal 
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan']
        ];
    
        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'penjualan'; //set menu yg sedang aktif
    
        $user = UserModel::all(); 
        
        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,  'activeMenu' => $activeMenu]);
    } 

    // Ambil data dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $penjualans = PenjualanModel::query()->with('user');
        
        //Filter data  berdasarkan penjualan_id
        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }
        

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    //menampilkan halaman form tambah 
    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Tambah transaksi penjualan baru'
        ];
    
        $user = UserModel::all(); //ambil data  untuk ditampilkan di form
        $activeMenu = 'penjualan'; //set menu yang sedang aktif
    
        return view ('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    //menyimpan data baru
    public function store(Request $request) {
        $request->validate([
            'user_id'=>'required|integer',
            'pembeli' => 'required|string', 
            'penjualan_kode' => 'required|string', 
            'penjualan_tanggal' => 'required|date',
        ]);
    
        PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli, 
            'penjualan_kode' => $request->penjualan_kode, 
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);
    
        return redirect('/penjualan')->with('success', 'Data transaksi penjualan berhasil disimpan'); 
    }
    //menampilkan detail 
    public function show (string $id) {
        $penjualan = PenjualanModel::with('user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan'; //set menu yang sedang aktif

        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'activeMenu' => $activeMenu]);
    }

    //menampilkan halaman form edit 

    public function edit (string $id) {
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit transaksi penjualan'
        ];

        $user = UserModel::all(); 
        $activeMenu = 'penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user'=> $user, 'activeMenu' => $activeMenu]);
    }

    //menyimpan perubahan data 
    public function update (Request $request, string $id) {

        $request->validate([
            'user_id'=>'required|integer',
            'pembeli' => 'required|string', 
            'penjualan_kode' => 'required|string', 
            'penjualan_tanggal' => 'required|date',
        ]);

        PenjualanModel::find($id)->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli, 
            'penjualan_kode' => $request->penjualan_kode, 
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);
    
        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah'); 
    }

    //menghapus data 
    public function destroy (string $id) {
        $check = PenjualanModel::find($id);
        if (!$check) { //untuk mengecek apakah data  dengan id yang dimaksud ada atau tidak
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }
        try {
            PenjualanModel::destroy($id); //hapus data 
            return redirect ('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e) {
            //jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}