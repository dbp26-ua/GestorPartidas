<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Información detallada de la partida de {{ $game->creator->name }}</h4>
                        </div>

                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col" style="text-align: right;">
                                    <p><b>Juego:</b></p>
                                    <p><b>Tablero:</b></p>
                                    <p><b>Descripción:</b></p>
                                    <p><b>Lugar:</b></p>
                                    <p><b>Estado:</b></p>
                                </div>

                                <div class="col" style="text-align: left;">
                                    <p>{{ $game->boardgame->name }}</p>
                                    <p>{{ $game->board->name }}</p>
                                    <p>{{ $game->description }}</p>
                                    <p>{{ $game->address }}, {{ $game->place }}</p>
                                    <p>{{ $game->closed ? "Cerrada" : "Abierta" }}</p>
                                </div>
                            </div>

                            <hr/>

                            <div class="row">
                                <div class="text-center">
                                    @if(Auth::check())
                                        @if(in_array(Auth::user()->id, $game->users->pluck('id')->toArray()))
                                            <a class="btn btn-danger btn-sm" href="{{ route('user.games.remove', $game->id) }}" onclick="return confirm('¿Estás seguro?')">Salirse</a>
                                        @else
                                            @if($game->closed == false)
                                                <a class="btn btn-primary btn-sm" href="{{ route('user.games.add', $game->id) }}">Unirse</a>
                                            @endif
                                        @endif
                                        @if($game->creator->id == Auth::user()->id)
                                            <form action="{{ route('games.delete', $game->id) }}" method="post" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Borrar partida</button>
                                            </form>
                                            <a class="btn btn-secondary btn-sm" href="{{ route('games.edit', $game->id) }}">Gestionar</a>
                                            <a href="{{ route('games.transferForm', $game->id) }}" class="btn btn-secondary btn-sm">Transferir liderazgo</a>
                                        @endif
                                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Ver en mapa
                                        </button>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Localización en el mapa</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>El marcador rojo con una P indica la localización.</p>
                                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $game->place }}&size=450x450&key=AIzaSyCI5IvGyGHj3AuMwC4cprwx7aHBdqPw-Ps&zoom=16&markers=color:red|label:P|{{ $game->address }}" alt="Localización de la partida en el mapa.">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Usuarios participantes {{ $game->players }}/{{ $game->max_players }}</h4>
                        </div>

                        <div class="card-body text-center">
                            @foreach($game->users as $user)
                                <p>
                                    @if($game->creator->id == Auth::user()->id && $user->id != $game->creator->id)
                                        <form action="{{ route('games.remove', [$game->id, $user->id]) }}" method="post" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <b><i>{{ $user->name }}</i></b>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Expulsar</button>
                                        </form>
                                    @else
                                        <b><i>{{ $user->name }}</i></b>
                                    @endif
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center" style="margin-top: 25px;">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Comentarios</h4>
                        </div>

                        <div class="card-body">
                            <div class="text-center">
                                <button type="button" class="btn btn-dark btn-sm" style="margin-bottom: 10px;" onclick="toggleVisibility()">
                                    Comentar
                                </button>

                                <form action="{{ route('comments.store', $game->id) }}" method="post" id="commentForm" style="margin-bottom: 10px;" hidden>
                                    @csrf
                                    <input type="text" name="text" id="text" class="form-control" placeholder="Escribe tu comentario...">
                                    <button type="submit" class="btn btn-secondary btn-sm" style="margin-top: 10px;">Añadir comentario</button>
                                </form>
                            </div>
                            @if($comments->count() > 0)
                                @foreach($comments as $comment)
                                    <div class="card" style="margin-top: 15px;">
                                        <div class="card-body">
                                            <div class="commented-section mt-2">
                                                <div class="d-flex flex-row align-items-center commented-user row">
                                                    <div class="col" style="text-align: left;">
                                                        <h5 class="mr-2">{{ $comment->author }}</h5>
                                                    </div>
                                                    <div class="col" style="text-align: right;">
                                                        @if(Auth::check())
                                                            @if($game->creator->id == Auth::user()->id || Auth::user()->id == $comment->user_id)
                                                                <form action="{{ route('comments.delete', [$comment->id, $game->id]) }}" method="post" style="display:inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="comment-text-sm">
                                                    <span>{{ $comment->text }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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