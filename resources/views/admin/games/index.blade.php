<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="center">
        <div class="col">
            <h2>Listado de partidas</h2>
        </div>
    </div>

    <div class="center">
        <a href="{{ route('admin.games.create') }}" class="btn btn-dark btn-sm">Crear partida</a>
    </div>

    <div class="row mt-3 center">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
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
                            <td>{{ $game->description }}</td>
                            <td>{{ $game->boardgame->name }}</td>
                            <td>{{ $game->board->name }}</td>
                            <td>{{ $game->creator->name }}</td>
                            <td>{{ $game->closed ? "Sí" : "No" }}</td>
                            <td>{{ $game->players }}/{{ $game->max_players }}</td>
                            <td>{{ $game->address }}, {{ $game->place }}</td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="{{ route('admin.games.edit', $game->id) }}">Editar</a>
                                <a href="{{ route('admin.games.transferForm', $game->id) }}" class="btn btn-primary btn-sm">Transferir</a>
                                <form action="{{ route('admin.games.delete', $game->id) }}" method="post" style="display:inline">
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