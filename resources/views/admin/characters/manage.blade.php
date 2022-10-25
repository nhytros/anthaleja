@extends('layouts.main')
@section('content')
    <main class="col-12">
        @include('admin._partials.card_header', [
            'title' => trans('admin.character.' . $character ? 'edit' : 'create'),
        ])
        <div class="card shadow">
            <h4 class="card-header">
                {{ $character ? trans('admin.character.edit', ['name' => $character->username]) : trans('admin.character.create') }}
            </h4>
            <div class="card-body">
                <form
                    action="{{ $character ? route('admin.character.update', $character->username) : route('admin.character.store') }}"
                    method="post">@csrf
                    <div class="input-group mb-2">
                        <label class="input-group-text">{!! getIcon('fas', 'user') !!}</label>
                        <select class="form-select" name="user_id">
                            <option selected>{{ trans('admin.character.select_user') }}</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->id }} - {{ $u->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{!! getIcon('fas', 'user') !!}</span>
                        <input type="text" class="form-control" name="first_name"
                            value="{{ $character ? $character->first_name : old('first_name') }}"
                            placeholder="{{ trans('admin.character.first_name') }}"
                            @unlessrole('admin') disabled @else @endunlessrole />
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{!! getIcon('fas', 'user') !!}</span>
                        <input type="text" class="form-control" name="last_name"
                            value="{{ $character ? $character->last_name : old('last_name') }}"
                            placeholder="{{ trans('admin.character.last_name') }}"
                            @unlessrole('admin') disabled @else @endunlessrole />
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{!! getIcon('fas', 'user') !!}</span>
                        <input type="text" class="form-control" name="username"
                            value="{{ $character ? $character->username : old('username') }}"
                            placeholder="{{ trans('admin.character.username') }}"
                            @unlessrole('admin') disabled @else @endunlessrole />
                    </div>
                    <div class="input-group mb-2">
                        {{-- Gender --}}
                        <label class="input-group-text">{!! getIcon('fas', 'venus-mars') !!}</label>
                        <select class="form-select" name="gender">
                            <option selected>{{ trans('admin.character.select_gender') }}</option>
                            {{-- TODO: Make gender icons visible --}}
                            <option value="male">&#xf222; {{ __('Male') }}</option>
                            <option value="female">&#xf221; {{ __('Female') }}</option>
                        </select>
                        {{-- Height --}}
                        <span class="input-group-text">{!! getIcon('fas', 'ruler-vertical') !!}</span>
                        <input type="number" min=150 max=210 class="form-control" name="height"
                            value="{{ $character ? $character->height : old('height') }}"
                            placeholder="{{ trans('admin.character.height') }}"
                            @unlessrole('admin') disabled @else @endunlessrole />
                        {{-- Date of Birth --}}
                        <span class="input-group-text">{!! getIcon('fas', 'calendar') !!}</span>
                        <input type="date" class="form-control" name="date_of_birth"
                            value="{{ $character ? $character->date_of_birth : old('date_of_birth') }}"
                            placeholder="{{ trans('admin.character.date_of_birth') }}"
                            @unlessrole('admin') disabled @else @endunlessrole />
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text">{!! getIcon('fas', 'portrait') !!}</label>
                        <input type="file" class="form-control" name="avatar" />
                    </div>
                    @role('admin')
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" character="switch" name="status"
                                {{ ($character && $character->status ? ' checked' : !$character) ? ' checked' : '' }}>
                            <label class="form-check-label">Status</label>
                        </div>
                    @endrole
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.characters') }}" class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                    <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                </div>
            </div>
            </form>
        </div>
    </main>
@endsection
