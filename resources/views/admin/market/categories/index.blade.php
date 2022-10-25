@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.market.categories.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.market.categories.list') }}</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-no-border" id="categories">
                            <thead>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Section') }}</th>
                                <th>{{ __('Parent') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $c)
                                    @php
                                        if (isset($c->parent->name) && !empty($c->parent->name)) {
                                            $parent = $c->parent->name;
                                        } else {
                                            $parent = '--';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($c->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            {{ $c->name }}
                                        </td>
                                        <td>{{ $c->section->name }}</td>
                                        <td>{{ $parent }}</td>
                                        <td>@include('admin._partials.dred', [
                                            'key' => $c,
                                            'field' => 'slug',
                                            'model' => 'market.category',
                                            'permission_group' => 'market-categories',
                                            'edit' => 1,
                                            'delete' => 1,
                                            'restore' => 1,
                                            'destroy' => 1,
                                        ])</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {!! $categories->links() !!} --}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow">
                    <h4 class="card-header">
                        {{ $category ? trans('admin.market.section.edit', ['name' => $category->slug]) : trans('admin.market.section.add') }}
                    </h4>
                    <div class="card-body">
                        <form
                            action="{{ $category ? route('admin.market.section.update', $category->slug) : route('admin.market.section.store') }}"
                            method="post">@csrf
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $category ? $category->name : old('name') }}"
                                    placeholder="{{ __('Name') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text">{{ trans('admin.market.section') }}</label>
                                <select class="form-select" name="section_id" id="section_id">
                                    <option selected value="0">{{ trans('admin.market.category.main') }}
                                    </option>
                                    @foreach ($sections as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="appendCategoryLevel">
                                @include('admin._partials.append_category_levels')
                            </div>
                            @if ($category)
                                @role('admin')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" user="switch" name="status"
                                            {{ ($category && $category->status ? ' checked' : !$category) ? ' checked' : '' }}>
                                        <label class="form-check-label">Status</label>
                                    </div>
                                @endrole
                            @endif

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.market.categories') }}"
                                class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                            <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#section_id").change(function() {
                var section_id = $(this).val();
                console.log(section_id)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'get',
                    // url: '/admin/market/category/appendCategoryLevel/',
                    url: "{{ route('admin.market.category.appendCategoryLevel') }}",
                    data: {
                        section_id: section_id
                    },
                    success: function(resp) {
                        console.log(resp);
                        $('#appendCategoryLevel').html(resp);
                    },
                    error: function() {
                        alert('Error!');
                    }
                });
            });
        });
    </script>
@endsection
