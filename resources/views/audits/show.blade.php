@extends('layouts.panel')

@section('content')
    <div id="article" class="container" data-metadata='{!! $audit->getMetadata(true) !!}' data-modified='{!! $audit->getModified(true) !!}'>
        <div v-model="metadata">
            <div class="row">
                <div class="col-md-3">
                    <strong>@lang('common.id')</strong>
                </div>
                <div class="col-md-9">@{{ metadata.audit_id }}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <strong>@lang('common.event')</strong>
                </div>
                <div class="col-md-9">@{{ metadata.audit_event }}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <strong>@lang('common.user')</strong>
                </div>
                <div class="col-md-9">@{{ metadata.user_name }}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <strong>@lang('common.ip_address')</strong>
                </div>
                <div class="col-md-9">@{{ metadata.audit_ip_address }}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <strong>@lang('common.user_agent')</strong>
                </div>
                <div class="col-md-9">@{{ metadata.audit_user_agent }}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <strong>@lang('common.tags')</strong>
                </div>
                <div class="col-md-9">@{{ metadata.audit_tags.join() }}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <strong>@lang('common.url')</strong>
                </div>
                <div class="col-md-9">@{{ metadata.audit_url }}</div>
            </div>
        </div>

        <hr/>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('common.attribute')</th>
                <th>@lang('common.old')</th>
                <th>@lang('common.new')</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(value, attribute) in modified">
                <td><strong>@{{ attribute }}</strong></td>
                <td class="danger">@{{ value.old }}</td>
                <td class="success">@{{ value.new }}</td>
            </tr>
            </tbody>
        </table>
    </div>


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

        </div>
    </div>
@endsection

