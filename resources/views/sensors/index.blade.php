@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Sensores</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('sensors/create') }}" class="btn btn-sm btn-success">
                    Nueva sensor
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
                    <th scope="col">Nombre del sensor</th>
                    <th scope="col">Serial</th>
                    @if (auth()->user()->role_id != 3)
                    <th scope="col">Opciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($sensors as $sensor)
                <tr>
                    <th scope="row">
                        {{ $sensor->model_sensor }}
                    </th>
                    <td>
                        {{ $sensor->serial_sensor }}
                    </td>
                    @if (auth()->user()->role_id != 3)
                    <td>
                        <form action="{{ url('sensors/'.$sensor->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('sensors/'.$sensor->id.'/edit') }}"
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
        {{ $sensors->links() }}
    </div>
</div>
@endsection
