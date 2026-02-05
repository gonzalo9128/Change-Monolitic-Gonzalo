@extends('layouts.admin')

@section('content')
    <h2 class="mb-4 fw-bold"> Gestión de Usuarios</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol Actual</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="ps-4">{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                {{-- Inicial del nombre en un círculo gris --}}
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role_id == 2)
                                <span class="badge bg-danger">ADMIN</span>
                            @else
                                <span class="badge bg-secondary">Usuario</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">

                            @if($user->id != Auth::id())
                                <form action="{{ route('adminusers.role', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    @if($user->role_id == 1)
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Hacer Admin">
                                             Ascender
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Quitar Admin">
                                             Eliminar
                                        </button>
                                    @endif
                                </form>

                                <form action="{{ route('adminusers.delete', $user->id) }}" method="POST" class="d-inline ms-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small fst-italic">Tu cuenta</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
