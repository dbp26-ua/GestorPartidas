<!DOCTYPE html>
@extends('layouts.app')

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
                        <th>Juego</th>
                        <th>Jugadores</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{ $game->boardgame->name }}</td>
                            <td>{{ $game->players }} / {{ $game->max_players }}</td>
                            <td>{{ $game->closed ? "Cerrado" : "Abierto" }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('games.show', $game->id) }}">Ver detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <a href="{{ route('games.create') }}" class="btn btn-primary">Crear partida</a>
    </div>
@endsection