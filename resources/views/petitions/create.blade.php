@extends("layouts.public")

@section("content")
    <main class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <h1 class="display-5 fw-bold text-center mb-3">Inicia tu petición</h1>
                <p class="lead fs-4 text-center mb-5">Plantea tu solución y moviliza a otras personas para conseguir el cambio.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card p-4 p-md-5 create-petition-card">

                    <form action="{{ route('petitions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="peticionTitulo" class="form-label">1. ¿Cuál es el título de tu petición?</label>
                            <input type="text" name="title" class="form-control" id="peticionTitulo" placeholder="Ej: Salven a las abejas de los pesticidas" value="{{ old('title') }}" required>
                            <div class="form-text">Debe ser corto, directo y claro.</div>
                        </div>

                        <div class="mb-4">
                            <label for="peticionDestinatario" class="form-label">2. ¿A quién le pides el cambio?</label>
                            <input type="text" name="destinatary" class="form-control" id="peticionDestinatario" placeholder="Ej: Ministra de Agricultura, Alcalde de Madrid..." value="{{ old('destinatary') }}" required>
                            <div class="form-text">Elige a la persona o entidad que puede tomar la decisión.</div>
                        </div>

                        <div class="mb-4">
                            <label for="peticionHistoria" class="form-label">3. ¿Por qué es importante esta petición?</label>
                            <textarea name="description" class="form-control" id="peticionHistoria" rows="8" placeholder="Describe el problema y por qué es urgente solucionarlo. Incluye tu solución propuesta." required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="peticionTema" class="form-label">4. Elige un tema</label>
                            <select name="category_id" class="form-select" id="peticionTema" required>
                                <option value="" selected disabled>Elige una categoría...</option>

                                {{-- BUCLE DINÁMICO --}}
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-5">
                            <label for="peticionImagen" class="form-label">5. Añade una foto o vídeo</label>
                            <input name="file" class="form-control" type="file" id="peticionImagen" required>
                            <div class="form-text">Las peticiones con elementos visuales reciben 6 veces más apoyo.</div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-danger btn-lg rounded-pill fw-bold px-5 py-3">
                                Publicar mi petición
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
