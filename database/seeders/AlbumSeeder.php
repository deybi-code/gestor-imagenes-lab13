<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AlbumSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::all();
        $contador = 0;

        foreach ($usuarios as $usuario) {
            $cantidad = mt_rand(0,15);
            for ($i=0; $i < $cantidad; $i++) {
                $contador++;
                // Corregido a 'album' en singular para SQLite
                DB::table('album')->insert([
                    'album_nombre' => "Nombre Album $contador",
                    'album_descripcion' => "Descripción álbum $contador",
                    'usuario_id' => $usuario->id,
                ]);
            }
        }
    }
}