@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Detalle de datos auditados</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('audits') }}" class="btn btn-sm btn-default">
                        Volver
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div id="article" class="container">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>ID</strong>
                        </div>
                        <div class="col-md-9">{{ $audit->id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Event</strong>
                        </div>
                        <div class="col-md-9">{{ $audit->event }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>User</strong>
                        </div>
                        <div class="col-md-9">{{ $audit->user_id }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>IP Address</strong>
                        </div>
                        <div class="col-md-9">{{ $audit->ip_address }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>User agent</strong>
                        </div>
                        <div class="col-md-9">{{ $audit->user_agent }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Tags</strong>
                        </div>
                        <div class="col-md-9">{{ $audit->tags }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>URL</strong>
                        </div>
                        <div class="col-md-9">{{ $audit->url }}</div>
                    </div>
                </div>

                <hr/>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Atributo</th>
                        <th>Valor antiguo</th>
                        <th>Valor nuevo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><strong>{{ $attributeValue }}</strong></td>
                        <td class="danger">{{ $oldValue }}</td>
                        <td class="success">{{ $newValue }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

