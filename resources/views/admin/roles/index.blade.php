@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.roles.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <h4 class="card-header">{{ trans('admin.roles.list') }}</h4>
                    <div class="card-body">
                        <table class="table table-sm table-no-border">
                            <thead>
                                <th>{{ __('Name') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($roles as $r)
                                    <tr>
                                        <td>{{ ucfirst($r->name) }}</td>
                                        <td>@include('admin._partials.dred', [
                                            'key' => $r,
                                            'field' => 'slug',
                                            'model' => 'role',
                                            'permission_group' => 'roles',
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
                        {{ $role ? trans('admin.role.edit', ['name' => $role->name]) : trans('admin.role.add') }}</h4>
                    <div class="card-body">
                        <form action="{{ $role ? route('admin.role.update', $role->slug) : route('admin.role.store') }}"
                            method="post">@csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text w-10">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $role ? $role->name : old('name') }}" placeholder="{{ __('Name') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-10">{!! getIcon('fas', 'link') !!}</span>
                                <input type="text" class="form-control" name="slug"
                                    value="{{ $role ? $role->slug : old('slug') }}" placeholder="{{ __('Slug') }}" />
                            </div>
                            @role('admin')
                                <div class="input-group mb-3">
                                    <label class="input-group-text w-10">{!! getIcon('fas', 'sort') !!}</label>
                                    <select class="form-select" name="priority">
                                        <option value="0">{{ trans('admin.roles.priority.select') }}</option>
                                        @for ($p = -96; $p <= 96; $p++)
                                            <option value="{{ $p }}"
                                                @if ($role && $p == $role->priority) selected @endif>{{ $p }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="status"
                                        {{ ($role && $role->status ? ' checked' : !$role) ? ' checked' : '' }}>
                                    <label class="form-check-label">Status</label>
                                </div>
                            @endrole
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.roles') }}" class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                            <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                        </div>
                    </div>
                    </form>
                </div>
                @if ($role)
                    <div class="card shadow mt-2">
                        <div class="card-header">
                            <h4>{{ trans('admin.roles.permissions') }}</h4>
                            <p class="small">{!! trans('admin.roles.permissions.desc', ['name' => $role->name]) !!}</p>
                        </div>
                        <div class="card-body">
                            @if ($role->permissions)
                                <p class="small">{{ trans('admin.roles.permissions.revoke_single') }}</p>
                                <div class="btn-group" role="group">
                                    @foreach ($role->permissions as $rp)
                                        <form
                                            action="{{ route('admin.role.permission.revoke', [$role->slug, $rp->slug]) }}"
                                            method="post">@csrf
                                            <button type="submit"
                                                class="badge rounded-pill text-bg-{{ !strpos($rp->name, '-') ? 'danger' : 'primary' }}"
                                                value="{{ $rp->name }}">{{ $rp->name }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            @endif
                            <hr>
                            <form action="{{ route('admin.role.permission.give', $role->slug) }}" method="post">@csrf
                                <div class="input-group mt-2">
                                    <select class="form-select" name="permission">
                                        <option selected>{{ trans('admin.roles.permissions.choose') }}</option>
                                        @foreach ($permissions as $p)
                                            <option value="{{ $p->name }}" {!! !strpos($p->name, '-') ? 'class="fw-bold text-danger"' : '' !!}>
                                                {{ $p->name }}
                                                {{ !strpos($p->name, '-') ? trans('admin.roles.permissions.any', ['name' => $p->name]) : '' }}
                                            </option>
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
