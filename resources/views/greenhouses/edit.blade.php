@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">

        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar invernadedo</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('greenhouses') }}" class="btn btn-sm btn-default">
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

        <form action="{{ url('greenhouses/'.$greenhouse->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre del invernadero</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $greenhouse->name_greenhouse) }}"
                    required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" name="description" class="form-control"
                    value="{{ old('description', $greenhouse->description) }}">
            </div>
            <button type="submit" class="btn btn-primary">
                Actualizar
            </button>
        </form>

    </div>

</div>
@endsection
