@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header border-0">

        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nuevo usuario</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('users') }}" class="btn btn-sm btn-default">
                    Volver
                </a>
            </div>
        </div>

    </div>


    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif

        <form action="{{ url('users')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="rut">RUT</label>
                <input type="text" name="rut" class="form-control" value="{{ old('rut') }}">
            </div>

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="middlename">Segundo nombre</label>
                <input type="text" name="middlename" class="form-control" value="{{ old('middlename') }}">
            </div>

            <div class="form-group">
                <label for="lastname">Apellido Paterno</label>
                <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}">
            </div>

            <div class="form-group">
                <label for="mothername">Apellido Materno</label>
                <input type="text" name="mothername" class="form-control" value="{{ old('mothername') }}">
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="role">Contraseña</label>
                <input type="text" name="password" class="form-control" value="{{ Str::random(12) }}">
            </div>

            <div class="form-group">
                <label for="role_id">Rol asignado</label>
                <select name="role_id" id="role_id" class="form-control selectpicker" data-style="btn-outline-secondary" title="Escoge un rol">
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>

        </form>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
