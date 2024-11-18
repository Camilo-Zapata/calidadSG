<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AsistenteController;

use App\Http\Controllers\VerificacionController;

use App\Http\Controllers\TemaController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('dashboard')->group(function(){
    Route::get('tema', [TemaController::class, 'index'])->name('tema.index');
    Route::get('tema/create', [TemaController::class, 'create'])->name('tema.create');
    Route::post('tema', [TemaController::class, 'store'])->name('tema.store');
    Route::get('tema/{tema}/edit', [TemaController::class, 'edit'])->name('tema.edit');
    Route::post('tema/{tema}', [TemaController::class, 'update'])->name('tema.update');
    Route::delete('tema/{tema}', [TemaController::class, 'destroy'])->name('tema.destroy');


});


Route::get('/asistentes', [AsistenteController::class, 'index'])->name('asistentes.index');
Route::post('/asistentes', [AsistenteController::class, 'store'])->name('asistentes.store');
Route::delete('asistentes/{asistente}', [AsistenteController::class, 'destroy'])->name('asistentes.destroy');
Route::post('/asistentes/{asistente}', [AsistenteController::class, 'update'])->name('asistentes.update');



Route::prefix('temas/{tema}/verificaciones')->group(function () {
    Route::get('/', [VerificacionController::class, 'index'])->name('verificaciones.index');
    Route::post('/verificacion', [VerificacionController::class, 'store'])->name('verificaciones.store');
    Route::delete('/{verificacion}', [VerificacionController::class, 'destroy'])->name('verificaciones.destroy');
});
Route::get('/temas/{tema}/verificaciones/{verificacion}/edit', [VerificacionController::class, 'edit'])->name('verificaciones.edit');
Route::post('/temas/{tema}/verificaciones/{verificacion}', [VerificacionController::class, 'update'])->name('verificaciones.update');

require __DIR__.'/auth.php';
