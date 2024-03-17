<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div>
        <h3>Filtros</h3>
        <form action="{{ route('games.filter') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="boardgame_id">Juego:</label>
                <select name="boardgame_id" id="boardgame_id" class="form-control">
                    <option value="-1"></option>
                    @foreach($boardgames as $boardgame)
                        <option value="{{ $boardgame->id }}" {{ $boardgame_id == $boardgame->id ? 'selected' : '' }}>{{ $boardgame->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="creator">Líder:</label>
                <input type="text" name="creator" id="creator" class="form-control" value="{{ $creator }}">
            </div>

            <div class="form-group">
                <label for="closed">Estado:</label>
                <select name="closed" id="closed" class="form-control">
                    <option value="-1" {{ $closed == -1 ? 'selected' : '' }}></option>
                    <option value="1" {{ $closed == 1 ? 'selected' : '' }}>Cerrada</option>
                    <option value="0" {{ $closed == 0 ? 'selected' : '' }}>Abierta</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $address }}">
            </div>

            <button type="submit" class="btn btn-success">Filtrar</button>
        </form>
    </div>

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
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{ $game->boardgame->name }}</td>
                            <td>{{ $game->players }} / {{ $game->max_players }}</td>
                            <td>{{ $game->closed ? "Cerrado" : "Abierto" }}</td>
                            <td>{{ $game->address }}, {{ $game->place }}</td>
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