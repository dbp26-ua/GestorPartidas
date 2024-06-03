<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Creación de un usuario</h4>
                    </div>

                    <div class="card-body text-center">
                        <form action="{{ route('admin.users.store') }}" method="post">
                            <div class="row">
                                <div class="col"></div>

                                <div class="col">
                                    <div class="input-wrap">
                                        <input type="text" name="name" id="name" class="form-control" required>
                                        <label for="name">Nombre:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="email" id="email" class="form-control" required>
                                        <label for="email">Email:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="password" id="password" class="form-control" required>
                                        <label for="password">Contraseña:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="tel" pattern="[0-9]{9,11}" name="phone" id="phone" class="form-control"required>
                                        <label for="phone">Teléfono:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="country" id="country" class="form-control" required>
                                        <label for="country">País:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="city" id="city" class="form-control"required>
                                        <label for="city">Localidad:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" pattern="[0-9]{5}" name="zip_code" id="zip_code" class="form-control" required>
                                        <label for="zip_code">Código postal:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <select name="admin" id="admin" class="form-control" required>
                                            <option value="1">Sí</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                        <label for="admin">Administrador</label>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <div class="text-center" style="margin-top: 15px;">
                                <button type="submit" class="btn btn-dark btn-sm">Crear usuario</button>
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

input:focus, select:focus {
  outline: none;
}

.input-wrap input:focus~label,
.input-wrap input:valid ~ label {
  top: -14px;
  font-size: 12px;
  color: #328dd2;
}

.input-wrap select:focus~label,
.input-wrap select:valid ~ label {
  top: -14px;
  font-size: 12px;
  color: #328dd2;
}
</style>
@endsection