<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div>
        <div class="col">
            <h2>Información detallada para la partida de {{ $game->creator->name }}</h2>
        </div>
    </div>

    <div>
        <p>Juego: {{ $game->boardgame->name }}</p>

        <p>Tablero: {{ $game->board->name }}</p>

        <p>Descripción de la partida: {{ $game->description }}</p>

        <p>Lugar de celebración: {{ $game->place }}</p>

        <p>Estado: {{ $game->closed ? "Cerrada" : "Abierta" }}</p>

        <p>Jugadores: {{ $game->players }}/{{ $game->max_players }}
            <ul>
                @foreach($game->users as $user)
                    <li>{{ $user->name }} 
                        @if($game->creator->id == Auth::user()->id && $user->id != $game->creator->id)
                            <a class="btn btn-danger" href="{{ route('games.remove', [$game->id, $user->id]) }}">Eliminar</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </p>
    </div>

    <div>
        @if(in_array(Auth::user()->id, $game->users->pluck('id')->toArray()))
            <a class="btn btn-info" href="{{ route('user.games.remove', $game->id) }}" onclick="return confirm('¿Estás seguro?')">Salirse</a>
        @else
            @if($game->closed == false)
                <a class="btn btn-info" href="{{ route('user.games.add', $game->id) }}">Unirse</a>
            @endif
        @endif
        @if($game->creator->id == Auth::user()->id)
            <a class="btn btn-info" href="{{ route('games.edit', $game->id) }}">Gestionar</a>
            <form action="{{ route('games.delete', $game->id) }}" method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Borrar partida</button>
            </form>
        @endif

        <button type="button" class="btn btn-primary" onclick="toggleVisibility()">
            Comentar
        </button>

        <form action="{{ route('comments.store', $game->id) }}" method="post" id="commentForm" hidden>
            @csrf
            <input type="text" name="text" id="text" class="form-control" placeholder="Escribe tu comentario...">
            <button type="submit" class="btn btn-success">Añadir comentario</button>
        </form>
        @if($comments->count() > 0)
            <p><h4>Comentarios</h4>
                <ul>
                    @foreach($comments as $comment)
                        <li>
                            <div>
                                <p>{{ $comment->author }}
                                    @if($game->creator->id == Auth::user()->id || $Auth::user()->id == $comment->user_id)
                                        <form action="{{ route('comments.delete', [$comment->id, $game->id]) }}" method="post" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    @endif
                                </p>
                                <p>{{ $comment->text }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </p>
        @endif
@endsection

<script>
    function toggleVisibility() {
        var commentForm = document.getElementById("commentForm");
        if(commentForm.hasAttribute("hidden")) {
            commentForm.removeAttribute("hidden");
        } else {
            commentForm.setAttribute("hidden", 'true');
        }
    }
</script>