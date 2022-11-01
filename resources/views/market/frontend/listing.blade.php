@extends('layouts.main')
@section('content')
    <main class="col-12">
        @include('market.frontend.partials._market_nav_top')
        <div class="container-fluid mt-3">
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <button class="mx-1" id="list">{!! getIcon('fas', 'list') !!}</button>
                            <button class="mx-1" id="grid">{!! getIcon('fas', 'th') !!}</button>
                            <nav aria-label="breadcrumb" class="ms-3">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('market.home') }}">Home</a></li>
                                    {!! $details['breadcrumb'] ?? '' !!}
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="input-group mx-1">
                                <form action="{{ route('market.filters') }}" method="post">@csrf
                                    <div class="input-group">
                                        <select class="form-select" id="nxpage" name="nxpage">
                                            <option value="{{ $products->count() }}" selected>Showing:
                                                {{ $products->count() }}</option>
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                            <option value="48">48</option>
                                            <option value="60">60</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <select class="form-select" id="order_by" name="order_by">
                                            <option value="" selected>order by...</option>
                                            <option value="latest">Latest</option>
                                            <option value="lowest">Lowest price</option>
                                            <option value="highest">Highest price</option>
                                            <option value="name_az">Name A-Z</option>
                                            <option value="name_za">Name Z-A</option>
                                        </select>
                                        <button class="btn btn-success me-1" type="submit">Go!</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">side</div>
                    <div class="col-9">
                        <div class="card-title pt-2">{{ $details['details']['description'] ?? '' }}</div>
                        <div id="products" class="row view-group me-2">
                            @foreach ($products as $product)
                                @include('market.frontend.partials._market_products_listing_card',
                                    compact('product'))
                            @endforeach
                        </div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#products .item').removeClass('grid-group-item');
            $('#products .item').addClass('list-group-item');

            $('#grid').click(function(event) {
                event.preventDefault();
                $('#products .item').removeClass('list-group-item');
            });
            $('#list').click(function(event) {
                event.preventDefault();
                $('#products .item').removeClass('grid-group-item');
                $('#products .item').addClass('list-group-item');
            });
        });
    </script>
@endsection
