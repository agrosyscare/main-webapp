@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Canchas</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('greenhouse-sections/create') }}" class="btn btn-sm btn-success">
                    Nueva cancha
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
                    <th scope="col">Nombre de la seccion</th>
                    <th scope="col">Especies plantadas</th>
                    @if (auth()->user()->role_id != 3)
                    <th scope="col">Opciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($greenhouse_sections as $greenhouse_section)
                <tr>
                    <th scope="row">
                        {{ $greenhouse_section->name_section }}
                    </th>
                    <td>
                        {{ $greenhouse_section->planting_type }}
                    </td>
                    @if (auth()->user()->role_id != '3')
                    <td>
                        <form action="{{ url('greenhouse-sections/'.$greenhouse_section->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('greenhouse-sections/'.$greenhouse_section->id.'/edit') }}"
                                class="btn btn-sm btn-primary">Editar</a>
                            <a href="{{ url('settings/'.$greenhouse_section->id) }}"
                                class="btn btn-sm btn-success">Manejo de variables ambientales</a>
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
        {{ $greenhouse_sections->links() }}
    </div>
</div>
@endsection