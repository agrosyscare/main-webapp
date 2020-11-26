@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Invernaderos</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('greenhouses/create') }}" class="btn btn-sm btn-success">
                    Nuevo invernadero
                </a>
            </div>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($greenhouses as $greenhouse)
                <tr>
                    <th scope="row">
                        {{ $greenhouse->name_greenhouse }}
                    </th>
                    <td>
                        {{ $greenhouse->description }}
                    </td>
                    <td>
                        <form action="{{ url('greenhouses/'.$greenhouse->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('greenhouses/'.$greenhouse->id.'/edit') }}"
                                class="btn btn-sm btn-primary">Editar</a>
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
