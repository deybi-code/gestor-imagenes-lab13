<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
    protected $table = 'album';

    protected $fillable = [
        'usuario_id',
        'album_nombre',
        'album_descripcion',
    ];

    protected $primaryKey = 'album_id';

    /**
     * Get the user that owns the album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    /**
     * Get the photos for the album.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotos(): HasMany
    {
        return $this->hasMany(Foto::class, 'album_id', 'album_id');
    }
}
