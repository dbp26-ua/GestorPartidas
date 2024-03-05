<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <h2>Información del perfil de {{ $user->name }}</h2>
    <p>Email: {{ $user->email }}</p>

    <p>Teléfono: {{ $user->phone }}</p>

    <p>País: {{ $user->country }}</p>

    <p>Población: {{ $user->city }}, {{ $user->zip_code }}</p>

    <p>
        <a class="btn btn-success" href="{{ route('user.edit') }}">Editar los datos</a>
    </p>

    <p>
        <a class="btn btn-info" href="{{ route('user.games') }}">Listado de partidas</a>
        <a class="btn btn-info" href="{{ route('user.boardgames') }}">Listado de juegos</a>
    </p>
@endsection