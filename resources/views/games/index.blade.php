<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div style="margin: 0 auto; width:80%; text-align: center;">
        <form action="{{ route('games.filter') }}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="boardgame_id">Juego</label>
                    <select name="boardgame_id" id="boardgame_id" class="form-control">
                        <option value="-1"></option>
                        @foreach($boardgames as $boardgame)
                            <option value="{{ $boardgame->id }}" {{ $boardgame_id == $boardgame->id ? 'selected' : '' }}>{{ $boardgame->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label for="creator">Líder</label>
                    <input type="text" name="creator" id="creator" class="form-control" value="{{ $creator }}">
                </div>

                <div class="col">
                    <label for="closed">Estado</label>
                    <select name="closed" id="closed" class="form-control">
                        <option value="-1" {{ $closed == -1 ? 'selected' : '' }}></option>
                        <option value="1" {{ $closed == 1 ? 'selected' : '' }}>Cerrada</option>
                        <option value="0" {{ $closed == 0 ? 'selected' : '' }}>Abierta</option>
                    </select>
                </div>

                <div class="col">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $address }}">
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col">
                    <button type="submit" class="btn btn-dark btn-sm">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="center">
        <div class="col" style="margin-top: 20px">
            <h2>Listado de partidas</h2>
        </div>
    </div>

    <div class="center" style="margin-top: 15px">
        <a href="{{ route('games.create') }}" class="btn btn-dark btn-sm">Crear partida</a>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach($games as $game)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header text-center"><h3>{{ $game->boardgame->name }}</h3></div>
                            <p>Jugadores: {{ $game->players }} / {{ $game->max_players }}</p>
                            <p>Estado: {{ $game->closed ? "Cerrado" : "Abierto" }}</p>
                            <p>Dirección: {{ $game->address }}, {{ $game->place }}</p>
                            <div class="text-center">
                                <a class="btn btn-secondary btn-sm" href="{{ route('games.show', $game->id) }}">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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