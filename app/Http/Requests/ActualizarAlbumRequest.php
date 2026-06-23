<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarAlbumRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'album_id' => 'required|exists:album,album_id',
            'album_nombre' => 'required|string|max:255',
            'album_descripcion' => 'required|string|max:1000'
        ];
    }
}
