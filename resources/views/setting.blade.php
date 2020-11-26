@extends('layouts.panel')

@section('content')
<form action="{{ url('settings'), $id }}" method="post">
  @csrf
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Gestionar condiciones ambientales</h3>
        </div>
        <div class="col text-right">
          <button type="submit" class="btn btn-sm btn-success">
            Guardar cambios
          </button>
        </div>
      </div>
    </div>

    <div class="card-body">
      @if (session('notification'))
      <div class="alert alert-success" role="alert">
        {{ session('notification') }}
      </div>
      @endif

      @if (session('errors'))
      <div class="alert alert-danger" role="alert">
        Los cambios se han guardado pero tener en cuenta que:
        <ul>
          @foreach (session('errors') as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>

    <div class="table-responsive">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Condicion ambiental</th>
            <th scope="col">Límite mínimo</th>
            <th scope="col">Límite máximo</th>
          </tr>
        </thead>
        @if ($settings->isEmpty())
        <tbody>
          @foreach ($environmentalConditions as $environmentalCondition)
          <tr>
            <th>{{ $environmentalCondition }}</th>
            <td>
              <div class="form-group">
                <input class="form-control" type="number" value="0.0" id="example-number-input" name="min_value[]">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input class="form-control" type="number" value="0.0" id="example-number-input" name="max_value[]">
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
        @else
        <tbody>
          @foreach ($settings as $key => $setting)
          <tr>
            <th>{{ $environmentalConditions[$key] }}</th>
            <td>
              <div class="form-group">
                <input class="form-control" type="number" value="{{ old('min_value', $setting->min_value) }}"
                  id="example-number-input" name="min_value[]">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input class="form-control" type="number" value="{{ old('max_value', $setting->max_value) }}"
                  id="example-number-input" name="max_value[]">
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
        @endif
      </table>
    </div>
    <div class="form-group" hidden>
      <input class="form-control" type="number" value="{{ old('id', $id) }}" name="greenhouse_section_id" hidden>
    </div>
  </div>
</form>
@endsection