<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div>
        <div class="col">
            <h2>Información detallada para la partida de {{ $game->creator->name }}</h2>
        </div>
    </div>

    <div>
        <p>Juego: {{ $game->boardgame->name }}</p>

        <p>Descripción de la partida: {{ $game->description }}</p>

        <p>Jugadores: {{ $game->players }}/{{ $game->max_players }}</p>

        <p>Lugar de celebración: {{ $game->place }}</p>

        <p>Estado: {{ $game->closed ? "Cerrada" : "Abierta" }}</p>

        <p>Jugadores:
            <ul>
                @foreach($game->users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        </p>
    </div>
@endsection