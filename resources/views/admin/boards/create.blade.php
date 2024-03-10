<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <h2>Creación de un tablero</h2>
    <div>
        <form action="{{ route('admin.boards.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="boardgame_id">Juego:</label>
                <select name="boardgame_id" id="boardgame_id" class="form-control" required>
                    @foreach($boardgames as $boardgame)
                        <option value="{{ $boardgame->id }}">{{ $boardgame->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Crear tablero</button>
        </form>
    </div>
@endsection