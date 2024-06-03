<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Creación de una partida</h4>
                    </div>

                    <div class="card-body text-center">
                        <form action="{{ route('admin.games.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col"></div>

                                <div class="col">
                                    <div class="input-wrap">
                                        <input type="number" name="max_players" id="max_players" class="form-control" value="{{ old('max_players') }}" required>
                                        <label for="max_players">Jugadores</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="place" id="place" class="form-control" value="{{ old('place') }}" required>
                                        <label for="place">Ciudad</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
                                        <label for="address">Dirección</label>
                                    </div>

                                    <div class="input-wrap">
                                        <select name="boardgame_id" id="boardgame_id" class="form-control" required>
                                            <option value="" selected disabled hidden class="text-center" style="color: slategray;">Selecciona un juego</option>
                                            @foreach($boardgames as $boardgame)
                                                <option value="{{ $boardgame->id }}">{{ $boardgame->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-wrap">
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="" selected disabled hidden class="text-center" style="color: slategray;">Selecciona un líder</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-wrap">
                                        <textarea rows="4" placeholder="Descripción" type="text" name="description" id="description" class="form-control" value="{{ old('description') }}"></textarea>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <div class="text-center" style="margin-top: 15px">
                                <button type="submit" class="btn btn-dark btn-sm">Seleccionar tablero</button>
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

.input-wrap input {
  background: none;
  color: black;
  font-size: 18px;
  padding: 10px;
  display: block;
  width: 320px;
  border: none;
  border-bottom: 1px solid #ccc;
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

.input-wrap textarea {
  background: none;
  color: black;
  font-size: 18px;
  padding: 10px;
  display: block;
  width: 320px;
  border: none;
  border-bottom: 1px solid #ccc;
}

.input-wrap label {
  position: absolute;
  color: slategray;
  font-size: 16px;
  font-weight: normal;
  pointer-events: none;
  left: 10px;
  top: 10px;
  transition: 300ms ease all;
}

input:focus, select:focus, textarea:focus {
  outline: none;
}

.input-wrap input:focus~label,
.input-wrap input:valid ~ label {
  top: -14px;
  font-size: 12px;
  color: #328dd2;
}

textarea::placeholder {
    color: slategray;
}

select:invalid, select option[value=""] {
    color: slategray;
}
</style>
@endsection