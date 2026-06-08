@extends('layouts.app')

@section('content')
    @if (Session::has('correcto'))
        <div class="container mb-4">
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 border-0" role="alert" style="background-color: #d4edda; border-left: 5px solid #28a745;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill" style="font-size: 1.5rem; color: #28a745; margin-right: 1rem;"></i>
                    <div>
                        <strong style="color: #155724;">¡Perfecto!</strong>
                        <p class="mb-0" style="color: #155724;">{{ Session::get('correcto') }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="card border-0 shadow-sm rounded-3">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient border-0 rounded-top-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="d-flex align-items-center py-3">
                            <i class="bi bi-person-gear text-white" style="font-size: 1.5rem;"></i>
                            <h5 class="text-white ms-3 mb-0">{{ __('Gestión de Perfil') }}</h5>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <form action="{{ route('usuario.guardar') }}" method="POST">
                            @csrf

                            <!-- Nombre Field -->
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre"
                                    name="nombre"
                                    value="{{ old('nombre', Auth::user()->nombre ?? Auth::user()->name) }}"
                                    placeholder="{{ __('Nombre') }}"
                                    required
                                >
                                <label for="nombre">
                                    <i class="bi bi-person me-2"></i>{{ __('Nombre Completo') }}
                                </label>
                                @error('nombre')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-floating mb-2">
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="{{ __('Contraseña') }}"
                                    autocomplete="new-password"
                                >
                                <label for="password">
                                    <i class="bi bi-lock me-2"></i>{{ __('Nueva Contraseña') }}
                                </label>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted d-block mb-3">
                                <i class="bi bi-info-circle me-1"></i>{{ __('Deja este campo en blanco si no deseas cambiar tu contraseña.') }}
                            </small>

                            <!-- Confirm Password Field -->
                            <div class="form-floating mb-4">
                                <input
                                    type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="{{ __('Confirmar Contraseña') }}"
                                    autocomplete="new-password"
                                >
                                <label for="password_confirmation">
                                    <i class="bi bi-lock-check me-2"></i>{{ __('Confirmar Contraseña') }}
                                </label>
                                @error('password_confirmation')
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
                                    <i class="bi bi-check-lg me-2"></i>{{ __('Actualizar Perfil') }}
                                </button>
                                <a
                                    href="{{ route('album.index') }}"
                                    class="btn btn-outline-secondary rounded-pill fw-semibold"
                                >
                                    <i class="bi bi-arrow-left me-2"></i>{{ __('Volver') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="alert alert-info mt-4 rounded-3 border-0">
                    <i class="bi bi-shield-check me-2"></i>
                    <small>
                        {{ __('Tu información personal está protegida y nunca será compartida con terceros.') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
