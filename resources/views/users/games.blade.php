<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="col" style="margin-top: 20px">
            <h2>Listado de partidas</h2>
        </div>
    </div>

    <div class="container mb-4">
        <div class="row">
            @foreach($games as $game)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header text-center"><h3>{{ $game->boardgame->name }}</h3></div>
                            <p>Jugadores: {{ $game->players }} / {{ $game->max_players }}</p>
                            <p>Estado: {{ $game->closed ? "Cerrado" : "Abierto" }}</p>
                            <div class="text-center">
                                <a class="btn btn-secondary btn-sm" href="{{ route('games.show', $game->id) }}">Ver detalles</a>
                                @if($game->creator->id != Auth::user()->id)
                                    <a class="btn btn-danger btn-sm" href="{{ route('user.games.remove', $game->id) }}">Salirse</a>
                                @endif
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