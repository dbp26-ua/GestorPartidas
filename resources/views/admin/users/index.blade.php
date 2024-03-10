<!DOCTYPE html>
@extends('layouts.admin')

@section('content')
    <div>
        <div class="col">
            <h2>Listado de jugadores</h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
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
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->country }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->zip_code }}</td>
                            <td>{{ $user->admin ? "Sí" : "No" }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.users.edit', $user->id) }}">Editar</a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Crear usuario</a>
    </div>
@endsection