<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Selección de tablero</h4>
                    </div>

                    <div class="card-body text-center">
                        <form action="{{ route('games.storeBoard') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" name="game_id" id="game_id" class="form-control" value="{{ $game->id }}" required>
                            </div>

                            <div class="row">
                                <div class="col"></div>

                                <div class="col">
                                    <div class="input-wrap">
                                        <select name="board_id" id="board_id" class="form-control" required>
                                            <option value="" selected disabled hidden class="text-center" style="color: slategray;">Selecciona un tablero</option>
                                            @foreach($boards as $board)
                                                <option value="{{ $board->id }}">{{ $board->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <div class="text-center" style="margin-top: 15px">
                                <button type="submit" class="btn btn-dark btn-sm">Crear partida</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
.input-wrap {
  position: relative;
  margin: 30px;
}

.input-wrap select {
  background: none;
  color: black;
  font-size: 18px;
  padding: 10px;
  display: block;
  width: 320px;
  border: none;
  border-bottom: 1px solid #ccc;
}

select:focus {
  outline: none;
}

select:invalid, select option[value=""] {
    color: slategray;
    text-align: center;
}
</style>
@endsection