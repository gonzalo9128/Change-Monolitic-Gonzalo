@extends('layouts.public')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Editar Petición</h1>

        <div class="card p-4 shadow-sm border-0">
            <form action="{{ route('petitions.update', $petition->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Título --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Título</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $petition->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Destinatario (Autoridad)</label>
                    <input type="text" name="destinatary" class="form-control"
                           value="{{ old('destinatary', $petition->destinatary) }}" required>
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $petition->description) }}</textarea>
                </div>

                {{-- Categoría --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Categoría</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ ($petition->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                @if(count($petition->files) > 0)
                    <div class="mb-2">
                        <p class="small fw-bold">Imagen actual:</p>
                        <img src="{{ asset('petitions/' . basename($petition->files->last()->file_path)) }}"
                             alt="Imagen actual" style="width: 150px; height: auto; object-fit: cover;" class="rounded shadow-sm">
                    </div>
                @endif

                <div class="mb-4">
                    <label class="form-label fw-bold">Cambiar Imagen (Opcional)</label>
                    <input type="file" name="file" class="form-control">
                    <div class="form-text">Deja esto vacío si quieres mantener la foto actual.</div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning fw-bold">Actualizar Petición</button>
                    <a href="{{ route('petitions.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
