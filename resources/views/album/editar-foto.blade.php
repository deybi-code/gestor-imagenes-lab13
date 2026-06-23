@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square text-white" style="font-size: 2rem;"></i>
                        <div class="ms-3">
                            <h5 class="text-white mb-0 fw-bold">{{ __('Editar Foto') }}</h5>
                            <small class="text-white-50">{{ $foto->foto_nombre }}</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('foto.actualizar') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="foto_id" value="{{ $foto->foto_id }}">

                        <div class="form-floating mb-3">
                            <input
                                id="foto_nombre"
                                type="text"
                                class="form-control @error('foto_nombre') is-invalid @enderror"
                                name="foto_nombre"
                                value="{{ old('foto_nombre', $foto->foto_nombre) }}"
                                placeholder="{{ __('Nombre de la Foto') }}"
                                required
                                autocomplete="off"
                                autofocus
                            >
                            <label for="foto_nombre">
                                <i class="bi bi-card-image me-2"></i>{{ __('Nombre de la Foto') }}
                            </label>
                            @error('foto_nombre')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <textarea
                                id="foto_descripcion"
                                class="form-control @error('foto_descripcion') is-invalid @enderror"
                                name="foto_descripcion"
                                placeholder="{{ __('Descripción') }}"
                                rows="3"
                                style="resize: none;"
                            >{{ old('foto_descripcion', $foto->foto_descripcion) }}</textarea>
                            <label for="foto_descripcion">
                                <i class="bi bi-file-text me-2"></i>{{ __('Descripción (Opcional)') }}
                            </label>
                            @error('foto_descripcion')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input
                                id="foto_imagen"
                                type="file"
                                class="form-control @error('foto_imagen') is-invalid @enderror"
                                name="foto_imagen"
                                placeholder="{{ __('Selecciona una Nueva Imagen (Opcional)') }}"
                                accept="image/*"
                            >
                            <label for="foto_imagen">
                                <i class="bi bi-image me-2"></i>{{ __('Nueva Imagen (Opcional)') }}
                            </label>
                            @error('foto_imagen')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button
                                type="submit"
                                class="btn btn-primary btn-lg rounded-pill fw-semibold"
                            >
                                <i class="bi bi-check-lg me-2"></i>{{ __('Actualizar') }}
                            </button>
                            <a
                                href="{{ route('album.fotos', ['album_id' => $foto->album_id]) }}"
                                class="btn btn-outline-secondary rounded-pill fw-semibold"
                            >
                                <i class="bi bi-arrow-left me-2"></i>{{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="alert alert-warning mt-4 rounded-3 border-0">
                <i class="bi bi-info-circle me-2"></i>
                <small>{{ __('Los cambios se aplicarán inmediatamente en tu galería.') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
