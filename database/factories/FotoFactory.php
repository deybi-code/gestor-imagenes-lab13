<?php

namespace Database\Factories;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Foto>
 */
class FotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'album_id' => Album::factory(),
            'foto_nombre' => fake()->words(2, true),
            'foto_descripcion' => fake()->sentence(),
            'foto_ruta' => 'https://via.placeholder.com/300?text='.fake()->words(2, true),
        ];
    }
}
