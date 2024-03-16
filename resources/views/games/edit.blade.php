<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h2>Gestión de una partida.</h2>
        </div>
    </div>

    <div>
        <form action="{{ route('games.update', $game->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-group" value="{{ $game->description }}" required>
            </div>

            <div class="form-group">
                <label for="max_players">Jugadores máximos:</label>
                <input type="number" name="max_players" id="max_players" class="form-group" value="{{ $game->max_players }}" required>
            </div>

            <div class="form-group">
                <label for="place">Lugar:</label>
                <input type="text" name="place" id="place" class="form-group" value="{{ $game->place }}" required>
            </div>

            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" name="address" id="address" class="form-group" value="{{ $game->address }}" required>
            </div>

            <div class="form-group">
                <label for="closed">Cerrada:</label>
                <select name="closed" id="closed" class="form-group" required>
                    <option value="1" {{ $game->closed ? 'selected' : '' }}>Cerrada</option>
                    <option value="0" {{ !$game->closed ? 'selected' : '' }}>Abierta</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar partida</button>
        </form>

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection