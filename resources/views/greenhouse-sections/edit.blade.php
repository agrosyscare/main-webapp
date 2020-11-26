@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header border-0">

        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar cancha</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('greenhouse-sections') }}" class="btn btn-sm btn-default">
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

        <form action="{{ url('greenhouse-sections/'.$greenhouse_section->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name_section">Nombre de sección</label>
                <input type="text" name="name_section" class="form-control" value="{{ old('name_section', $greenhouse_section->name_section) }}">
            </div>

            <div class="form-group">
                <label for="planting_type">Especies plantadas</label>
                <input type="text" name="planting_type" class="form-control" value="{{ old('planting_type', $greenhouse_section->planting_type) }}">
            </div>

            <div class="form-group">
                <label for="greenhouse_id">Invernaderos</label>
                <select name="greenhouse_id" id="greenhouse_id" class="form-control selectpicker" data-style="btn-outline-secondary" title="Escoge un invernadero">
                    @foreach ($greenhouses as $greenhouse)
                    <option value="{{ $greenhouse->id }}">{{ $greenhouse->name_greenhouse }}</option>
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
      $('#greenhouse_id').selectpicker('val', @json($greenhouse_ids));
    });
</script>
@endsection
