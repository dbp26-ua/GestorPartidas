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
                                @if($user->id != $game->creator->id)
                                    <a class="btn btn-danger" href="{{ route('admin.games.transfer', [$game->id, $user->id]) }}">Transferir</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection