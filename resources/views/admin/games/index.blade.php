<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div>
        <div class="col">
            <h2>Listado de partidas</h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Juego</th>
                        <th>Tablero</th>
                        <th>Creador</th>
                        <th>Cerrada</th>
                        <th>Jugadores</th>
                        <th>Lugar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{ $game->id }}</td>
                            <td>{{ $game->description }}</td>
                            <td>{{ $game->boardgame->name }}</td>
                            <td>{{ $game->board->name }}</td>
                            <td>{{ $game->creator->name }}</td>
                            <td>{{ $game->closed ? "Sí" : "No" }}</td>
                            <td>{{ $game->players }}/{{ $game->max_players }}</td>
                            <td>{{ $game->address }}, {{ $game->place }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.games.edit', $game->id) }}">Editar</a>
                                <form action="{{ route('admin.games.delete', $game->id) }}" method="post" style="display:inline">
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
        <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Crear partida</a>
    </div>
@endsection