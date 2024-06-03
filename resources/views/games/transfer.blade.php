<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="col" style="margin-top: 20px">
            <h2>Transferencia de liderazgo</h2>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach($users as $user)
                @if($user->id != $game->creator->id)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header text-center"><h3>{{ $user->name }}</h3></div>
                                <div class="text-center" style="margin-top: 15px">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('games.transfer', [$game->id, $user->id]) }}" onclick="return confirm('¿Estás seguro?')">Transferir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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