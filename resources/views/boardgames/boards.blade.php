<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="col" style="margin-top: 20px">
            <h2>Listado de tableros de {{ $boardgame->name }}</h2>
        </div>
    </div>

    <div class="center">
        <div class="col" style="margin-top: 20px">
            <a href="{{ route('boards.create', $boardgame->id) }}" class="btn btn-dark btn-sm">Solicitar tablero</a>
        </div>
    </div>

    <div class="container mb-4">
        <div class="row">
            @foreach($boards as $board)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header text-center"><h3>{{ $board->name }}</h3></div>
                            <p class="text-center">{{ $board->description }}</p>
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