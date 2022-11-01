@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.market.banners.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.market.banners.list') }}</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-no-border">
                            <thead>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Title/Alt') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($banners as $b)
                                    <tr>
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($b->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            <img src="{{ $b->image }}" width=120 alt="{{ $b->alt }}"
                                                title="{{ $b->title }}" />
                                        <td>{{ $b->title }}<br />{{ $b->alt }}</td>
                                        <td>@include('admin._partials.dred', [
                                            'key' => $b,
                                            'field' => 'id',
                                            'model' => 'market.banner',
                                            'permission_group' => 'market-banners',
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
                        {{ $banner ? trans('admin.market.banner.edit', ['name' => $banner->id]) : trans('admin.market.banner.add') }}
                    </h4>
                    <div class="card-body">
                        <form
                            action="{{ $banner ? route('admin.market.banner.update', $banner->id) : route('admin.market.banner.store') }}"
                            method="post" enctype="multipart/form-data">@csrf
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="uploadBanner">{{ __('Upload') }}</label>
                                <input type="file" class="form-control" id="uploadBanner" accept="image/*">
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="selectType">{!! getIcon('fas', 'question-circle') !!}</label>
                                <select class="form-select" id="selectType">
                                    <option selected>{{ trans('admin.market.banners.type_select') }}</option>
                                    <option value="slide"{{ $banner && $banner->type == 'slide' ? ' selected' : '' }}>
                                        {{ trans('admin.market.banners.type_slide') }}</option>
                                    <option value="fix"{{ $banner && $banner->type == 'fix' ? ' selected' : '' }}>
                                        {{ trans('admin.market.banners.type_fix') }}</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text" name="link">{!! getIcon('fas', 'link') !!}</span>
                                <input type="text" class="form-control" placeholder="{{ __('Link') }}"
                                    value="{{ $banner ? $banner->link : old('link') }}" />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text" name="title">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" placeholder="{{ __('Title') }}"
                                    value="{{ $banner ? $banner->title : old('title') }}" />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text" name="alt">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" placeholder="{{ __('Alt') }}"
                                    value="{{ $banner ? $banner->alt : old('alt') }}" />
                            </div>
                            @if ($banner)
                                @role('admin')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" user="switch" name="status"
                                            {{ ($banner && $banner->status ? ' checked' : !$banner) ? ' checked' : '' }}>
                                        <label class="form-check-label">Status</label>
                                    </div>
                                @endrole
                            @endif

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.market.banners') }}"
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
