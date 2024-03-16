<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <h2>Creación de una partida</h2>
    <div>
        <form action="{{ route('admin.games.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="max_players">Jugadores máximos:</label>
                <input type="number" name="max_players" id="max_players" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="place">Lugar:</label>
                <input type="text" name="place" id="place" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" name="address" id="address" class="form-control" required>
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
                <label for="user_id">Creador:</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Seleccionar tablero</button>
        </form>
    </div>
@endsection