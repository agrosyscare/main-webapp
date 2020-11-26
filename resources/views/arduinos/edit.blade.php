@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">

        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar dispositivo Arduino</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('arduinos') }}" class="btn btn-sm btn-default">
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

        <form action="{{ url('arduinos/'.$arduino->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="model">Modelo del dispositivo</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $arduino->model_arduino) }}"
                    required>
            </div>
            <div class="form-group">
                <label for="serial">Descripción</label>
                <input type="text" name="serial" class="form-control"
                    value="{{ old('serial', $arduino->serial_arduino) }}">
            </div>
            <button type="submit" class="btn btn-primary">
                Actualizar
            </button>
        </form>

    </div>

</div>
@endsection
