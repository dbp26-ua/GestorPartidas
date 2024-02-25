<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <h2>Creación de una partida</h2>
    <div>
        <form action="{{ route('games.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="max_players">Jugadores máximos:</label>
                <input type="number" name="max_players" id="max_players" class="form-control" value="{{ old('max_players') }}" required>
            </div>
            
            <div class="form-group">
                <label for="place">Lugar:</label>
                <input type="text" name="place" id="place" class="form-control" value="{{ old('place') }}" required>
            </div>

            <div class="form-group">
                <label for="boardgame_id">Juego:</label>
                <select name="boardgame_id" id="boardgame_id" class="form-control" required>
                    @foreach($boardgames as $boardgame)
                        <option value="{{ $boardgame->id }}">{{ $boardgame->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
            </div>

            <button type="submit" class="btn btn-success">Seleccionar tablero</button>
        </form>
    </div>
@endsection