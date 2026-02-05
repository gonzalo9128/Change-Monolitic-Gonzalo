@extends('layouts.admin')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        {{-- Título dinámico --}}
        <h2>{{ isset($petition) ? 'Editar Petición' : 'Nueva Petición' }}</h2>

        {{-- LÓGICA DINÁMICA DEL FORMULARIO --}}
        @if(isset($petition))
            <form action="{{ route('adminpeticiones.update', $petition->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @else
                    <form action="{{ route('adminpeticiones.store') }}" method="POST" enctype="multipart/form-data">
                        @endif

                        @csrf

                        {{-- TÍTULO --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" class="form-control" value="{{ $petition->title ?? '' }}" required>
                        </div>

                        {{-- NUEVO: CATEGORÍA (Obligatorio) --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Selecciona una categoría...</option>
                                {{-- OJO: Necesitamos que el controlador mande $categories --}}
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (isset($petition) && $petition->category_id == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- NUEVO: DESTINATARIO (Obligatorio) --}}
                        <div class="mb-3">
                            <label for="destinatary" class="form-label">Destinatario (A quién va dirigida)</label>
                            <input type="text" name="destinatary" class="form-control" value="{{ $petition->destinatary ?? '' }}" required>
                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ $petition->description ?? '' }}</textarea>
                        </div>

                        {{-- ESTADO (Solo visible al editar) --}}
                        @if(isset($petition))
                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <select name="status" class="form-select">
                                    {{-- Comprobamos 'status' o 'state' por si acaso --}}
                                    @php $currentState = $petition->status; @endphp
                                    <option value="pending" {{ $currentState == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="accepted" {{ $currentState == 'accepted' ? 'selected' : '' }}>Aceptada</option>
                                    <option value="rejected" {{ $currentState == 'rejected' ? 'selected' : '' }}>Rechazada</option>
                                </select>
                            </div>
                        @endif

                        {{-- IMAGEN --}}
                        <div class="mb-3">
                            <label for="file" class="form-label">Imagen</label>
                            <input type="file" name="file" class="form-control">
                            @if($petition->files->count() > 0)
                                <div class="form-text text-success">
                                    Imagen actual: {{ $petition->files->first()->name }}
                                </div>
                            @endif
                        </div>

                        {{-- BOTONES --}}
                        <button type="submit" class="btn btn-primary">
                            {{ isset($petition) ? 'Actualizar' : 'Guardar' }}
                        </button>

                        <a href="{{ route('adminpeticiones.index') }}" class="btn btn-secondary">Cancelar</a>

                    </form>
    </div>
@endsection
