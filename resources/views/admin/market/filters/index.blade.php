@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.market.filters.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.market.filters.list') }}</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-borderless table-responsive">
                            <thead>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Categories') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($filters as $f)
                                    <tr>
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($f->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            {{ $f->name }}
                                        <td>{{ $f->cat_ids }}</td>
                                        <td>@include('admin._partials.dred', [
                                            'key' => $f,
                                            'field' => 'slug',
                                            'model' => 'market.filter',
                                            'permission_group' => 'market-filters',
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
                        {{ $filter ? trans('admin.market.filter.edit', ['name' => $filter->slug]) : trans('admin.market.filter.add') }}
                    </h4>
                    <div class="card-body">
                        <form
                            action="{{ $filter ? route('admin.market.filter.update', $filter->slug) : route('admin.market.filter.store') }}"
                            method="post">@csrf
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'filter') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $filter ? $filter->name : old('name') }}" placeholder="{{ __('Name') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            {{-- <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $filter ? $filter->name : old('name') }}" placeholder="{{ __('Name') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div> --}}
                            @if ($filter)
                                @role('admin')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" user="switch" name="status"
                                            {{ ($filter && $filter->status ? ' checked' : !$filter) ? ' checked' : '' }}>
                                        <label class="form-check-label">Status</label>
                                    </div>
                                @endrole
                            @endif

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.market.filters') }}"
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
