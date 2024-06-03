<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="col" style="margin-top: 20px">
            <h2>Biblioteca</h2>
        </div>
    </div>

    <div class="container mb-4">
        <div class="row">
            @foreach($boardgames as $boardgame)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="imagen" style="margin-bottom: 10px">
                                <img class="imagen" src="{{ asset($boardgame->photo) }}" alt="{{ $boardgame->description }}">
                            </div>
                            <div class="card-header text-center"><h3>{{ $boardgame->name }}</h3></div>
                            <p class="text-center">{{ $boardgame->description }}</p>
                            <div class="text-center">
                                <a class="btn btn-secondary btn-sm" href="{{ route('boardgames.boards', $boardgame->id) }}">Tableros</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('boardgames.remove', $boardgame->id) }}">Eliminar</a>
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

.imagen {
    max-width: 15vw;
    margin-left: auto;
    margin-right: auto;
    max-height: 15vh;
    border-radius: 8px;
    display: block;
}
</style>
@endsection