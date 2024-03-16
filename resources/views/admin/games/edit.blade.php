<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <h2>Edición de una partida</h2>
    <div>
        <form action="{{ route('admin.games.update', $game->id) }}" method="post">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="max_players">Jugadores máximos:</label>
                <input type="number" name="max_players" id="max_players" class="form-control" value="{{ $game->max_players }}" required>
            </div>
            
            <div class="form-group">
                <label for="place">Lugar:</label>
                <input type="text" name="place" id="place" class="form-control" value="{{ $game->place }}" required>
            </div>

            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $game->address }}" required>
            </div>

            <div class="form-group">
                <label for="closed">Cerrada:</label>
                <select name="closed" id="closed" class="form-group" required>
                    <option value="1" {{ $game->closed ? 'selected' : '' }}>Cerrada</option>
                    <option value="0" {{ !$game->closed ? 'selected' : '' }}>Abierta</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $game->description }}" required>
            </div>

            <button type="submit" class="btn btn-success">Editar partida</button>
        </form>
    </div>
@endsection