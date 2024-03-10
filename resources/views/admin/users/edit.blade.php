<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <h2>Edición de un usuario</h2>
    <div>
        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="text" name="password" id="password" class="form-control" value="{{ $user->password }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
            </div>

            <div class="form-group">
                <label for="country">País:</label>
                <input type="text" name="country" id="country" class="form-control" value="{{ $user->country }}" required>
            </div>

            <div class="form-group">
                <label for="city">Localidad:</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ $user->city }}" required>
            </div>

            <div class="form-group">
                <label for="zip_code">Código postal:</label>
                <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ $user->zip_code }}" required>
            </div>

            <div class="form-group">
                <label for="admin">Administrador:</label>
                <select name="admin" id="admin" class="form-control" required>
                    <option value="1" {{ $user->admin == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $user->admin == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Editar usuario</button>
        </form>
    </div>
@endsection