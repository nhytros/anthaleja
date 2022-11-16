@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.market.products.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.market.products.list') }}</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-no-border">
                            <thead>
                                <th>{{ __('Code') }} / {{ __('Name') }}</th>
                                <th>{{ __('Section') }} / {{ __('Category') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr>
                                        <td class="d-flex flex-row align-items-center">
                                            @if ($p->main_image)
                                                <img src="{{ $p->main_image }}" class="me-2" alt="{{ $p->name }}" width=64 />
                                            @endif
                                            @if ($p->status == true)
                                                {!! getIcon('fas', 'check-circle text-success me-2') !!}
                                            @else
                                                {!! getIcon('fas', 'stop-circle text-danger me-2') !!}
                                            @endif
                                            <small class="text-muted">{{ $p->code }}/</small>{{ $p->name }}
                                        <td>
                                            <small class="text-muted">{{ $p->section->name }}/</small>{{ $p->category->name }}
                                        </td>


                                        <td>@include('admin._partials.dred', [
                                            'key' => $p,
                                            'field' => 'slug',
                                            'model' => 'market.product',
                                            'permission_group' => 'market-products',
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
            <div class="col-4">
                <div class="card shadow">
                    <h4 class="card-header">
                        {{ $product ? trans('admin.market.product.edit', ['name' => $product->slug]) : trans('admin.market.product.add') }}
                    </h4>
                    <div class="card-body">
                        @if ($product)
                            <div class="text-end mb-2">
                                <a href="{{ route('admin.market.product.attributes.add', $product->slug) }}" class="btn btn-sm btn-success">
                                    {!! getIcon('fas', 'plus', trans('admin.market.product.add_attributes')) !!}
                                </a>
                            </div>
                        @endif
                        <form action="{{ $product ? route('admin.market.product.update', $product->slug) : route('admin.market.product.store') }}"
                            method="post" enctype="multipart/form-data">@csrf
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="selectCategory">{!! getIcon('fas', 'list') !!}</label>
                                <select class="form-select" id="selectCategory" name="category_id">
                                    <option selected>{{ __('Select category') }}</option>
                                    @foreach ($categories as $s)
                                        <optgroup class="bg-info" label="{{ $s->name }}"></optgroup>
                                        @foreach ($s->categories as $sc)
                                            <option
                                                value="{{ $sc->id }}"{{ $product && $sc->id == $product->category_id ? ' selected' : '' }}>
                                                --&nbsp;{{ $sc->name }}</option>
                                            @foreach ($sc->subcategories as $sub)
                                                <option value="{{ $sub->id }}"
                                                    {{ $product && $sub->id == $product->category_id ? ' selected' : '' }}>
                                                    &nbsp;&nbsp;--&nbsp;{{ $sub->name }}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="selectBrand">{!! getIcon('fab', 'qq') !!}</label>
                                <select class="form-select" id="selectBrand" name="brand_id">
                                    <option selected>{{ __('Select brand...') }}</option>
                                    @foreach ($brands as $b)
                                        <option value="{{ $b->id }}"{{ $product && $b->id == $product->brand_id ? ' selected' : '' }}>
                                            {{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'box') !!}</span>
                                <input type="text" class="form-control" name="name" value="{{ $product ? $product->name : old('name') }}"
                                    placeholder="{{ __('Name') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'link') !!}</span>
                                <input type="text" class="form-control" name="slug" value="{{ $product ? $product->slug : old('slug') }}"
                                    placeholder="{{ __('Slug') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'barcode') !!}</span>
                                <input type="text" class="form-control" name="code" value="{{ $product ? $product->code : old('code') }}"
                                    placeholder="{{ __('Name') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tint') !!}</span>
                                <input type="text" class="form-control" name="color" value="{{ $product ? $product->color : old('color') }}"
                                    placeholder="{{ __('Color') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! athel() !!}</span>
                                <input type="text" class="form-control" name="price" value="{{ $product ? $product->price : old('price') }}"
                                    placeholder="{{ __('Price') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2" id="discount">
                                <span class="input-group-text">{!! getIcon('fas', 'percent') !!}</span>
                                <input type="number" min=0 max=100 class="form-control" name="discount"
                                    value="{{ $product ? $product->discount : old('discount') }}" placeholder="{{ __('Discount') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" user="switch" name="is_promo" id="is_promo"
                                    {{ $product && $product->is_promo ? ' checked' : '' }}>
                                <label class="form-check-label">{{ __('In promotion') }}</label>
                            </div>
                            <div class="input-group mb-2" id="promo_price">
                                <span class="input-group-text">{!! athel() !!}</span>
                                <input type="text" class="form-control" name="promo_price"
                                    value="{{ $product ? $product->promo_price : old('promo_price') }}"
                                    placeholder="{{ __('Promotion price') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'calendar') !!}</span>
                                <input type="date" class="form-control" name="start_promo"
                                    value="{{ $product ? $product->start_promo : old('start_promo') }}" placeholder="{{ __('Start date') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'calendar') !!}</span>
                                <input type="date" class="form-control" name="end_promo"
                                    value="{{ $product ? $product->end_promo : old('end_promo') }}" placeholder="{{ __('End date') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tint') !!}</span>
                                <input type="text" class="form-control" name="color"
                                    value="{{ $product ? $product->color : old('color') }}" placeholder="{{ __('Color') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'weight') !!}</span>
                                <input type="text" class="form-control" name="weight"
                                    value="{{ $product ? $product->weight : old('weight') }}" placeholder="{{ __('Weight') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="fileMainImage">
                                    @if ($product && $product->main_image)
                                        <a data-bs-toggle="modal" data-bs-target="#previewImageModal"><img src="{{ $product->main_image }}"
                                                width=24 alt="{{ $product->name }}"></a>
                                    @else
                                        {!! getIcon('fas', 'image') !!}
                                    @endif
                                </label>
                                <input type="file" class="form-control" id="fileMainImage" name="main_image" accept="image/*">
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="fileMainImage">
                                    @if ($product)
                                        {!! getIcon('fas', 'images') !!}
                                    @endif
                                </label>
                                <input type="file" class="form-control" id="fileImages" name="images[]" accept="image/*" multiple />
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="fileVideo">
                                    @if ($product && $product->video)
                                        <a data-bs-toggle="modal" data-bs-target="#previewVideoModal">{!! getIcon('fas', 'play') !!}</a>
                                    @else
                                        {!! getIcon('fas', 'video') !!}
                                    @endif

                                </label>
                                <input type="file" class="form-control" id="fileVideo" name="video" accept="video/*">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{{ __('Description') }}</span>
                                <textarea class="form-control" name="description" rows=6></textarea>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $product ? $product->meta_title : old('meta_title') }}" placeholder="{{ __('Meta Title') }}"
                                    @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="meta_description"
                                    value="{{ $product ? $product->meta_description : old('meta_description') }}"
                                    placeholder="{{ __('Meta Description') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">{!! getIcon('fas', 'tag') !!}</span>
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ $product ? $product->meta_keywords : old('meta_keywords') }}"
                                    placeholder="{{ __('Meta Keywords') }}" @unlessrole('admin') disabled @else @endunlessrole />
                            </div>

                            {{-- TODO: Ask confirmation for featured product --}}
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" user="switch" name="is_featured"
                                    {{ ($product && $product->is_featured ? ' checked' : !$product) ? '' : '' }}>
                                <label class="form-check-label"><abbr
                                        title="{{ trans('admin.market.product.featured_info') }}">{!! getIcon('fas', 'info-circle text-success', __('Featured')) !!}</abbr></label>
                            </div>

                            @if ($product)
                                @role('admin')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" user="switch" name="status"
                                            {{ ($product && $product->status ? ' checked' : !$product) ? ' checked' : '' }}>
                                        <label class="form-check-label">Status</label>
                                    </div>
                                @endrole
                            @endif
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.market.products') }}" class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                            <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($product)
        <div class="modal fade" id="previewImageModal" tabindex="-1" aria-labelledby="previewImageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewImageModalLabel">{{ trans('admin.market.global.image_preview') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="img-fluid" src="{{ $product->main_image }}" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="previewVideoModal" tabindex="-1" aria-labelledby="previewVideoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewVideoModalLabel">{{ trans('admin.market.global.video_preview') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        TODO: Fix to play other videos
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $product->video }}?html5=1"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script>
        // TODO: To fix promo switch
        $(document).ready(function() {
            $('#is_promo').on('change', function() {
                console.log($(this).val());
                if $(this).val() == true {
                    $('#promo_price').show();
                } else {
                    $('#promo_price').hide();
                }
            });
        });
    </script>
@endsection
