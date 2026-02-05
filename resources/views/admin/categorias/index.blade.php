
@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"> Gestión de Categorías</h2>
        <a href="{{ route('admincategorias.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Categoría
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Nombre</th>
                    <th class="text-center">Peticiones Activas</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="ps-4">{{ $category->id }}</td>
                        <td class="fw-bold">{{ $category->name }}</td>
                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $category->petitions->count() }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admincategorias.edit', $category->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admincategorias.delete', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que quieres borrarla?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
