@extends('layouts.main')
@section('content')
    <div class="col-9">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <th>{{ __('Player') }}</th>
                        <th>{{ __('Team') }}</th>
                    </thead>
                    @foreach ($players as $p)
                        <tr>
                            <td>
                                @if ($p->gender == 'female')
                                    <span style="color:salmon">{!! getIcon('fas', 'venus') !!}</span>
                                @else
                                    <span style="color:skyblue">{!! getIcon('fas', 'mars') !!}</span>
                                @endif
                                {{ $p->last_name }} {{ $p->first_name }}
                            </td>
                            <td>
                                <img width=48 src="{{ $p->team->logo }}" alt="">
                                {{ $p->team->name }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
