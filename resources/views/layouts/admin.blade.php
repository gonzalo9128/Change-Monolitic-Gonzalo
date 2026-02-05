<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Panel Admin - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9; /* Gris muy suave para el fondo */
            overflow-x: hidden;
        }

        /* Sidebar (Barra Lateral) */
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background-color: #1a1d20; /* Oscuro elegante */
            color: white;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1.25rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #ec2c22; /* Rojo Change.org */
            border-bottom: 1px solid #333;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #page-content-wrapper {
            min-width: 100vw;
        }

        /* Enlaces del Sidebar */
        .list-group-item-action {
            background-color: transparent;
            color: #cfd2d6;
            border: none;
            padding: 15px 20px;
            font-weight: 500;
        }

        .list-group-item-action:hover {
            background-color: #2c3034;
            color: #ec2c22; /* Rojo al pasar el ratón */
        }

        .list-group-item-action.active {
            background-color: #ec2c22; /* Rojo activo */
            color: white;
            font-weight: bold;
        }

        .list-group-item-action i {
            margin-right: 10px;
        }

        /* Ajustes para pantalla grande */
        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }
            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }
        }

        /* Tarjetas del panel */
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>
<body>

<div class="d-flex" id="wrapper">

    <div class="border-end" id="sidebar-wrapper">
        <div class="sidebar-heading">Change.org <span class="text-white small fs-6">Admin</span></div>
        <div class="list-group list-group-flush mt-3">

            <a href="{{ route('adminpeticiones.index') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('adminpeticiones.*') ? 'active' : '' }}">
                <i class="bi bi-file-text"></i> Peticiones
            </a>

            <a href="{{ route('admincategorias.index') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('admincategorias.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Categorías
            </a>

            <a href="{{ route('adminusers.index') }}"
               class="list-group-item list-group-item-action {{ request()->routeIs('adminusers.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Usuarios
            </a>

            <div class="border-top border-secondary my-3"></div>

            {{-- VOLVER A LA WEB --}}
            <a href="{{ route('petitions.index') }}" class="list-group-item list-group-item-action text-warning">
                <i class="bi bi-arrow-left-circle"></i> Volver a la Web
            </a>
        </div>
    </div>

    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4 py-3">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">☰ Menú</button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Mi Perfil</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Cerrar Sesión</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4 px-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
            });
        }
    });
</script>

</body>
</html>
