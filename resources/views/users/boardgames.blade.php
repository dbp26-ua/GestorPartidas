<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div>
        <div class="col">
            <h2>Biblioteca</h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boardgames as $boardgame)
                        <tr>
                            <td>{{ $boardgame->name }}</td>
                            <td>{{ $boardgame->description }}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('boardgames.remove', $boardgame->id) }}" onclick="return confirm('¿Estás seguro')">Eliminar</a>
                                <a class="btn btn-success" href="{{ route('boardgames.boards', $boardgame->id) }}">Tableros</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection