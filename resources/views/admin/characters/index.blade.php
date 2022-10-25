<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <div class="d-flex justify-content-between">
                <p>{!! trans('admin.characters.intro') !!}</p>
                @include('admin._partials.btn_add', ['model' => 'character'])
                {{-- <span>
                    <a href="{{ route('admin.character.create') }}" class="btn btn-sm btn-success">{!! getIcon('fas', 'plus', __('Add new Character')) !!}</a>
                </span> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <h4 class="card-header">{{ trans('admin.characters.list') }}</h4>
                    <div class="card-body">
                        <table class="table table-sm align-middle" id="dt-characters">
                            <thead>
                                <th>{{ __('Status') }} / {{ __('username') }}</th>
                                <th>{{ __('Roles') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($characters as $c)
                                    {{-- @php
                                        $u = $c->user();
                                    @endphp --}}
                                    <tr class="align-self-center">
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($c->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            <a class="nodec"
                                                href="{{ route('admin.character.show', $c->username) }}">{{ $c->username }}</a>
                                            <br />real_username
                                            {{-- TODO: Display the username related to character --}}
                                            {{-- {{ $c->character->user->username }} --}}
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($c->user->roles as $r)
                                                    <li>{{ $r->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $c->created_at->format('Y, d/m G:i:s') }}</td>
                                        <td>@include('admin._partials.dred', [
                                            'key' => $c,
                                            'field' => 'username',
                                            'model' => 'character',
                                            'permission_group' => 'characters',
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
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dt-characters').DataTable();
        });
    </script>
@endsection
