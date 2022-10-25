@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.market.sections.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.market.sections.list') }}</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-no-border">
                            <thead>
                                <th>{{ __('Name') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($sections as $s)
                                    <tr>
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($s->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            {{ $s->name }}
                                        <td>@include('admin._partials.dred', [
                                            'key' => $s,
                                            'field' => 'slug',
                                            'model' => 'market.section',
                                            'permission_group' => 'market-sections',
                                            'edit' => 1,
                                            'delete' => 1,
                                            'restore' => 1,
                                            'destroy' => 1,
                                        ])</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow">
                    <h4 class="card-header">
                        {{ $section ? trans('admin.market.section.edit', ['name' => $section->slug]) : trans('admin.market.section.add') }}
                    </h4>
                    <div class="card-body">
                        <form
                            action="{{ $section ? route('admin.market.section.update', $section->slug) : route('admin.market.section.store') }}"
                            method="post">@csrf
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $section ? $section->name : old('name') }}" placeholder="{{ __('Name') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            @if ($section)
                                @role('admin')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" user="switch" name="status"
                                            {{ ($section && $section->status ? ' checked' : !$section) ? ' checked' : '' }}>
                                        <label class="form-check-label">Status</label>
                                    </div>
                                @endrole
                            @endif

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.market.sections') }}"
                                class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                            <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
