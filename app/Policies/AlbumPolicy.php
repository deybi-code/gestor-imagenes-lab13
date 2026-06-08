<?php

namespace App\Policies;

use App\Models\Album;
use App\Models\User;

class AlbumPolicy
{
    /**
     * Determine whether the user can update the album.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Album  $album
     * @return bool
     */
    public function update(User $user, Album $album): bool
    {
        return $user->id == $album->usuario_id;
    }

    /**
     * Determine whether the user can delete the album.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Album  $album
     * @return bool
     */
    public function delete(User $user, Album $album): bool
    {
        return $user->id == $album->usuario_id;
    }
}
