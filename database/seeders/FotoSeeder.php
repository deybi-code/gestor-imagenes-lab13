<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Foto;
use App\Models\Album;

class FotoSeeder extends Seeder
{
    public function run()
    {
        $albumes = Album::all();
        $contador = 0;

        foreach ($albumes as $album) {
            $cantidad = mt_rand(0,5);
            for ($i=0; $i < $cantidad; $i++) {
                $contador++;
                Foto::create([
                    'foto_nombre' => "Nombre Foto $contador",
                    'foto_descripcion' => "Descripción foto $contador",
                    'foto_ruta' => "/img/text.png",
                    'album_id' => $album->album_id,
                ]);
            }
        }
    }
}