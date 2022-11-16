@extends('layouts.main')

@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.permissions.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <h4 class="card-header">{{ trans('admin.permissions.list') }}</h4>
                    <div class="card-body">
                        <table class="table table-sm table-no-border">
                            <thead>
                                <th>{{ __('Name') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $p)
                                    <tr
                                        class="{{ !strpos($p->name, '-') ? 'bg-info text-dark fw-bold text-uppercase disabled' : 'bg-light text-dark text-lowercase' }} align-middle">
                                        <td>
                                            {{ $p->name }}
                                        </td>
                                        <td>@include('admin._partials.dred', [
                                            'key' => $p,
                                            'field' => 'slug',
                                            'model' => 'permission',
                                            'permission_group' => 'permissions',
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
                        {{ $permission ? trans('admin.permission.edit', ['name' => $permission->name]) : trans('admin.permission.add') }}
                    </h4>
                    <div class="card-body">
                        <form
                            action="{{ $permission ? route('admin.permission.update', $permission->slug) : route('admin.permission.store') }}"
                            method="post">@csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text w-10">{!! getIcon('fas', 'tags') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $permission ? $permission->name : old('name') }}"
                                    placeholder="{{ __('Name') }}" autofocus />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-10">{!! getIcon('fas', 'link') !!}</span>
                                <input type="text" class="form-control" name="slug"
                                    value="{{ $permission ? $permission->slug : old('slug') }}"
                                    placeholder="{{ __('Slug') }}" />
                            </div>
                            @role('admin')
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="status"
                                        {{ ($permission && $permission->status ? ' checked' : !$permission) ? ' checked' : '' }}>
                                    <label class="form-check-label">{{ __('Status') }}</label>
                                </div>
                            @endrole
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.permissions') }}"
                                class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                            <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                        </div>
                    </div>
                    </form>
                </div>
                @if ($permission)
                    <div class="card shadow mt-2">
                        <div class="card-header">
                            <h4>{{ trans('admin.permissions') }}</h4>
                            <p class="small">{!! trans('admin.permissions.roles.desc', ['name' => $permission->name]) !!}</p>
                        </div>
                        <div class="card-body">
                            @if ($permission->roles)
                                <p class="small">{{ trans('admin.permissions.roles.remove_single') }}</p>
                                <div class="btn-group" role="group">
                                    @foreach ($permission->roles as $pr)
                                        <form
                                            action="{{ route('admin.permission.role.remove', [$permission->name, $pr->name]) }}"
                                            method="post">@csrf
                                            <button type="submit" class="badge rounded-pill text-bg-purple"
                                                value="{{ $pr->name }}">{{ $pr->name }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            @endif
                            <hr>
                            <p>{{ trans('admin.roles.permissions.or_assign') }}</p>
                            <form action="{{ route('admin.permission.role.assignRole', $permission->slug) }}"
                                method="post">
                                @csrf
                                <div class="input-group mt-2">
                                    <select class="form-select" name="role">
                                        <option selected>{{ trans('admin.permissions.roles.choose') }}</option>
                                        @foreach ($roles as $r)
                                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary" type="submit">{{ __('Assign') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
