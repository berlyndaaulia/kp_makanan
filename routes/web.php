<?php

use App\Http\Controllers\MakananKhasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MakananKhasController::class, 'index']);
Route::post('/', [MakananKhasController::class, 'tambahMakananKhas'])->name('tambah.makanan.khas');
Route::post('/update/{makanan_khas_id}', [MakananKhasController::class, 'updateMakananKhas'])->name('update.makanan.khas');
Route::post('/hapus/{makanan_khas_id}', [MakananKhasController::class, 'hapusMakananKhas'])->name('hapus.makanan.khas');
