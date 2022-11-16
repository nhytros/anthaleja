@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.market.filter.values.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.market.filter.values.list') }}</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-borderless table-responsive">
                            <thead>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Filter ID') }}</th>
                                <th>{{ __('Value') }}</th>
                                {{-- <th class="text-end">{{ __('Actions') }}</th> --}}
                            </thead>
                            <tbody>
                                @foreach ($values as $v)
                                    <tr>
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($v->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            {{ $v->name }}
                                        <td>{{ $v->filter_id }}</td>
                                        <td>{{ $v->value }}</td>
                                        {{-- <td>@include('admin._partials.dred', [
                                            'key' => $v,
                                            'field' => 'slug',
                                            'model' => 'market.filter.value',
                                            'permission_group' => 'market-filter-values',
                                            'edit' => 1,
                                            'delete' => 1,
                                            'restore' => 1,
                                            'destroy' => 1,
                                        ])</td> --}}
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
                        {{ $value ? trans('admin.market.filter.value.edit', ['name' => $value->slug]) : trans('admin.market.filter.value.add') }}
                    </h4>
                    <div class="card-body">
                        <form
                            action="{{ $value ? route('admin.market.filter.value.update', $value->slug) : route('admin.market.filter.value.store') }}"
                            method="post">@csrf
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'value') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $value ? $value->name : old('name') }}" placeholder="{{ __('Name') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            {{-- <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $value ? $value->name : old('name') }}" placeholder="{{ __('Name') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div> --}}
                            @if ($value)
                                @role('admin')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" user="switch" name="status"
                                            {{ ($value && $value->status ? ' checked' : !$value) ? ' checked' : '' }}>
                                        <label class="form-check-label">Status</label>
                                    </div>
                                @endrole
                            @endif

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.market.filter.values') }}"
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
