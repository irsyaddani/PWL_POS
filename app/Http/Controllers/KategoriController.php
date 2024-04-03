<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create(): View
    {
        return view('kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // KategoriModel::create([
        //     'kategori_kode' => $request->kodeKategori,
        //     'kategori_nama' => $request->namaKategori,
        // ]);
        $validated = $request->validate([
            'kategori_kode' => 'required',
            'kategori_nama' => 'required',
        ]);

        return redirect('/kategori');
    }

    public function edit($id)
    {
        $data = KategoriModel::find($id);

        return view('kategori.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $data = KategoriModel::find($id);

        $data->kategori_kode = $request->kodeKategori;
        $data->kategori_nama = $request->namaKategori;
        $data->save();

        return redirect('/kategori');
    }

    public function destroy($id)
    {
        $data = KategoriModel::find($id);

        $data->delete();
        
        return redirect('/kategori');
    }
}