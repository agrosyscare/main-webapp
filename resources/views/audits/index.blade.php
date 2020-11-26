@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Lista de auditoria</h3>
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
                    <th scope="col">Usuario</th>
                    <th scope="col">Tabla afectada</th>
                    <th scope="col">Evento</th>
                    <th scope="col">Detalles</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($audits as $audit)
                    <tr>
                        <th scope="row">
                            {{ $audit->rut }}
                        </th>
                        <td>
                            {{ $audit->auditable_type }}
                        </td>
                        <td>
                            {{ $audit->event }}
                        </td>
                        <td>
                            <form action="{{ url('audits/'.$audit->id) }}" method="post">
                                @csrf
{{--                                <a href="{{ url('audits/'.$audit->id.'/show') }}"--}}
{{--                                   class="btn btn-sm btn-primary">Mostrar detalles</a>--}}
                                <a href="#"
                                class="btn btn-sm btn-primary">Mostrar detalles</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
