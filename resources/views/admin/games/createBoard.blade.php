<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <h2>Selección de tablero</h2>
    <div>
        <form action="{{ route('admin.games.storeBoard', $game->id) }}" method="post">
            @csrf

            <div class="form-group">
                <label for="board_id">Juego:</label>
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