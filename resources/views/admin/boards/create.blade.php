<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Creación de un tablero</h4>
                    </div>

                    <div class="card-body text-center">
                        <form action="{{ route('admin.boards.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col"></div>

                                <div class="col">
                                    <div class="input-wrap">
                                        <input type="text" name="name" id="name" class="form-control" required>
                                        <label for="name">Nombre</label>
                                    </div>

                                    <div class="input-wrap">
                                    <input type="text" name="description" id="description" class="form-control" required>
                                        <label for="description">Descripción</label>
                                    </div>

                                    <div class="input-wrap">
                                        <select name="boardgame_id" id="boardgame_id" class="form-control" required>
                                            <option value="" selected disabled hidden class="text-center" style="color: slategray;">Selecciona un juego</option>
                                            @foreach($boardgames as $boardgame)
                                                <option value="{{ $boardgame->id }}">{{ $boardgame->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <div class="text-center" style="margin-top: 15px">
                                <button type="submit" class="btn btn-dark btn-sm">Crear tablero</button>
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

input:focus {
  outline: none;
}

.input-wrap input:focus~label,
.input-wrap input:valid ~ label {
  top: -14px;
  font-size: 12px;
  color: #328dd2;
}

select:invalid, select option[value=""] {
    color: slategray;
}
</style>
@endsection