<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Http\Requests\CrearFotoRequest;
use App\Http\Requests\ActualizarFotoRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon; // <--- AGREGA ESTO

class FotoController extends Controller
{
    /**
     * Display all photos for a specific album.
     */
    public function index(int $album_id): View
    {
        $album = Album::findOrFail($album_id);
        $fotos = $album->fotos;

        return view('album.fotos', [
            'fotos' => $fotos,
            'album' => $album
        ]);
    }

    /**
     * Show the form to create a new photo.
     */
    public function getCrear(int $album_id): View
    {
        $album = Album::findOrFail($album_id);
        return view('album.crear-foto', ['album' => $album]);
    }

    /**
     * Store a newly created photo in the database.
     */
    public function postCrear(CrearFotoRequest $request, int $album_id): RedirectResponse
    {
        $album = Album::findOrFail($album_id);

        // --- LÓGICA DE SUBIDA DE ARCHIVO ---
        $imagen = $request->file('imagen');
        $ruta = '/img/';
        $nombreUnico = sha1(Carbon::now()) . "." . $imagen->guessExtension();
        $imagen->move(public_path() . $ruta, $nombreUnico);
        // -----------------------------------

        Foto::create([
            'album_id' => $album_id,
            'foto_nombre' => $request->get('nombre'),
            'foto_descripcion' => $request->get('descripcion') ?? '',
            'foto_ruta' => $ruta . $nombreUnico, // Guardamos la ruta del archivo local
        ]);

        return redirect()->route('album.fotos', ['album_id' => $album_id])
                       ->with('correcto', 'Foto creada exitosamente');
    }

    /**
     * Show the form to edit a photo.
     */
    public function getActualizar(int $foto_id): View
    {
        $foto = Foto::findOrFail($foto_id);
        $album = $foto->album;
        Gate::authorize('update', $album);

        return view('album.editar-foto', ['foto' => $foto, 'album' => $album]);
    }

    /**
     * Update the specified photo in the database.
     */
    public function postActualizar(ActualizarFotoRequest $request, int $foto_id): RedirectResponse
    {
        $foto = Foto::findOrFail($foto_id);
        $album = $foto->album;
        Gate::authorize('update', $album);
        $albumId = $foto->album_id;

        $foto->update([
            'foto_nombre' => $request->get('nombre'),
            'foto_descripcion' => $request->get('descripcion') ?? '',
            'foto_ruta' => $request->get('url'),
        ]);

        return redirect()->route('album.fotos', ['album_id' => $albumId])
                       ->with('correcto', 'Foto actualizada exitosamente');
    }

    /**
     * Show confirmation to delete a photo.
     */
    public function getEliminar(int $foto_id): View
    {
        $foto = Foto::findOrFail($foto_id);
        $album = $foto->album;
        Gate::authorize('delete', $album);

        return view('album.eliminar-foto', ['foto' => $foto]);
    }

    /**
     * Delete the specified photo from the database.
     */
    public function postEliminar(int $foto_id): RedirectResponse
    {
        $foto = Foto::findOrFail($foto_id);
        $album = $foto->album;
        Gate::authorize('delete', $album);
        $albumId = $foto->album_id;

        $foto->delete();

        return redirect()->route('album.fotos', ['album_id' => $albumId])
                       ->with('correcto', 'Foto eliminada exitosamente');
    }
}
