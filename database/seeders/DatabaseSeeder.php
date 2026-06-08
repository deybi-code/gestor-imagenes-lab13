<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar llaves foráneas según el motor de base de datos
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        } elseif (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF');
        }

        // Limpiar las tablas antes de sembrar los datos (Todos deben ser delete)
        DB::table('foto')->delete();
        DB::table('album')->delete();
        DB::table('users')->delete();

        // Crear usuario principal para pruebas
        $usuario = User::create([
            'nombre' => 'Admin Test',
            'email' => 'admin@compured.com',
            'password' => Hash::make('password'),
        ]);

        // Crear 3 álbumes asociados al usuario
        $album1 = Album::create([
            'usuario_id' => $usuario->id,
            'album_nombre' => 'Vacaciones 2024',
            'album_descripcion' => 'Fotos de vacaciones en la playa',
        ]);

        $album2 = Album::create([
            'usuario_id' => $usuario->id,
            'album_nombre' => 'Familia',
            'album_descripcion' => 'Momentos familiares especiales',
        ]);

        $album3 = Album::create([
            'usuario_id' => $usuario->id,
            'album_nombre' => 'Naturaleza',
            'album_descripcion' => 'Paisajes y flora local',
        ]);

        // Crear 4 fotos dentro del primer álbum
        Foto::create([
            'album_id' => $album1->album_id,
            'foto_nombre' => 'Playa Sunset',
            'foto_descripcion' => 'Hermosa puesta de sol en la playa',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Playa+Sunset',
        ]);

        Foto::create([
            'album_id' => $album1->album_id,
            'foto_nombre' => 'Arena Blanca',
            'foto_descripcion' => 'Arena blanca de la costa caribeña',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Arena+Blanca',
        ]);

        Foto::create([
            'album_id' => $album1->album_id,
            'foto_nombre' => 'Mar Azul',
            'foto_descripcion' => 'Aguas cristalinas del mar caribeño',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Mar+Azul',
        ]);

        Foto::create([
            'album_id' => $album1->album_id,
            'foto_nombre' => 'Palmeras',
            'foto_descripcion' => 'Palmeras en la orilla de la playa',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Palmeras',
        ]);

        // Crear 2 fotos en el segundo álbum
        Foto::create([
            'album_id' => $album2->album_id,
            'foto_nombre' => 'Reunión Familiar',
            'foto_descripcion' => 'Todos juntos en la reunión',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Familia',
        ]);

        Foto::create([
            'album_id' => $album2->album_id,
            'foto_nombre' => 'Niños Jugando',
            'foto_descripcion' => 'Los niños disfrutando del parque',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Niños',
        ]);

        // Crear 2 fotos en el tercer álbum
        Foto::create([
            'album_id' => $album3->album_id,
            'foto_nombre' => 'Montañas',
            'foto_descripcion' => 'Picos nevados de montaña',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Montañas',
        ]);

        Foto::create([
            'album_id' => $album3->album_id,
            'foto_nombre' => 'Flores Silvestres',
            'foto_descripcion' => 'Coloridas flores del bosque',
            'foto_ruta' => 'https://via.placeholder.com/300?text=Flores',
        ]);

        // Volver a activar las llaves foráneas al finalizar
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        } elseif (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON');
        }
    }
}