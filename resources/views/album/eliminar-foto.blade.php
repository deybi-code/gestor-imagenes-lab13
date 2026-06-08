@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirmar Eliminación de Foto') }}</div>

                <div class="card-body">
                    <div class="alert alert-warning">
                        <strong>¿Está seguro de que desea eliminar la foto "{{ $foto->foto_nombre }}"?</strong>
                        <p>Esta acción no se puede deshacer.</p>
                    </div>

                    <form method="POST" action="{{ route('foto.eliminar', ['foto_id' => $foto->foto_id]) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            {{ __('Eliminar Foto') }}
                        </button>
                    </form>

                    <a href="{{ route('album.fotos', ['album_id' => $foto->album_id]) }}" class="btn btn-secondary">
                        {{ __('Cancelar') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
