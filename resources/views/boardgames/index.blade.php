<!DOCTYPE html>
@extends('layouts.app')

@section('content')
<style>
    .container {
        position: relative;
        width: 100%;
        padding: 3%;
    }

    .text-overlay {
        position: absolute;
        top: 3%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .button-overlay {
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
    }

    .image {
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
        height: auto;
        border-radius: 8px;
        display: block;
    }
</style>

<div>
    <a href="{{ route('boardgames.create') }}" class="btn btn-info">Solicitar juego</a>

    @foreach($boardgames as $boardgame)
        <div class="container">
            <img class="image" src="{{ asset($boardgame->photo) }}" alt="{{ $boardgame->description }}">
            <div class="text-overlay">
                <h1>{{ $boardgame->name }}</h1>
                <p>{{ $boardgame->description }}</p>
            </div>
            <div class="button-overlay">
                <a class="btn btn-info" href="{{ route('boardgames.add', $boardgame->id) }}">Añadir</a>
                <a class="btn btn-success" href="{{ route('boardgames.boards', $boardgame->id) }}">Tableros</a>
            </div>
        </div>
    @endforeach
</div>

@endsection