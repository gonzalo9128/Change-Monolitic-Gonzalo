@extends('layouts.public')

@section('content')
    <div class="container mt-5 mb-5">
        {{-- ALERTAS DE ÉXITO O ERROR --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            {{-- COLUMNA IZQUIERDA: INFORMACIÓN --}}
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">{{ $petition->title }}</h1>

                <div class="d-flex align-items-center mb-4 text-muted">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                        {{ substr($petition->user->name ?? 'A', 0, 1) }}
                    </div>
                    <span class="fw-bold text-dark me-2">{{ $petition->user->name ?? 'Usuario Anónimo' }}</span>
                    <span>ha iniciado esta petición dirigida a <span class="fw-bold text-dark">{{ $petition->destinatary }}</span></span>
                </div>

                <div class="ratio ratio-16x9 mb-4 rounded overflow-hidden shadow-sm">
                    {{-- CORRECCIÓN: Usamos la misma lógica que en Admin para la imagen --}}
                    @if($petition->files->count() > 0)
                        <img src="{{ asset('petitions/' . $petition->files->first()->name) }}"
                             class="object-fit-cover"
                             alt="{{ $petition->title }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light text-muted h-100">
                            Sin imagen destacada
                        </div>
                    @endif
                </div>

                <div class="fs-5 text-break">
                    <p>{{ $petition->description }}</p>
                </div>
            </div>

            {{-- COLUMNA DERECHA: CAJA DE FIRMAS --}}
            <div class="col-lg-4">
                <div class="card p-4 shadow-sm sticky-top" style="top: 100px; z-index: 1;">

                    <p class="mb-1">
                        <span class="fw-bold fs-4">{{ number_format($petition->signers) }}</span>
                        <span class="text-muted">personas han firmado</span>
                    </p>

                    <div class="progress mb-3" style="height: 10px;">
                        @php
                            $meta = ($petition->signers < 100) ? 100 : $petition->signers + 100;
                            $percent = ($petition->signers / $meta) * 100;
                        @endphp
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <p class="small text-muted mb-4">Ayúdanos a conseguir {{ number_format($meta) }} firmas</p>

                    @auth
                        {{-- CORRECCIÓN IMPORTANTE: Cambiado signatures -> firmantes --}}
                        @if($petition->firmantes->contains(Auth::user()->id))
                            <div class="alert alert-success text-center fw-bold">
                                <i class="bi bi-check-circle-fill"></i> ¡Ya has firmado!
                            </div>
                        @else
                            <div class="d-grid gap-2">
                                <form action="{{ route('petitions.firmar', $petition->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-lg w-100 rounded-pill fw-bold">
                                        ¡Firmar esta petición!
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-secondary text-center">
                            Debes iniciar sesión para firmar.
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-danger rounded-pill fw-bold">Iniciar sesión</a>
                            <a href="{{ route('register') }}" class="btn btn-link text-danger">Registrarse</a>
                        </div>
                    @endauth

                    <div class="mt-3 text-center small text-muted">
                        Al firmar, aceptas los términos de servicio.
                    </div>

                </div>

                {{-- ÚLTIMAS FIRMAS (CORREGIDO TAMBIÉN AQUÍ) --}}
                @if($petition->firmantes->count() > 0)
                    <div class="mt-4">
                        <h5 class="fw-bold border-bottom pb-2">Últimas firmas</h5>
                        {{-- CORRECCIÓN: signatures -> firmantes --}}
                        @foreach($petition->firmantes->take(3) as $signer)
                            <div class="d-flex align-items-center mt-3">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 12px;">
                                    {{ substr($signer->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold small">{{ $signer->name }}</p>
                                    <p class="mb-0 text-muted extra-small">firmó recientemente</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
