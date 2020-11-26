@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Usuarios</h3>
            </div>
            @if (auth()->user()->role_id != 3)
            <div class="col text-right">
                <a href="{{ url('users/create') }}" class="btn btn-sm btn-success">
                    Nuevo usuario
                </a>
            </div>
            @endif
        </div>
    </div>

    @if (session('notification'))
    <div class="card-body">
        <div class="alert alert-success" role="alert">
            <strong>Exito!</strong> {{ session('notification') }}
        </div>
    </div>
    @endif

    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">RUT</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">lastname</th>
                    <th scope="col">e-mail</th>
                    @if (auth()->user()->role_id != 3)
                    <th scope="col">Opciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                <tr>
                    <th scope="row">
                        {{ $user->rut }}
                    </th>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->lastname }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>

                    @if (auth()->user()->role_id != 3)
                    <td>
                        <form action="{{ url('users/'.$user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('users/'.$user->id.'/edit') }}"
                                class="btn btn-sm btn-primary">Editar</a>
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                    @endif

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="card-body">
        {{ $users->links() }}
    </div>
</div>
@endsection
