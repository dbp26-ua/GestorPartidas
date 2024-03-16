<!DOCTYPE html>
@extends('layouts.app')

@section('content')
<div>
        <div class="col">
            <h2>Transferencia de liderazgo</h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('boardgames.remove', $boardgame->id) }}">Eliminar</a>
                                <a class="btn btn-success" href="{{ route('boardgames.boards', $boardgame->id) }}">Tableros</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection