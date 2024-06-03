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

    .imagen {
        max-width: 15vw;
        margin-left: auto;
        margin-right: auto;
        max-height: 15vh;
        border-radius: 8px;
        display: block;
    }
</style>

<div class="center">
    <div class="col" style="margin-top: 20px">
        <a href="{{ route('boardgames.create') }}" class="btn btn-dark btn-sm">Solicitar juego</a>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        @foreach($boardgames as $boardgame)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="imagen" style="margin-bottom: 10px">
                            <img class="imagen" src="{{ asset($boardgame->photo) }}" alt="{{ $boardgame->description }}">
                        </div>
                        <div class="card-header text-center">
                            <h3>{{ $boardgame->name }}</h3>
                        </div>
                        <p class="text-center">{{ $boardgame->description }}</p>
                        <div class="text-center">
                            <a class="btn btn-secondary btn-sm" href="{{ route('boardgames.add', $boardgame->id) }}">Añadir</a>
                            <a class="btn btn-secondary btn-sm" href="{{ route('boardgames.boards', $boardgame->id) }}">Tableros</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.center {
    display: flex;
    justify-content: center;
    margin: 0 auto;
    width: 95%;
    text-align: center;
}
</style>
@endsection