<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="center">
        <div class="col">
            <h2>Listado de tableros</h2>
        </div>
    </div>

    <div class="center">
        <a href="{{ route('admin.boards.create') }}" class="btn btn-dark btn-sm">Crear tablero</a>
    </div>

    <div class="row mt-3 center">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Juego</th>
                        <th>Validado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boards as $board)
                        <tr>
                            <td>{{ $board->name }}</td>
                            <td>{{ $board->description }}</td>
                            <td>{{ $board->boardgame->name }}</td>
                            <td>{{ $board->valid ? 'Sí' : 'No' }}</td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="{{ route('admin.boards.edit', $board->id) }}">Editar</a>
                                @if(!$board->valid)
                                    <a href="{{ route('admin.boards.validate', $board->id) }}" class="btn btn-success btn-sm">Validar</a>
                                @endif
                                <form action="{{ route('admin.boards.delete', $board->id) }}" method="post" style="display:inline">
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