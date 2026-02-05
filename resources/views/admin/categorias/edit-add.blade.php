
@extends('layouts.admin')

@section('content')
    <div class="container" style="max-width: 600px;">
        <h2 class="mb-4">{{ isset($category) ? 'Editar Categoría' : 'Nueva Categoría' }}</h2>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ isset($category) ? route('admincategorias.update', $category->id) : route('admincategorias.store') }}" method="POST">
                    @csrf
                    @if(isset($category)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name ?? '' }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admincategorias.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($category) ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
