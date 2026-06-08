<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use Illuminate\Support\Facades\Route;

// Redirección de la raíz del servidor
Route::get('/', function (): \Illuminate\Http\RedirectResponse {
    return redirect()->route('login');
});

// Alias de compatibilidad para la redirección por defecto de Auth clásico
Route::get('/home', function (): \Illuminate\Http\RedirectResponse {
    return redirect()->route('album.index');
})->middleware('auth')->name('home');

// Grupo de rutas para usuarios NO autenticados (Invitados)
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.intento');
});

// Ruta para cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Grupo de rutas protegidas del Laboratorio N° 13 (Requieren autenticación)
Route::middleware('auth')->group(function (): void {
    
    // ==========================================
    // RUTAS DE USUARIO (ACTUALIZAR PERFIL)
    // ==========================================
    Route::get('/usuario/actualizar', [UsuarioController::class, 'getActualizar'])->name('usuario.actualizar');
    Route::post('/usuario/actualizar', [UsuarioController::class, 'postActualizar'])->name('usuario.guardar');

    // ==========================================
    // RUTAS DE ÁLBUMES (CRUD COMPLETO)
    // ==========================================
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/album/crear', [AlbumController::class, 'getCrear'])->name('album.crear');
    Route::post('/album/crear', [AlbumController::class, 'postCrear'])->name('album.guardar');
    Route::get('/album/{album_id}/editar', [AlbumController::class, 'getActualizar'])->name('album.editar');
    Route::post('/album/{album_id}/editar', [AlbumController::class, 'postActualizar'])->name('album.actualizar');
    Route::get('/album/{album_id}/eliminar', [AlbumController::class, 'getEliminar'])->name('album.eliminar_vista');
    Route::delete('/album/{album_id}/eliminar', [AlbumController::class, 'postEliminar'])->name('album.eliminar');

    // ==========================================
    // RUTAS DE FOTOS (CRUD COMPLETO)
    // ==========================================
    Route::get('/album/{album_id}/fotos', [FotoController::class, 'index'])->name('album.fotos');
    Route::get('/album/{album_id}/foto/crear', [FotoController::class, 'getCrear'])->name('foto.crear');
    Route::post('/album/{album_id}/foto/crear', [FotoController::class, 'postCrear'])->name('foto.guardar');
    Route::get('/foto/{foto_id}/editar', [FotoController::class, 'getActualizar'])->name('foto.editar');
    Route::post('/foto/{foto_id}/editar', [FotoController::class, 'postActualizar'])->name('foto.actualizar');
    Route::get('/foto/{foto_id}/eliminar', [FotoController::class, 'getEliminar'])->name('foto.eliminar_vista');
    Route::delete('/foto/{foto_id}/eliminar', [FotoController::class, 'postEliminar'])->name('foto.eliminar');
});
