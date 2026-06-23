<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): \Illuminate\Http\RedirectResponse {
    return redirect()->route('login');
});

Route::get('/home', function (): \Illuminate\Http\RedirectResponse {
    return redirect()->route('album.index');
})->middleware('auth')->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.intento');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function (): void {
    Route::get('/usuario/actualizar', [UsuarioController::class, 'getActualizar'])->name('usuario.actualizar');
    Route::post('/usuario/actualizar', [UsuarioController::class, 'postActualizar'])->name('usuario.guardar');

    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/album/crear', [AlbumController::class, 'getCrear'])->name('album.crear');
    Route::post('/album/crear', [AlbumController::class, 'postCrear'])->name('album.guardar');
    Route::get('/album/actualizar', [AlbumController::class, 'getActualizar'])->name('album.actualizar');
    Route::post('/album/actualizar', [AlbumController::class, 'postActualizar'])->name('album.actualizar.guardar');
    Route::get('/album/eliminar', [AlbumController::class, 'getEliminar'])->name('album.eliminar');
    Route::post('/album/eliminar', [AlbumController::class, 'postEliminar'])->name('album.eliminar.confirmar');

    Route::get('/album/fotos', [FotoController::class, 'index'])->name('album.fotos');
    Route::get('/foto/crear', [FotoController::class, 'getCrear'])->name('foto.crear');
    Route::post('/foto/crear', [FotoController::class, 'postCrear'])->name('foto.guardar');
    Route::get('/foto/actualizar', [FotoController::class, 'getActualizar'])->name('foto.actualizar');
    Route::post('/foto/actualizar', [FotoController::class, 'postActualizar'])->name('foto.actualizar.guardar');
    Route::get('/foto/eliminar', [FotoController::class, 'getEliminar'])->name('foto.eliminar');
    Route::post('/foto/eliminar', [FotoController::class, 'postEliminar'])->name('foto.eliminar.confirmar');
});

