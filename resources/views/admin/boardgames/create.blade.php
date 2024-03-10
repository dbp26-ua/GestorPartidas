<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <h2>Creación de un juego</h2>
    <div>
        <form action="{{ route('admin.boardgames.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Crear juego</button>
        </form>
    </div>
@endsection