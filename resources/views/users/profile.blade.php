<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="col" style="margin-top: 20px; margin-bottom: 20px">
            <a class="btn btn-dark btn-sm" href="{{ route('user.games') }}">Listado de partidas</a>
            <a class="btn btn-dark btn-sm" href="{{ route('user.boardgames') }}">Listado de juegos</a>
        </div>
    </div>

    <div class="center">
        <img src="{{ $user->photo }}" alt="Imagen de perfil" class="imagen rounded-circle">
    </div>

    <div class="center">
        <div class="col" style="margin-top: 20px; margin-bottom: 10px">
            <h2>Perfil de {{ $user->name }}</h2>
        </div>
    </div>

    <div class="center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p><b>Email</b>: {{ $user->email }}</p>
                    <p><b>Teléfono</b>: {{ $user->phone }}</p>
                    <p><b>País</b>: {{ $user->country }}</p>
                    <p><b>Población</b>: {{ $user->city }}, {{ $user->country }}. {{ $user->zip_code }}</p>
                    <div class="text-center">
                        <a class="btn btn-secondary btn-sm" href="{{ route('user.edit') }}">Editar los datos</a>
                    </div>
                </div>
            </div>
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
    max-width: 20vw;
    margin-left: auto;
    margin-right: auto;
    max-height: 20vh;
    border-radius: 8px;
    display: block;
}
</style>
@endsection