@extends('layouts.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte: Temperaturas</h3>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div id="container"></div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Ultimas 10 lecturas</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Last readings -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha de lectura</th>
                            <th scope="col">Lectura</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($retHumidities as $retHumidity)
                            <tr>
                                <th scope="row">{{ $retHumidity->created_at }}</th>
                                <td>{{ $retHumidity->reading }}</td>
                                <td>{{ $retHumidity->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Indicators -->
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Indicadores de las últimas 10 lecturas</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-2">Promedio de lectura</h5>
                            <span class="h1 font-weight-bold mb-0">{{ $data[0]['average'] }}</span>
                        </div>
                    </div>
{{--                    <p class="mt-2 mb-0 text-md">--}}
{{--                        <span class="text-success mr-2 "> Alto</span>--}}
{{--                    </p>--}}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-2">Lectura mínima</h5>
                            <span class="h1 font-weight-bold mb-0">{{ $data[0]['minimum'] }}</span>
                        </div>
                    </div>
{{--                    <p class="mt-2 mb-0 text-md">--}}
{{--                        <span class="text-warning mr-2 "> Normal</span>--}}
{{--                    </p>--}}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-2">Lectura máxima</h5>
                            <span class="h1 font-weight-bold mb-0">{{ $data[0]['maximum'] }}</span>
                        </div>
                    </div>
{{--                    <p class="mt-2 mb-0 text-md">--}}
{{--                        <span class="text-danger mr-2 "> Bajo</span>--}}
{{--                    </p>--}}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="{{ asset("js/charts/ret-humidity-condition.js") }}"></script>
@endsection
