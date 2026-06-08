@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirmar Eliminación de Álbum') }}</div>

                <div class="card-body">
                    <div class="alert alert-warning">
                        <strong>¿Está seguro de que desea eliminar el álbum "{{ $album->album_nombre }}"?</strong>
                        <p>Se eliminarán todas las fotos asociadas a este álbum. Esta acción no se puede deshacer.</p>
                    </div>

                    <form method="POST" action="{{ route('album.eliminar', ['album_id' => $album->album_id]) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            {{ __('Eliminar Álbum') }}
                        </button>
                    </form>

                    <a href="{{ route('album.index') }}" class="btn btn-secondary">
                        {{ __('Cancelar') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
