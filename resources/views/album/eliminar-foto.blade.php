@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirmar Eliminación de Foto') }}</div>

                <div class="card-body">
                    <div class="alert alert-warning">
                        <strong>{{ __('¿Está seguro de que desea eliminar la foto') }} "{{ $foto->foto_nombre }}"?</strong>
                        <p>{{ __('Esta acción no se puede deshacer.') }}</p>
                    </div>

                    <!-- Formulario ajustado a POST para coincidir con web.php -->
                    <form method="POST" action="/foto/eliminar" style="display: inline;">
                        @csrf
                        <!-- Campo oculto para pasar el ID de la foto -->
                        <input type="hidden" name="foto_id" value="{{ $foto->foto_id }}">

                        <button type="submit" class="btn btn-danger">
                            {{ __('Eliminar Foto') }}
                        </button>
                    </form>

                    <a href="/album/fotos?album_id={{ $foto->album_id }}" class="btn btn-secondary">
                        {{ __('Cancelar') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
