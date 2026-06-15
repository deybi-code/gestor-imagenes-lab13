<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Models\Album;
use App\Http\Requests\CrearAlbumRequest;
use App\Http\Requests\ActualizarAlbumRequest;
use Illuminate\Http\RedirectResponse;

class AlbumController extends Controller
{
    /**
     * Display all albums for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        /** @var \App\Models\User $usuario */
        $usuario = Auth::user();
        $albumes = $usuario->albumes;

        return view('album.mostrar', ['albumes' => $albumes]);
    }

    /**
     * Show the form to create a new album.
     *
     * @return \Illuminate\View\View
     */
    public function getCrear() {
        return view('album.crear');
}
    /**
     * Store a newly created album in the database.
     *
     * @param  \App\Http\Requests\CrearAlbumRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCrear(CrearAlbumRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $usuario */
        $usuario = Auth::user();

        Album::create([
            'usuario_id' => $usuario->id,
            'album_nombre' => $request->get('nombre'),
            'album_descripcion' => $request->get('descripcion') ?? '',
        ]);

        return redirect()->route('album.index')->with('correcto', 'Álbum creado exitosamente');
    }

    /**
     * Show the form to edit an album.
     *
     * @param  int  $album_id
     * @return \Illuminate\View\View
     */
    public function getActualizar(int $album_id): View
    {
        $album = Album::findOrFail($album_id);
        Gate::authorize('update', $album);

        return view('album.editar', ['album' => $album]);
    }

    /**
     * Update the specified album in the database.
     *
     * @param  \App\Http\Requests\ActualizarAlbumRequest  $request
     * @param  int  $album_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postActualizar(ActualizarAlbumRequest $request, int $album_id): RedirectResponse
    {
        $album = Album::findOrFail($album_id);
        Gate::authorize('update', $album);

        $album->update([
            'album_nombre' => $request->get('nombre'),
            'album_descripcion' => $request->get('descripcion') ?? '',
        ]);

        return redirect()->route('album.index')->with('correcto', 'Álbum actualizado exitosamente');
    }

    /**
     * Show confirmation to delete an album.
     *
     * @param  int  $album_id
     * @return \Illuminate\View\View
     */
    public function getEliminar(int $album_id): View
    {
        $album = Album::findOrFail($album_id);
        Gate::authorize('delete', $album);

        return view('album.eliminar', ['album' => $album]);
    }

    /**
     * Delete the specified album from the database.
     *
     * @param  int  $album_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEliminar(int $album_id): RedirectResponse
    {
        $album = Album::findOrFail($album_id);
        Gate::authorize('delete', $album);

        $album->fotos()->delete();
        $album->delete();

        return redirect()->route('album.index')->with('correcto', 'Álbum eliminado exitosamente');
    }
}
