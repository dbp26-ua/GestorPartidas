@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Edición de datos del perfil</h4>
                    </div>

                    <div class="card-body text-center">
                        <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col"></div>

                                <div class="col">
                                    <div class="input-wrap">
                                        <input type="text" name="name" id="name" class="form-group" value="{{ $user->name }}" required>
                                        <label for="name">Nombre</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="email" name="email" id="email" class="form-group" value="{{ $user->email }}" required>
                                        <label for="email">Email</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="password" name="password" id="password" class="form-group">
                                        <label for="password">Contraseña</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="password" name="repeatPassword" id="repeatPassword" class="form-group">
                                        <label for="repeatPassword">Repite contraseña</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="tel" pattern="[0-9]{9,11}" name="phone" id="phone" class="form-group" value="{{ $user->phone }}" required>
                                        <label for="phone">Teléfono</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="country" id="country" class="form-group" value="{{ $user->country }}" required>
                                        <label for="country">País</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" name="city" id="city" class="form-group" value="{{ $user->city }}" required>
                                        <label for="city">Población</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="text" pattern="[0-9]{5}" name="zip_code" id="zip_code" class="form-group" value="{{ $user->zip_code }}" required>
                                        <label for="zip_code">Código postal</label>
                                    </div>

                                    <div class="input-wrap">
                                        <input type="file" name="photo" id="photo" class="form-group">
                                        <label for="photo">Foto de perfil</label>
                                    </div>
                                </div>

                                <div class="col"></div>
                            </div>

                            <div class="text-center" style="margin-top: 15px">
                                <button type="submit" class="btn btn-dark btn-sm">Actualizar datos</button>
                            </div>
                        </form>

                        @if (session('success'))
                            <div>
                                <strong>{{ session('success') }}</strong>
                            </div>
                            <div>
                                <img src="{{ asset('userPhotos/' . session('image')) }}" alt="Imagen subida">
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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

.input-wrap input[type=file] ~ label {
  top: -14px;
  font-size: 12px;
  color: #328dd2;
}
</style>
@endsection