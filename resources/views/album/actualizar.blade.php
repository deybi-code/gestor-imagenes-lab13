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
                            <h5 class="text-white mb-0 fw-bold">{{ __('Actualizar Álbum') }}</h5>
                            <small class="text-white-50">{{ $album->album_nombre }}</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('album.actualizar.guardar') }}">
                        @csrf
                        <input type="hidden" name="album_id" value="{{ $album->album_id }}">

                        <div class="form-floating mb-3">
                            <input
                                id="album_nombre"
                                type="text"
                                class="form-control @error('album_nombre') is-invalid @enderror"
                                name="album_nombre"
                                value="{{ old('album_nombre', $album->album_nombre) }}"
                                placeholder="{{ __('Nombre del Álbum') }}"
                                required
                                autocomplete="off"
                                autofocus
                            >
                            <label for="album_nombre">
                                <i class="bi bi-bookmark me-2"></i>{{ __('Nombre del Álbum') }}
                            </label>
                            @error('album_nombre')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <textarea
                                id="album_descripcion"
                                class="form-control @error('album_descripcion') is-invalid @enderror"
                                name="album_descripcion"
                                placeholder="{{ __('Descripción del Álbum') }}"
                                rows="4"
                                style="resize: none;"
                                required
                            >{{ old('album_descripcion', $album->album_descripcion) }}</textarea>
                            <label for="album_descripcion">
                                <i class="bi bi-file-text me-2"></i>{{ __('Descripción del Álbum') }}
                            </label>
                            @error('album_descripcion')
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
                                <i class="bi bi-check-lg me-2"></i>{{ __('Actualizar Álbum') }}
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
        </div>
    </div>
</div>
@endsection

