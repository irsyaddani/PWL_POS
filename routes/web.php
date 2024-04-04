<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user', [UserController::class, 'index'])->name('/user');

// Route::get('/user/tambah', [UserController::class, 'tambah'])->name('/user/tambah');
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah'])->name('/user/ubah');
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('/user/hapus');
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan'])->name('/user/tambah_simpan');
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan'])->name('/user/ubah_simpan');

// // Route::get('/kategori', [KategoriController::class, 'index']);
// // Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// // Route::post('/kategori', [KategoriController::class, 'store']);

// // Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
// // Route::put('/kategori/{id}', [KategoriController::class, 'edit'])->name('kategori.update');
// // Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

// // Route::get('/kategori', [KategoriController::class, 'index']);

// // Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);

// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/{id}', [KategoriController::class, 'edit'])->name('kategori.update');
// Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan'])->name('user.tambah_simpan');
// Route::post('/level/tambah_simpan', [LevelController::class, 'tambah_simpan'])->name('level.tambah_simpan');
// Route::get('/level/tambah', [LevelController::class, 'tambah']);

// Route::resource('m_user', POSController::class);

// JOBSHEET 7
Route::get('/', [WelcomeController::class, 'index']);

Route::get('/', [WelcomeController::class, 'index']);
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);             //menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);         //menampilkan data user dalam bentuk json
    Route::get('/create', [UserController::class, 'create']);      //menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);            //menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);          //menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);     //menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);        //menampilkan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']);    //menghapus data user
});

