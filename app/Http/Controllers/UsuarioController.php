<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ActualizarPerfilRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UsuarioController extends Controller
{
    public function getActualizar(): View
    {
        return view('usuario.actualizar');
    }

    public function postActualizar(ActualizarPerfilRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $usuario */
        $usuario = Auth::user();

        // Actualizar el nombre
        $usuario->nombre = $request->get('nombre');

        // Si el modelo usa 'name' por defecto en lugar de 'nombre', descomenta la siguiente línea:
        // $usuario->name = $request->get('nombre');

        // Actualizar contraseña solo si el usuario escribió una nueva
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->get('password'));
        }

        $usuario->save();

        return redirect()->route('usuario.actualizar')->with('correcto', 'Su perfil ha sido actualizado correctamente.');
    }
}
