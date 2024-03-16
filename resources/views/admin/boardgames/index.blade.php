<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div>
        <div class="col">
            <h2>Listado de juegos</h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Validado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boardgames as $boardgame)
                        <tr>
                            <td>{{ $boardgame->id }}</td>
                            <td>{{ $boardgame->name }}</td>
                            <td>{{ $boardgame->description }}</td>
                            <td>{{ $boardgame->valid ? 'Sí' : 'No' }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.boardgames.edit', $boardgame->id) }}">Editar</a>
                                @if(!$boardgame->valid)
                                    <a href="{{ route('admin.boardgames.validate', $boardgame->id) }}" class="btn btn-success">Validar</a>
                                @endif
                                <form action="{{ route('admin.boardgames.delete', $boardgame->id) }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <a href="{{ route('admin.boardgames.create') }}" class="btn btn-primary">Crear juego</a>
    </div>
@endsection