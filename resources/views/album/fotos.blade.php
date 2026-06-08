@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="mb-5">
        <!-- Title & Navigation -->
        <div class="mb-4">
            <a href="{{ route('album.index') }}" class="text-muted text-decoration-none small mb-3 d-inline-block">
                <i class="bi bi-arrow-left me-1"></i>Volver a Álbumes
            </a>
            <h1 class="fw-bold mb-1" style="color: #2c3e50;">
                <i class="bi bi-images me-2" style="color: #667eea;"></i>{{ $album->album_nombre }}
            </h1>
            <p class="text-muted">{{ $album->album_descripcion ?: 'Sin descripción' }}</p>
        </div>

        <!-- Action Button -->
        <a href="{{ route('foto.crear', ['album_id' => $album->album_id]) }}" class="btn btn-primary rounded-pill shadow-sm" style="padding: 0.75rem 2rem; font-weight: 600;">
            <i class="bi bi-plus-lg me-2"></i>Agregar Foto
        </a>
    </div>

    @if(sizeof($fotos)>0)
        <!-- Photos Grid -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        @foreach($fotos as $foto)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition" style="transition: all 0.3s ease;">
                    <!-- Photo Image -->
                    <div style="position: relative; height: 200px; overflow: hidden;">
                        <img src="{{ $foto->foto_ruta }}" 
                             class="w-100 h-100" 
                             alt="{{ $foto->foto_nombre }}" 
                             style="object-fit: cover;">
                    </div>

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50; font-size: 1.1rem;">
                            {{ $foto->foto_nombre }}
                        </h5>
                        <p class="card-text text-muted flex-grow-1" style="font-size: 0.95rem; line-height: 1.5;">
                            {{ Str::limit($foto->foto_descripcion, 80) ?: 'Sin descripción' }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 mt-auto pt-3">
                            <a href="{{ route('foto.editar', ['foto_id' => $foto->foto_id]) }}" class="btn btn-sm btn-outline-success rounded-pill fw-600 flex-grow-1">
                                <i class="bi bi-pencil me-1"></i>Editar
                            </a>
                            <a href="{{ route('foto.eliminar_vista', ['foto_id' => $foto->foto_id]) }}" class="btn btn-sm btn-outline-danger rounded-pill fw-600 flex-grow-1">
                                <i class="bi bi-trash me-1"></i>Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center py-5">
                    <div style="font-size: 4rem; color: #bdc3c7; margin-bottom: 1rem;">
                        <i class="bi bi-image"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #2c3e50;">No hay fotos en este álbum</h4>
                    <p class="text-muted mb-4">Comienza agregando fotos a tu álbum.</p>
                    <a href="{{ route('foto.crear', ['album_id' => $album->album_id]) }}" class="btn btn-primary rounded-pill px-4" style="padding: 0.75rem 2rem; font-weight: 600;">
                        <i class="bi bi-plus-lg me-2"></i>Agregar Foto
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
