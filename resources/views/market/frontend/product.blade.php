@extends('layouts.main')
@section('content')
    <main class="col-12">
        @include('market.frontend.partials._market_nav_top')
        <div class="container-fluid mt-3">
            <div class="card shadow">
                <div class="product-content product-wrap clearfix product-deatil">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="product-image mb-2">
                                <div id="carouselProductDetails" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ $product->main_image }}" class="d-block w-100"
                                                alt="{{ $product->name }}">
                                        </div>
                                        @foreach ($product->images as $pi)
                                            <div class="carousel-item">
                                                <img src="{{ $pi->image }}" class="d-block w-100"
                                                    alt="{{ $product->name }}">
                                            </div>
                                        @endforeach
                                        @if ($product->video)
                                            <div class="carousel-item ratio ratio-16x9">
                                                <iframe src="https://www.youtube.com/embed/{{ $product->video }}"
                                                    title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="product-image-list">
                                @if ($product->main_image)
                                    <img src="{{ $product->main_image }}" width="12%" alt="{{ $product->name }}"
                                        data-bs-target="#carouselProductDetails" data-bs-slide-to="0">
                                @endif
                                @php $i=1; @endphp
                                @foreach ($product->images as $pi)
                                    <img src="{{ $pi->image }}" width="12%" alt="{{ $product->name }}"
                                        data-bs-target="#carouselProductDetails" data-bs-slide-to="{{ $i }}">
                                    @php $i++; @endphp
                                @endforeach
                                @if ($product->video)
                                    <img src="https://i.ytimg.com/vi/{{ $product->video }}/hqdefault.jpg" width='12%'
                                        alt="{{ $product->name }}" data-bs-target="#carouselProductDetails"
                                        data-bs-slide-to="{{ $i++ }}">
                                @endif

                            </div>
                        </div>

                        <div
                            class="col-md-6
                                            col-md-offset-1 col-sm-12 col-xs-12">
                            <h2 class="name">
                                {{ $product->name }}

                                <small class="h6">{!! $category['breadcrumb'] !!}</small>
                                <i class="fa fa-star fa-2x text-primary"></i>
                                <i class="fa fa-star fa-2x text-primary"></i>
                                <i class="fa fa-star fa-2x text-primary"></i>
                                <i class="fa fa-star fa-2x text-primary"></i>
                                <i class="fa fa-star fa-2x text-muted"></i>
                                <span class="fa fa-2x">
                                    <h5>(109) Votes</h5>
                                </span>
                                <a href="javascript:void(0);">109 customer reviews</a>
                            </h2>
                            <hr />
                            <h3 class="price-container">
                                <div class="d-flex flex-row justify-content-center">
                                    @if ($product->getPricePromo($product->id))
                                        <div class="px-2 text-decoration-line-through">
                                            {{ toAthel($product->price) }}
                                        </div>
                                        <div class="px-2 text-danger fs-4">
                                            {{ toAthel($product->getPricePromo($product->id)['price_promo']) }}
                                        </div>
                                    @else
                                        <div class="px-2 fs-4">{{ toAthel($product->price) }}</div>
                                    @endif
                                </div>
                            </h3>
                            <form action="{{ route('market.product.addCart') }}" method="post">@csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                <p><strong>Product Code: </strong>{{ $product->code }}</p>
                                @if ($product->color)
                                    <p><strong>Product Color: </strong><span
                                            style="color:{{ $product->color }}">{!! getIcon('fas', 'square') !!}</span>&nbsp;{{ ucfirst($product->color) }}
                                    </p>
                                @endif
                                @if ($stock > 0)
                                    <p><strong>Availability: </strong><span
                                            class="text-{{ $stock < 10 ? 'danger' : 'success' }}">{{ $stock < 10 ? 'only ' . $stock : $stock }}</span>
                                    </p>
                                @else
                                    <p><strong class="text-danger">Unavailable</strong></p>
                                @endif
                                <p><strong>Vendor: </strong><a
                                        href="{{ route('market.products.vendor', $product->vendor_id) }}">{{ $product->vendor->vdetails->shop_name }}</a>
                                </p>
                                <div class="input-group mb-2">
                                    <label class="input-group-text" for="getPrice">{!! getIcon('fas', 'ruler') !!}</label>
                                    <select class="form-select" name="size" id="getPrice"
                                        product_id="{{ $product->id }}">
                                        <option value="0" selected>Select size</option>
                                        @foreach ($product->attributes as $pa)
                                            <option value="{{ $pa->size }}">{{ $pa->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">{!! getIcon('fas', 'hashtag') !!}</span>
                                    <input type="number" class="form-control w-25" min=1 max={{ $stock }} value=1
                                        name="quantity" placeholder="Quantity">
                                </div>
                                <div class="btn-group text-end" role="group" aria-label="Basic example">
                                    <button type="submit" class="btn btn-success">{!! getIcon('fas', 'cart-plus') !!}</button>
                                    <button type="button"
                                        class="btn btn-light text-danger">{!! getIcon('fas', 'heart') !!}</button>
                                </div>
                            </form>
                            <hr />
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                        role="button" aria-expanded="false">Variants</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($group as $g)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('market.product.details', $g->slug) }}"><img width=48
                                                        src="{{ $g->main_image }}">{{ $g->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="more_tab" data-bs-toggle="tab"
                                        data-bs-target="#more_tab-pane" type="button" role="tab"
                                        aria-controls="more_tab-pane" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="specs-tab" data-bs-toggle="tab"
                                        data-bs-target="#specs-tab-pane" type="button" role="tab"
                                        aria-controls="specs-tab-pane" aria-selected="false">Specification</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                        aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="more_tab-pane" role="tabpanel"
                                    aria-labelledby="more_tab" tabindex="0">
                                    {!! $product->description !!}
                                </div>
                                <div class="tab-pane fade" id="specs-tab-pane" role="tabpanel"
                                    aria-labelledby="specs-tab" tabindex="0">
                                    <dl class="">
                                        {{-- @foreach (\App\Models\ProductFilter::all() as $pf)
                                        @if (isset($category_id))
                                            @php
                                                $fa=ProductFilters::
                                            @endphp
                                            
                                        @endif
                                            
                                        @endforeach --}}
                                        <dt>Gravina</dt>
                                        <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                                        <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                        <dd>Eget lacinia odio sem nec elit.</dd>
                                        <br />

                                        <dt>Test lists</dt>
                                        <dd>A description list is perfect for defining terms.</dd>
                                        <br />

                                        <dt>Altra porta</dt>
                                        <dd>Vestibulum id ligula porta felis euismod semper</dd>
                                    </dl>
                                </div>
                                <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                    aria-labelledby="reviews-tab" tabindex="0">
                                    <form method="post" class="well padding-bottom-10" onsubmit="return false;">
                                        <textarea rows="2" class="form-control" placeholder="Write a review"></textarea>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn btn-sm btn-primary pull-right">
                                                Submit Review
                                            </button>
                                            <a href="javascript:void(0);" class="btn btn-link profile-link-btn"
                                                rel="tooltip" data-placement="bottom" title=""
                                                data-original-title="Add Location"><i
                                                    class="fa fa-location-arrow"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-link profile-link-btn"
                                                rel="tooltip" data-placement="bottom" title=""
                                                data-original-title="Add Voice"><i class="fa fa-microphone"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-link profile-link-btn"
                                                rel="tooltip" data-placement="bottom" title=""
                                                data-original-title="Add Photo"><i class="fa fa-camera"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-link profile-link-btn"
                                                rel="tooltip" data-placement="bottom" title=""
                                                data-original-title="Add File"><i class="fa fa-file"></i></a>
                                        </div>
                                    </form>

                                    <div class="chat-body no-padding profile-message">
                                        <ul>
                                            <li class="message">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                    class="online" />
                                                <span class="message-text">
                                                    <a href="javascript:void(0);" class="username">
                                                        Alisha Molly
                                                        <span class="badge">Purchase Verified</span>
                                                        <span class="pull-right">
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-muted"></i>
                                                        </span>
                                                    </a>
                                                    Can't divide were divide fish forth fish to. Was can't form
                                                    the,
                                                    living life grass darkness very image let unto fowl isn't in
                                                    blessed
                                                    fill life yielding above all moved
                                                </span>
                                                <ul class="list-inline font-xs">
                                                    <li>
                                                        <a href="javascript:void(0);" class="text-info"><i
                                                                class="fa fa-thumbs-up"></i> This was helpful
                                                            (22)</a>
                                                    </li>
                                                    <li class="pull-right">
                                                        <small class="text-muted pull-right ultra-light">
                                                            Posted 1 year
                                                            ago </small>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="message">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                                    class="online" />
                                                <span class="message-text">
                                                    <a href="javascript:void(0);" class="username">
                                                        Aragon Zarko
                                                        <span class="badge">Purchase Verified</span>
                                                        <span class="pull-right">
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                            <i class="fa fa-star fa-2x text-primary"></i>
                                                        </span>
                                                    </a>
                                                    Excellent product, love it!
                                                </span>
                                                <ul class="list-inline font-xs">
                                                    <li>
                                                        <a href="javascript:void(0);" class="text-info"><i
                                                                class="fa fa-thumbs-up"></i> This was helpful
                                                            (22)</a>
                                                    </li>
                                                    <li class="pull-right">
                                                        <small class="text-muted pull-right ultra-light">
                                                            Posted 1 year
                                                            ago </small>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <a href="javascript:void(0);" class="btn btn-sm">{!! getIcon('fas', 'cart-plus') !!}</a>
                                <button class="btn btn-sm">{!! getIcon('fas', 'star') !!}</button>
                                <button class="btn btn-sm">{!! getIcon('fas', 'envelope') !!}</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="similar" class="row view-group me-2">
                        <h3>Similar Products</h3>
                        @foreach ($similar as $product)
                            @include('market.frontend.partials._market_products_listing_card',
                                ['width' => null],
                                compact('product'))
                        @endforeach
                    </div>

                    <hr>
                    <div id="similar" class="row view-group me-2">
                        <h3>Recently Viewed</h3>
                        @foreach ($rvp as $product)
                            @include('market.frontend.partials._market_products_listing_card',
                                ['width' => 2],
                                compact('product'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#getPrice").change(function() {
                var size = $(this).val();
                var product_id = $(this).attr('product_id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/market/product/get_product_price',
                    data: {
                        size: size,
                        product_id: product_id
                    },
                    type: 'post',
                    success: function(resp) {
                        alert(resp['price_promo']);
                    },
                    error: function() {
                        alert('Error!');
                    }
                });
            });
        });
    </script>
@endsection
