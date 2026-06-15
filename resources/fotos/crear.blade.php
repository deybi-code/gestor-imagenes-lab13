@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Crear Foto</div>
            <div class="card-body">
                <form method="POST" action="/foto/crear?album_id={{$album_id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="imagen" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Subir y Crear Foto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
