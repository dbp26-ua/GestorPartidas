<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Edición de un usuario</h4>
                    </div>

                    <div class="card-body text-center">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                            <div class="row">
                                <div class="col"></div>

                                <div class="col">
                                    <div class="input-wrap">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                                        <label for="name">Nombre:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                                        <label for="email">Email:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="tel" pattern="[0-9]{9,11}" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
                                        <label for="phone">Teléfono:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="country" id="country" class="form-control" value="{{ $user->country }}" required>
                                        <label for="country">País:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="city" id="city" class="form-control" value="{{ $user->city }}" required>
                                        <label for="city">Localidad:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" pattern="[0-9]{5}" name="zip_code" id="zip_code" class="form-control" value="{{ $user->zip_code }}" required>
                                        <label for="zip_code">Código postal:</label>
                                    </div>

                                    <div class="input-wrap">
                                        <select name="admin" id="admin" class="form-control" required>
                                            <option value="1" {{ $user->admin == 1 ? 'selected' : '' }}>Sí</option>
                                            <option value="0" {{ $user->admin == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                        <label for="admin">Administrador</label>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <div class="text-center" style="margin-top: 15px;">
                                <button type="submit" class="btn btn-dark btn-sm">Editar usuario</button>
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