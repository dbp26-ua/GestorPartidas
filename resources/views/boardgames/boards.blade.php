<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div>
        <div class="col">
            <h2>Listado de tableros de {{ $boardgame->name }}</h2>
        </div>
        <a href="{{ route('boards.create', $boardgame->id) }}" class="btn btn-success">Solicitar tablero</a>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boards as $board)
                        <tr>
                            <td>{{ $board->name }}</td>
                            <td>{{ $board->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection