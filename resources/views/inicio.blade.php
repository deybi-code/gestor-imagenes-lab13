@extends('layouts.app')

@section('content')
@if (Session::has('correcto'))
    <div class="alert alert-success">
        <strong>Realizado!</strong> Proceso Correcto.<br><br>
        {{Session::get('correcto')}}
    </div>
@endif
<div class="container">
    <div class="row justify-content-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bienvenido ') }}{{ Auth::user()->nombre }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
