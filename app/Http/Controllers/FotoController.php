<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Http\Requests\CrearFotoRequest;
use App\Http\Requests\ActualizarFotoRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FotoController extends Controller
{
    /**
     * Display all photos for a specific album.
     */
    public function index(Request $request): View
    {
        $album_id = $request->get('album_id');
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
    public function getCrear(Request $request): View
    {
        $album_id = $request->get('album_id');
        $album = Album::findOrFail($album_id);
        return view('album.crear-foto', ['album' => $album]);
    }

    /**
     * Store a newly created photo in the database.
     */
    public function postCrear(CrearFotoRequest $request): RedirectResponse
    {
        $album_id = $request->get('album_id');

        $imagen = $request->file('foto_imagen');
        $ruta = '/img/';
        $nombreUnico = sha1(Carbon::now()) . "." . $imagen->guessExtension();
        $imagen->move(public_path() . $ruta, $nombreUnico);

        Foto::create([
            'album_id' => $album_id,
            'foto_nombre' => $request->get('foto_nombre'),
            'foto_descripcion' => $request->get('foto_descripcion') ?? '',
            'foto_ruta' => $ruta . $nombreUnico,
        ]);

        return redirect()->route('album.fotos', ['album_id' => $album_id])->with('correcto', 'Foto creada exitosamente');
    }

    /**
     * Show the form to edit a photo.
     */
    public function getActualizar(Request $request): View
    {
        $foto_id = $request->get('foto_id');
        $foto = Foto::findOrFail($foto_id);
        return view('album.editar-foto', ['foto' => $foto]);
    }

    /**
     * Update the specified photo in the database.
     */
    public function postActualizar(ActualizarFotoRequest $request): RedirectResponse
    {
        $foto_id = $request->get('foto_id');
        $foto = Foto::findOrFail($foto_id);

        Gate::authorize('update', $foto);

        $foto->foto_nombre = $request->get('foto_nombre');
        $foto->foto_descripcion = $request->get('foto_descripcion') ?? '';

        if ($request->hasFile('foto_imagen')) {
            $imagen = $request->file('foto_imagen');
            $ruta = '/img/';
            $nombreUnico = sha1(Carbon::now()) . "." . $imagen->guessExtension();
            $imagen->move(public_path() . $ruta, $nombreUnico);
            $foto->foto_ruta = $ruta . $nombreUnico;
        }

        $foto->save();

        return redirect('/album/fotos?album_id=' . $foto->album_id)->with('correcto', 'La foto ha sido actualizada');
    }

    /**
     * Show confirmation to delete a photo.
     */
    public function getEliminar(Request $request): View
    {
        $foto_id = $request->get('foto_id');
        $foto = Foto::findOrFail($foto_id);
        return view('album.eliminar-foto', ['foto' => $foto]);
    }

    /**
     * Delete the specified photo from the database.
     */
    public function postEliminar(Request $request): RedirectResponse
    {
        $foto_id = $request->get('foto_id');
        $foto = Foto::findOrFail($foto_id);

        Gate::authorize('delete', $foto);

        $album_id = $foto->album_id;
        $foto->delete();

        return redirect()->route('album.fotos', ['album_id' => $album_id])->with('correcto', 'Foto eliminada exitosamente');
    }
}
