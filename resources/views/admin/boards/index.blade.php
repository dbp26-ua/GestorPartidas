<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div>
        <div class="col">
            <h2>Listado de tableros</h2>
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
                        <th>Juego</th>
                        <th>Validado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boards as $board)
                        <tr>
                            <td>{{ $board->id }}</td>
                            <td>{{ $board->name }}</td>
                            <td>{{ $board->description }}</td>
                            <td>{{ $board->boardgame->name }}</td>
                            <td>{{ $board->valid ? 'Sí' : 'No' }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.boards.edit', $board->id) }}">Editar</a>
                                @if(!$board->valid)
                                    <a href="{{ route('admin.boards.validate', $board->id) }}" class="btn btn-success">Validar</a>
                                @endif
                                <form action="{{ route('admin.boards.delete', $board->id) }}" method="post" style="display:inline">
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
        <a href="{{ route('admin.boards.create') }}" class="btn btn-primary">Crear tablero</a>
    </div>
@endsection