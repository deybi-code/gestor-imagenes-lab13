@extends('layouts.app')

@section('content')
@if(Session::has('correcto'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle me-2" style="font-size: 1.25rem;"></i>
            <div>
                <strong>¡Realizado!</strong> Proceso Correcto.<br>
                {{ Session::get('correcto') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container">
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-2" style="color: #2c3e50;">
                    <i class="bi bi-collection me-2" style="color: #667eea;"></i>Mis Álbumes
                </h1>
                <p class="text-muted">Organiza y gestiona tus colecciones de fotos</p>
            </div>
            <a href="{{ route('album.crear') }}" class="btn btn-primary rounded-pill shadow-sm" style="padding: 0.75rem 2rem; font-weight: 600;">
                <i class="bi bi-plus-lg me-2"></i>Crear Álbum
            </a>
        </div>
    </div>

    @if(sizeof($albumes)>0)
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        @foreach($albumes as $album)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition" style="transition: all 0.3s ease;">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 120px; display: flex; align-items: center; justify-content: center;">
                        <div style="text-align: center; color: white;">
                            <i class="bi bi-folder-fill" style="font-size: 3rem; opacity: 0.9;"></i>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1.1rem;">
                            {{ $album->album_nombre }}
                        </h5>
                        <p class="card-text text-muted flex-grow-1" style="font-size: 0.95rem; line-height: 1.5;">
                            {{ Str::limit($album->album_descripcion, 80) ?: 'Sin descripción' }}
                        </p>

                        <div class="d-grid gap-2 mt-auto pt-3">
                            <a href="/album/fotos?album_id={{ $album->album_id }}" class="btn btn-sm btn-outline-primary rounded-pill fw-600">
                                <i class="bi bi-images me-1"></i>Ver Fotos
                            </a>
                            <div class="d-flex gap-2">
                                <a href="/album/actualizar?album_id={{ $album->album_id }}" class="btn btn-sm btn-outline-success rounded-pill fw-600 flex-grow-1">
                                    <i class="bi bi-pencil me-1"></i>Editar
                                </a>
                                <a href="/album/eliminar?album_id={{ $album->album_id }}" class="btn btn-sm btn-outline-danger rounded-pill fw-600 flex-grow-1">
                                    <i class="bi bi-trash me-1"></i>Eliminar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center py-5">
                    <div style="font-size: 4rem; color: #bdc3c7; margin-bottom: 1rem;">
                        <i class="bi bi-folder-x"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #2c3e50;">No tienes álbumes aún</h4>
                    <p class="text-muted mb-4">Comienza creando tu primer álbum para organizar tus fotos favoritas.</p>
                    <a href="{{ route('album.crear') }}" class="btn btn-primary rounded-pill px-4" style="padding: 0.75rem 2rem; font-weight: 600;">
                        <i class="bi bi-plus-lg me-2"></i>Crear mi Primer Álbum
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .card:hover {
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2) !important;
        transform: translateY(-5px);
    }
</style>
@endsection
