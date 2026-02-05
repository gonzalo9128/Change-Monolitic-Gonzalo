@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Detalles de la Petición #{{ $petition->id }}</h3>
                <a href="{{ route('adminpeticiones.index') }}" class="btn btn-secondary">Volver</a>
            </div>

            <div class="card-body">
                {{-- TÍTULO Y DESCRIPCIÓN --}}
                <h2 class="card-title text-primary">{{ $petition->title }}</h2>

                <p class="card-text mt-3">
                    <strong>Descripción completa:</strong><br>
                    {{ $petition->description }}
                </p>

                {{-- IMAGEN --}}
                <div class="card mb-4 border-0">
                    <div class="card-body text-center">
                        @if($petition->files->count() > 0)
                            <img src="{{ asset('petitions/' . $petition->files->first()->name) }}"
                                 alt="Imagen de la petición"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px; object-fit: cover;">
                        @else
                            <div class="alert alert-secondary d-inline-block">
                                Esta petición no tiene imágenes adjuntas.
                            </div>
                        @endif
                    </div>
                </div>

                <hr>

                {{-- DATOS GENERALES --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Total Firmas:</strong>
                            {{-- ¡AQUÍ ESTABA EL ERROR! Hay que poner ->count() o usar ->signers --}}
                            <span class="fs-4 d-block">{{ $petition->firmantes->count() }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Estado:</strong>
                            {{-- Lógica de colores y texto corregida --}}
                            <span class="badge bg-{{ $petition->status == 'accepted' ? 'success' : ($petition->status == 'rejected' ? 'danger' : 'warning') }} fs-6 d-block mt-1">
                                {{ ucfirst($petition->status ?? $petition->state) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Autor ID:</strong>
                            <span class="d-block">{{ $petition->user_id }}</span>
                        </div>
                    </div>
                </div>

                <hr>

                {{-- LISTADO DE FIRMANTES --}}
                <h4 class="mt-4"> Usuarios que han firmado</h4>

                @if($petition->firmantes->count() > 0)
                    <table class="table table-striped table-hover mt-3">
                        <thead class="table-dark">
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de Registro</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($petition->firmantes as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="alert alert-warning mt-3">Aún nadie ha firmado esta petición.</p>
                @endif

            </div>
        </div>
    </div>
@endsection
