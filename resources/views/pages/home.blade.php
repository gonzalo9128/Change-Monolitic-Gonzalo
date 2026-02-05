@extends('layouts.public')

@section('content')
    <main class="hero-section position-relative">

        {{-- TEXTO CENTRAL --}}
        <div class="hero-content text-center">
            <h1 class="display-4 fw-bold mb-3">El altavoz más grande del mundo</h1>
            <p class="lead fs-4 mb-4">Inicia una petición para pedirle a quienes toman las decisiones lo que quieres cambiar.</p>
            <a href="{{ route('petitions.create') }}" class="btn btn-danger btn-lg rounded-pill px-5 py-3 fw-bold">
                Iniciar una petición
            </a>
        </div>

        {{-- CÍRCULO 1 --}}
        {{-- Quitados los 'style', ahora usará tu CSS global --}}
        <div id="p1" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="{{ asset('assets/img/circulo1.jpg') }}" class="rounded-circle shadow-lg" alt="Petición Abejas">
            <p class="mt-2 fw-bold small">"Salva a las abejas"</p>
        </div>

        {{-- CÍRCULO 2 --}}
        <div id="p2" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="{{ asset('assets/img/circulo1.jpg') }}" class="rounded-circle shadow-lg" alt="Petición Parques">
            <p class="mt-2 fw-bold small">"Parques para todos"</p>
        </div>

        {{-- CÍRCULO 3 --}}
        <div id="p3" class="petition-bubble position-absolute d-none d-md-block">
            <img src="{{ asset('assets/img/circulo1.jpg') }}" class="rounded-circle shadow-lg" alt="Petición Transporte">
            <p class="mt-2 fw-bold small">"Transporte público"</p>
        </div>

        {{-- CÍRCULO 4 --}}
        <div id="p4" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="{{ asset('assets/img/circulo1.jpg') }}" class="rounded-circle shadow-lg" alt="Petición Agua">
            <p class="mt-2 fw-bold small">"Agua limpia ya"</p>
        </div>

        {{-- CÍRCULO 5 --}}
        <div id="p5" class="petition-bubble position-absolute d-none d-lg-block">
            <img src="{{ asset('assets/img/circulo1.jpg') }}" class="rounded-circle shadow-lg" alt="Petición Reciclaje">
            <p class="mt-2 fw-bold small">"Reciclaje obligatorio"</p>
        </div>

    </main>
@endsection
