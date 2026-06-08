@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
            <!-- Card Premium -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Card Header with Gradient -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square text-white" style="font-size: 2rem;"></i>
                        <div class="ms-3">
                            <h5 class="text-white mb-0 fw-bold">{{ __('Editar Álbum') }}</h5>
                            <small class="text-white-50">Actualiza los detalles de tu álbum</small>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('album.actualizar', ['album_id' => $album->album_id]) }}">
                        @csrf

                        <!-- Nombre Field -->
                        <div class="form-floating mb-3">
                            <input 
                                id="nombre" 
                                type="text" 
                                class="form-control @error('nombre') is-invalid @enderror" 
                                name="nombre" 
                                value="{{ old('nombre', $album->album_nombre) }}" 
                                placeholder="{{ __('Nombre del Álbum') }}"
                                required 
                                autocomplete="nombre" 
                                autofocus
                            >
                            <label for="nombre">
                                <i class="bi bi-folder me-2"></i>{{ __('Nombre del Álbum') }}
                            </label>
                            @error('nombre')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Descripción Field -->
                        <div class="form-floating mb-4">
                            <textarea 
                                id="descripcion" 
                                class="form-control @error('descripcion') is-invalid @enderror" 
                                name="descripcion" 
                                placeholder="{{ __('Descripción') }}"
                                rows="4"
                                style="resize: none;"
                            >{{ old('descripcion', $album->album_descripcion) }}</textarea>
                            <label for="descripcion">
                                <i class="bi bi-file-text me-2"></i>{{ __('Descripción (Opcional)') }}
                            </label>
                            @error('descripcion')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2">
                            <button 
                                type="submit" 
                                class="btn btn-primary btn-lg rounded-pill fw-semibold"
                            >
                                <i class="bi bi-check-lg me-2"></i>{{ __('Actualizar') }}
                            </button>
                            <a 
                                href="{{ route('album.index') }}" 
                                class="btn btn-outline-secondary rounded-pill fw-semibold"
                            >
                                <i class="bi bi-arrow-left me-2"></i>{{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-warning mt-4 rounded-3 border-0">
                <i class="bi bi-info-circle me-2"></i>
                <small>{{ __('Los cambios se aplicarán inmediatamente a tu álbum.') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
