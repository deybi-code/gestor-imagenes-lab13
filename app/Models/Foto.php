<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foto extends Model
{
    protected $table = 'foto';

    protected $fillable = [
        'album_id',
        'foto_nombre',
        'foto_descripcion',
        'foto_ruta',
    ];

    protected $primaryKey = 'foto_id';

    /**
     * Get the album that owns the photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'album_id');
    }
}