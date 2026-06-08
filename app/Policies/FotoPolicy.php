<?php

namespace App\Policies;

use App\Models\Foto;
use App\Models\User;

class FotoPolicy
{
    /**
     * Determine whether the user can update the photo.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Foto  $foto
     * @return bool
     */
    public function update(User $user, Foto $foto): bool
    {
        return $user->id == $foto->album->usuario_id;
    }

    /**
     * Determine whether the user can delete the photo.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Foto  $foto
     * @return bool
     */
    public function delete(User $user, Foto $foto): bool
    {
        return $user->id == $foto->album->usuario_id;
    }
}
