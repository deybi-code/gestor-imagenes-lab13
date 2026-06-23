<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Models\Album;
use App\Http\Requests\CrearAlbumRequest;
use App\Http\Requests\ActualizarAlbumRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
    public function getCrear()
    {
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function getActualizar(Request $request)
    {
        $album_id = $request->get('album_id');
        $album = Album::find($album_id);
        return view('album.actualizar', ['album' => $album]);
    }

    /**
     * Update the specified album in the database.
     *
     * @param  \App\Http\Requests\ActualizarAlbumRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postActualizar(ActualizarAlbumRequest $request): RedirectResponse
    {
        $album_id = $request->get('album_id');
        $album = Album::findOrFail($album_id);

        Gate::authorize('update', $album);

        $album->update([
            'album_nombre' => $request->get('album_nombre'),
            'album_descripcion' => $request->get('album_descripcion'),
        ]);

        return redirect()->route('album.index')->with('correcto', 'El álbum ha sido actualizado');
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
