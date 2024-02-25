<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <h2>Creación de una partida</h2>
    <div>
        <form action="{{ route('games.storeBoard') }}" method="post">
            @csrf

            <div class="form-group">
                <input type="hidden" name="game_id" id="game_id" class="form-control" value="{{ $game->id }}" required>
            </div>

            <div class="form-group">
                <label for="board_id">Tablero:</label>
                <select name="board_id" id="board_id" class="form-control" required>
                    @foreach($boards as $board)
                        <option value="{{ $board->id }}">{{ $board->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Crear partida</button>
        </form>
    </div>
@endsection