<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <h2>Petición de solicitud de un tablero</h2>
    <div>
        <form action="{{ route('boards.store') }}" method="post">
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
                <input type="hidden" name="boardgame_id" id="boardgame_id" class="form-control" value="{{ $boardgame->id }}" required>
            </div>

            <button type="submit" class="btn btn-success">Solicitar tablero</button>
        </form>
    </div>
@endsection