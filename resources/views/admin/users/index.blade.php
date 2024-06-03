<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div class="center">
        <div class="col">
            <h2>Listado de jugadores</h2>
        </div>
    </div>

    <div class="center">
        <a href="{{ route('admin.users.create') }}" class="btn btn-dark btn-sm">Crear usuario</a>
    </div>

    <div class="row mt-3 center">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>País</th>
                        <th>Localidad</th>
                        <th>Código postal</th>
                        <th>Administrador</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->country }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->zip_code }}</td>
                            <td>{{ $user->admin ? "Sí" : "No" }}</td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="{{ route('admin.users.edit', $user->id) }}">Editar</a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

<style>
.center {
    display: flex;
    justify-content: center;
    margin: 0 auto;
    width: 95%;
    text-align: center;
}
</style>
@endsection