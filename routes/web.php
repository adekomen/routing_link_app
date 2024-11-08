<?php

use App\Http\Controllers\LienController;
use App\Http\Controllers\RouteurController;
use App\Http\Controllers\SpfController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');


Route::get('/routeurs', [RouteurController::class, 'index'])->name('routeurs.index');
Route::post('/routeurs', [RouteurController::class, 'store'])->name('routeurs.store');
Route::post('/routeurs/store-final', [RouteurController::class, 'storeFinal'])->name('routeurs.store.final');

Route::get('/liens', [LienController::class, 'index'])->name('liens.index');
Route::post('/liens', [LienController::class, 'store'])->name('liens.store');
Route::get('/liens/afficher', [LienController::class, 'showAll'])->name('liens.showAll');

Route::get('/liens/{id}/edit', [LienController::class, 'edit'])->name('liens.edit');
Route::put('/liens/{id}', [LienController::class, 'update'])->name('liens.update');
Route::delete('/liens/{id}', [LienController::class, 'destroy'])->name('liens.destroy');

Route::get('/spf/{sourceId}', [SpfController::class, 'calculerSPF'])->name('spf.calculer');

Route::get('/reseau/visualiser', [SpfController::class, 'visualiserReseau'])->name('reseau.visualiser');
