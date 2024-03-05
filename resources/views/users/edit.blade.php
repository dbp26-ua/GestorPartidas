<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h2>Edición de los datos de {{ $user->name }}</h2>
        </div>
    </div>

    <div>
        <form action="{{ route('user.update') }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-group" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-group" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-group">
            </div>

            <div class="form-group">
                <label for="repeatPassword">Repite contraseña:</label>
                <input type="password" name="repeatPassword" id="repeatPassword" class="form-group">
            </div>

            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="text" name="phone" id="phone" class="form-group" value="{{ $user->phone }}" required>
            </div>

            <div class="form-group">
                <label for="country">País:</label>
                <input type="text" name="country" id="country" class="form-group" value="{{ $user->country }}" required>
            </div>

            <div class="form-group">
                <label for="city">Población:</label>
                <input type="text" name="city" id="city" class="form-group" value="{{ $user->city }}" required>
            </div>

            <div class="form-group">
                <label for="zip_code">Código postal:</label>
                <input type="text" name="zip_code" id="zip_code" class="form-group" value="{{ $user->zip_code }}" required>
            </div>

            <div class="form-group">
                <label for="photo">Foto de perfil:</label>
                <input type="file" name="photo" id="photo" class="form-group">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar datos</button>
        </form>

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
@endsection