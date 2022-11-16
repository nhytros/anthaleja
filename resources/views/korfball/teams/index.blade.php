@extends('layouts.main')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <td>{{ __('Flag') }}</td>
                        <td>{{ __('Logo') }}</td>
                        <td>{{ __('Team') }}</td>
                        <td>{{ __('League') }}</td>
                        <td>{{ __('Country') }}</td>
                    </thead>
                    @foreach ($teams as $t)
                        <tr>
                            <td><img width=48 src="{{ $t->flag }}" alt=""></td>
                            <td><img width=48 src="{{ $t->logo }}" alt=""></td>
                            <td>{{ $t->name }}</td>
                            <td>{{ $t->league->name }}</td>
                            <td>{{ $t->country }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
