@extends('layouts.public')

@section('content')
    <section class="container mt-5 mb-5">

        <h2 class="fw-bold mb-4 border-bottom pb-2">{{ $title ?? 'Listado de Peticiones' }}</h2>

        @if($petitions->isEmpty())
            <div class="alert alert-info text-center">
                <h4>Vaya, no hay peticiones todavía.</h4>
                <p>¡Sé el primero en cambiar el mundo!</p>
                <a href="{{ route('petitions.create') }}" class="btn btn-danger rounded-pill fw-bold">Inicia una petición</a>
            </div>
        @else

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($petitions as $petition)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 petition-card hover-shadow transition">

                            {{-- IMAGEN: REAL O DEFAULT --}}
                            <div class="ratio ratio-16x9">
                                @if(count($petition->files) > 0)
                                    {{-- EL TRUCO: Forzamos la ruta 'petitions/' SIN la palabra storage --}}
                                    <img src="{{ asset('petitions/' . basename($petition->files->last()->file_path)) }}"
                                         class="card-img-top object-fit-cover"
                                         alt="{{ $petition->title }}">
                                @else
                                    <img src="https://picsum.photos/seed/{{ $petition->id }}/400/250"
                                         class="card-img-top object-fit-cover"
                                         alt="Imagen genérica">
                                @endif
                            </div>

                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">
                                    <a href="{{ route('petitions.show', $petition->id) }}" class="text-decoration-none text-dark">
                                        {{ Str::limit($petition->title, 50) }}
                                    </a>
                                </h5>

                                {{-- AUTOR --}}
                                <div class="card-author d-flex align-items-center my-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 14px;">
                                        {{ substr($petition->user->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="small text-muted">por </span>
                                    <span class="fs-6 fw-bold ms-1">{{ $petition->user->name ?? 'Anónimo' }}</span>
                                </div>

                                <p class="card-text small text-muted">
                                    {{ Str::limit($petition->description, 90) }}
                                </p>
                            </div>

                            <div class="card-footer bg-white border-0 pt-0 pb-4">
                                <div class="progress mb-2" style="height: 6px;">
                                    @php
                                        $meta = ($petition->signers < 100) ? 100 : $petition->signers + 100;
                                        $percent = ($petition->signers / $meta) * 100;
                                    @endphp
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percent }}%"></div>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold small">{{ number_format($petition->signers) }} firmantes</span>
                                    <span class="text-muted small">meta: {{ number_format($meta) }}</span>
                                </div>
                                {{-- BOTONES: EDITAR (si es mía) O FIRMAR (si es de otro) --}}
                                @if(Auth::check() && Auth::id() == $petition->user_id)
                                    <div class="d-flex gap-2">
                                        {{-- Botón EDITAR (50% ancho) --}}
                                        <a href="{{ route('petitions.edit', $petition->id) }}" class="btn btn-outline-warning w-50 rounded-pill fw-bold">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>

                                        <form action="{{ route('petitions.destroy', $petition->id) }}" method="POST" class="w-50"
                                              onsubmit="return confirm('¿Estás seguro de que quieres borrar esta petición? No hay vuelta atrás.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100 rounded-pill fw-bold">
                                                <i class="bi bi-trash"></i> Borrar
                                            </button>
                                        </form>
                                    </div>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </section>
@endsection
