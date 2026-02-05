@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Administración de Peticiones</h2>

        <a href="{{ route('adminpeticiones.create') }}" class="btn btn-primary mb-3">Añadir Petición</a>

        <table class="table table-striped align-middle"> <thead>
            <tr>
                <th>Id</th>
                <th>Imagen</th> <th>Titulo</th>
                <th>Descripcion</th>
                <th>Firmantes</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($peticiones as $peticion)
                <tr>
                    <td>{{ $peticion->id }}</td>

                    {{-- 2. LÓGICA DE LA IMAGEN --}}
                    <td>
                        @if($peticion->files->count() > 0)
                            {{-- Buscamos el primer archivo de la lista --}}
                            <img src="{{ asset('petitions/' . $peticion->files->first()->name) }}"
                                 alt="Imagen"
                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                        @else
                            <span class="text-muted small">Sin foto</span>
                        @endif
                    </td>

                    <td>{{ $peticion->title }}</td>
                    <td>{{ Str::limit($peticion->description, 50) }}</td> {{-- Truco: limitamos texto largo --}}
                    <td>{{ $peticion->signers }}</td>

                    <td>
                        {{-- Usamos status si lo cambiaste en BD, o state si sigue antiguo --}}
                        {{ $peticion->status ?? $peticion->state }}
                    </td>

                    <td>
                        <a href="{{ route('adminpeticiones.show', $peticion->id) }}" class="btn btn-info btn-sm">Ver</a>

                        <a href="{{ route('adminpeticiones.edit', $peticion->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('adminpeticiones.delete', $peticion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Borrar</button>
                        </form>

                        {{-- Botón opcional de estado --}}
                        {{--
                        <form action="{{ route('adminpeticiones.estado', $peticion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-secondary btn-sm">Cambiar Estado</button>
                        </form>
                        --}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
