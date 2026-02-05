@extends('layouts.public')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Peticiones que has firmado</h2>

        @if($petitions->count() > 0)
            <div class="row">
                @foreach($petitions as $petition)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            {{-- IMAGEN --}}
                            @if($petition->files->count() > 0)
                                <img src="{{ asset('petitions/' . $petition->files->first()->name) }}"
                                     class="card-img-top"
                                     alt="{{ $petition->title }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">Sin imagen</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $petition->title }}</h5>
                                <p class="card-text text-muted small">
                                    {{ Str::limit($petition->description, 100) }}
                                </p>

                                {{-- BARRA DE PROGRESO --}}
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                </div>
                                <small class="text-success fw-bold">
                                    <i class="bi bi-check-circle"></i> Firmado
                                </small>
                            </div>

                            <div class="card-footer bg-white border-top-0">
                                <a href="{{ route('petitions.show', $petition->id) }}" class="btn btn-outline-danger w-100">Ver Petición</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <h4>Aún no has firmado ninguna petición.</h4>
                <p>¡Explora las peticiones activas y apoya las causas que te importan!</p>
                <a href="{{ route('petitions.index') }}" class="btn btn-primary mt-2">Ver Peticiones</a>
            </div>
        @endif
    </div>
@endsection
