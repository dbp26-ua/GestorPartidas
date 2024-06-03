<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="center">
        <div class="col">
            <h2>Listado de juegos</h2>
        </div>
    </div>

    <div class="center">
        <a href="{{ route('admin.boardgames.create') }}" class="btn btn-dark btn-sm">Crear juego</a>
    </div>

    <div class="row mt-3 center">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Validado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boardgames as $boardgame)
                        <tr>
                            <td>{{ $boardgame->name }}</td>
                            <td>{{ $boardgame->description }}</td>
                            <td>{{ $boardgame->valid ? 'Sí' : 'No' }}</td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="{{ route('admin.boardgames.edit', $boardgame->id) }}">Editar</a>
                                @if(!$boardgame->valid)
                                    <a href="{{ route('admin.boardgames.validate', $boardgame->id) }}" class="btn btn-success btn-sm">Validar</a>
                                @endif
                                <form action="{{ route('admin.boardgames.delete', $boardgame->id) }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

<style>
.center {
    display: flex;
    justify-content: center;
    margin: 0 auto;
    width: 95%;
    text-align: center;
}
</style>
@endsection