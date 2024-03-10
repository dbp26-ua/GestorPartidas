<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <h2>Edición de un tablero</h2>
    <div>
        <form action="{{ route('admin.boards.update', $board->id) }}" method="post">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $board->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $board->description }}" required>
            </div>

            <button type="submit" class="btn btn-success">Editar tablero</button>
        </form>
    </div>
@endsection