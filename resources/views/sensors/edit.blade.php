@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header border-0">

        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar sensor</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('sensors') }}" class="btn btn-sm btn-default">
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

        <form action="{{ url('sensors/'.$sensor->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="model_sensor">Modelo del sensor</label>
                <input type="text" name="model_sensor" class="form-control" value="{{ old('model_sensor', $sensor->model_sensor) }}">
            </div>

            <div class="form-group">
                <label for="serial_sensor">Número de serie</label>
                <input type="text" name="serial_sensor" class="form-control" value="{{ old('planting_type', $sensor->serial_sensor) }}">
            </div>

            <div class="form-group">
                <label for="environmental_condition_id">Condición ambiental</label>
                <select name="environmental_condition_id" id="environmental_condition_id" class="form-control selectpicker" data-style="btn-outline-secondary" title="Escoge una condición ambiental">
                    @foreach ($environmental_conditions as $environmental_condition)
                    <option value="{{ $environmental_condition->id }}">{{ $environmental_condition->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="arduino_id">Arduino asignado</label>
                <select name="arduino_id" id="arduino_id" class="form-control selectpicker" data-style="btn-outline-secondary" title="Asocia un Arduino">
                    @foreach ($arduinos as $arduinos)
                    <option value="{{ $arduinos->id }}">{{ $arduinos->model_arduino }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="greenhouse_section_id">Cancha asignada</label>
                <select name="greenhouse_section_id" id="greenhouse_section_id" class="form-control selectpicker" data-style="btn-outline-secondary" title="Asocia una cancha">
                    @foreach ($greenhouse_sections as $greenhouse_section)
                    <option value="{{ $greenhouse_section->id }}">{{ $greenhouse_section->name_section }}</option>
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
<script>
    $(document).ready(() => {
      $('#environmental_condition_id').selectpicker('val', @json($environmental_condition_ids));
      $('#arduino_id').selectpicker('val', @json($arduino_ids));
      $('#greenhouse_section_id').selectpicker('val', @json($greenhouse_section_ids));
    });
</script>
@endsection
