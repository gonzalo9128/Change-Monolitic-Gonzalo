<!DOCTYPE html>
<html lang="es">
<head>
    <title>Change.org</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Tus estilos globales --}}
    <link href="{{ asset('assets/css/globales.css') }}" rel="stylesheet">
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Iconos de Bootstrap (Opcional, para el globo terráqueo del footer) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 sticky-top">
    <div class="container">
        {{-- LOGO --}}
        {{-- Si no tienes ruta 'home', puedes cambiarlo por 'petitions.index' --}}
        <a class="navbar-brand fw-bold fs-4 text-danger" href="{{ url('/') }}">
            change.org
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            {{-- MENÚ IZQUIERDA --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('petitions.index') }}">Todas las peticiones</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('petitions.firmadas') ? 'active fw-bold' : '' }}"
                           href="{{ route('petitions.firmadas') }}">
                            Mis Firmas
                        </a>
                    </li>
                @endauth

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('petitions.mine') }}">Mis peticiones</a>
                    </li>
                @endauth
            </ul>

            {{-- MENÚ DERECHA --}}
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Salir</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                {{-- BOTÓN DESTACADO DE INICIAR PETICIÓN --}}
                <li class="nav-item ms-2">
                    <a class="btn btn-danger rounded-pill px-4 fw-bold" href="{{ route('petitions.create') }}">
                        Inicia una petición
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-light pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="fw-bold text-uppercase mb-3">Acerca de</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Sobre Change.org</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Impacto</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Empleo</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Equipo</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="fw-bold text-uppercase mb-3">Comunidad</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Prensa</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Normas de la Comunidad</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h6 class="fw-bold text-uppercase mb-3">Ayuda</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Ayuda</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Privacidad</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Términos</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold text-uppercase mb-3">Redes sociales</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">X (Twitter)</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Facebook</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Instagram</a></li>
                </ul>
            </div>
        </div>

        <hr class="my-4">

        <div class="row align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <p class="text-muted small mb-1">© 2025, Change.org, PBC</p>
                <p class="text-muted small mb-0">
                    Esta web está protegida por reCAPTCHA y por Google.
                </p>
            </div>

            <div class="col-md-4 d-flex justify-content-md-end">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe me-1"></i> Español (España)
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="#">English (United States)</a></li>
                        <li><a class="dropdown-item" href="#">Français (France)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
