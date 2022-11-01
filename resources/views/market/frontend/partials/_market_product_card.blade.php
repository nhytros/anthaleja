<div class="col-xl-3 col-sm-6">
    <div class="card shadow mb-2">
        <img src="{{ $product->main_image }}" class="card-img-top" alt="{{ $product->name }}">
        @if ($product->created_at >= now()->subDays(7))
            <span class="product-ribbon product-ribbon-right product-ribbon--style-1 bg-blue text-uppercase">New</span>
        @endif
        @if ($product->getPricePromo($product->id) !== [])
            <span
                class="product-promo product-promo-right product-promo--style-1 bg-blue text-uppercase">{{ intval($product->getPricePromo($product->id)['discount']) }}%</span>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <div class="d-flex flex-row justify-content-center">
                @if ($product->getPricePromo($product->id))
                    <div class="px-2 text-decoration-line-through">{{ toAthel($product->price) }}</div>
                    <div class="px-2 text-danger fs-4">
                        {{ toAthel($product->getPricePromo($product->id)['price_promo']) }}</div>
                @else
                    <div class="px-2 fs-4">{{ toAthel($product->price) }}</div>
                @endif
            </div>
            <div class="text-truncate">{!! $product->description !!}</div>
        </div>
        <div class="card-footer text-end my-1">
            <a href="#" class="btn btn-sm btn-danger btn-fav">{!! getIcon('fas', 'heart') !!}</a>
            <a href="#" class="btn btn-sm btn-info btn-cart">{!! getIcon('fas', 'cart-plus') !!}</a>
        </div>
    </div>
</div>
