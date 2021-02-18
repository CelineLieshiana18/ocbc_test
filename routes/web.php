<?php

use App\Http\Controllers\BungaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasabahController;

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
Route::get('/angsuran',[NasabahController::class,'angsuran'])->name('angsuran');
Route::post('/lihatangsuran',[NasabahController::class,'lihatAngsuran'])->name('lihatAngsuran');
Route::get('/perubahanbunga',[BungaController::class,'perubahanBunga'])->name('perubahanBunga');
Route::post('/storebunga',[BungaController::class,'storebunga'])->name('storeBunga');
Route::get('/rekening',[NasabahController::class,'inputDataRekening'])->name('inputDataRekening');
Route::post('/storerekening',[NasabahController::class,'storeRekening'])->name('storeRekening');
Route::get('/', function () {
    return view('welcome');
})->name('/');
