<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Petición de solicitud de un tablero</h4>
                    </div>

                    <div class="card-body text-center">
                        <form action="{{ route('boards.store') }}" method="post">
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

                                    <div class="form-group">
                                        <input type="hidden" name="boardgame_id" id="boardgame_id" class="form-control" value="{{ $boardgame->id }}" required>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <div class="text-center" style="margin-top: 15px">
                                <button type="submit" class="btn btn-dark btn-sm">Solicitar tablero</button>
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
</style>
@endsection