@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.users.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-9">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.users.list') }}</div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {!! getIcon('fas', 'filter') !!}
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item fw-bold">{{ __('Roles') }}</li>
                                    @foreach ($roles as $r)
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.users.filterByRole', $r->name) }}">{{ $r->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <thead>
                                <th>{{ __('Status') }} / {{ __('Username') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Roles') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr class="border">
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($u->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            <a href="{{ route('admin.user.show', $u->username) }}">
                                                {{ $u->username }}</a>
                                        <td><a href="{{ route('admin.user.show', $u->username) }}">{{ $u->email }}</a>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($u->roles as $r)
                                                    <li>{{ $r->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>@include('admin._partials.dred', [
                                            'key' => $u,
                                            'field' => 'username',
                                            'model' => 'user',
                                            'permission_group' => 'users',
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
            <div class="col-3">
                <div class="card shadow">
                    <h4 class="card-header">
                        {{ $user ? trans('admin.user.edit', ['name' => $user->username]) : trans('admin.user.add') }}</h4>
                    <div class="card-body">
                        <form
                            action="{{ $user ? route('admin.user.update', $user->username) : route('admin.user.store') }}"
                            method="post">@csrf
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'user') !!}</span>
                                <input type="text" class="form-control" name="username"
                                    value="{{ $user ? $user->username : old('username') }}"
                                    placeholder="{{ __('Username') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'at') !!}</span>
                                <input type="text" class="form-control" name="email"
                                    value="{{ $user ? $user->email : old('email') }}" placeholder="{{ __('Email') }}"
                                    @unlessrole('admin') disabled @endunlessrole />
                            </div>
                            @if ($user)
                                <div class="input-group mb-2">
                                    <span class="input-group-text">{!! getIcon('fas', 'lock') !!}</span>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="{{ __('Password') }}"
                                        @unlessrole('admin') disabled @else @endunlessrole />
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">{!! getIcon('fas', 'lock') !!}</span>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="{{ __('Confirm password') }}"
                                        @unlessrole('admin') disabled @else @endunlessrole />
                                </div>
                                @role('admin')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" user="switch" name="status"
                                            {{ ($user && $user->status ? ' checked' : !$user) ? ' checked' : '' }}>
                                        <label class="form-check-label">Status</label>
                                    </div>
                                @endrole
                            @endif

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.users') }}" class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                            <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                        </div>
                    </div>
                    </form>
                </div>
                @if ($user)
                    <div class="card shadow mt-2">
                        {{-- Roles --}}
                        <div class="card-header">
                            <h4>{{ trans('admin.user.roles') }}</h4>
                            <p class="small">{!! trans('admin.user.roles.desc', ['name' => $user->username]) !!}</p>
                        </div>
                        <div class="card-body">
                            @if ($user->roles)
                                <p class="small">{{ trans('admin.user.roles.remove_single') }}</p>
                                <div class="btn-group" role="group">
                                    @foreach ($user->roles as $ur)
                                        <form action="{{ route('admin.user.role.remove', [$user->username]) }}"
                                            method="post">
                                            @csrf
                                            @if ($ur->name == 'user' ||
                                                ($user->id == 1 && $ur->name == 'admin') ||
                                                ($user->id == 2 && $ur->name == 'governor'))
                                                <span
                                                    class="badge rounded-pill text-bg-danger ms-1">{{ $ur->name }}</span>
                                            @else
                                                <button type="submit" class="badge rounded-pill text-bg-primary ms-1"
                                                    name="role"
                                                    value="{{ $ur->name }}">{{ $ur->name }}</button>
                                            @endif
                                        </form>
                                    @endforeach
                                </div>
                            @endif
                            <hr>
                            <form action="{{ route('admin.user.role.remove', $user->username) }}" method="post">@csrf
                                <div class="input-group mt-2">
                                    <select class="form-select" name="role">
                                        <option selected>{{ trans('admin.users.role.choose') }}</option>
                                        @foreach ($permissions as $r)
                                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary" type="submit">{{ __('Assign') }}</button>
                                </div>
                            </form>
                        </div>

                        {{-- Permissions --}}
                        <div class="card shadow mt-2">
                            <div class="card-header">
                                <h4>{{ trans('admin.permissions') }}</h4>
                            </div>
                            <div class="card-body">
                                @if ($user->permissions)
                                    <p class="small">{{ trans('admin.user.permissions.remove_single') }}</p>
                                    <div class="btn-group" role="group">
                                        @foreach ($user->permissions as $up)
                                            <form action="{{ route('admin.user.permission.remove', $user->username) }}"
                                                method="post">@csrf
                                                <button type="submit" class="badge rounded-pill text-bg-purple"
                                                    name="permission"
                                                    value="{{ $up->name }}">{{ $up->name }}</button>
                                            </form>
                                        @endforeach
                                    </div>
                                @endif
                                <hr>
                                <p>{{ trans('admin.user.permissions.or_assign') }}</p>
                                <form action="{{ route('admin.user.permission.give', $user->username) }}" method="post">
                                    @csrf
                                    <div class="input-group mt-2">
                                        <select class="form-select" name="permission">
                                            <option selected>{{ trans('admin.user.permissions.choose') }}</option>
                                            @foreach ($permissions as $p)
                                                <option value="{{ $p->name }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary" type="submit">{{ __('Assign') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
