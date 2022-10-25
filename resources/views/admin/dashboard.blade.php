@extends('layouts.main')
@section('content')
    <main class="col-12">
        @include('admin._partials.card_header', ['title' => trans('admin.dashboard')])
    </main>
@endsection
