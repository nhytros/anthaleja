<ul class="nav nav-tabs mb-2">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="latest-tab" data-bs-toggle="tab" data-bs-target="#latest" type="button"
            role="tab" aria-controls="latest" aria-selected="true">New Arrivals</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="best-tab" data-bs-toggle="tab" data-bs-target="#best" type="button"
            role="tab" aria-controls="best" aria-selected="false">Best Sellers</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="discounted-tab" data-bs-toggle="tab" data-bs-target="#discounted" type="button"
            role="tab" aria-controls="discounted" aria-selected="false">Discounted</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured" type="button"
            role="tab" aria-controls="featured" aria-selected="false">Featured</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="latest" role="tabpanel" aria-labelledby="latest-tab">
        <div class="row">
            @foreach ($latest as $l)
                @include('market.frontend.partials._market_product_card', ['product' => $l])
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="best" role="tabpanel" aria-labelledby="best-tab">
        <div class="row">
            @foreach ($best as $b)
                @include('market.frontend.partials._market_product_card', ['product' => $b])
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="discounted" role="tabpanel" aria-labelledby="discounted-tab">
        <div class="row">
            @foreach ($discounted as $d)
                @include('market.frontend.partials._market_product_card', ['product' => $d])
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
        <div class="row">
            @foreach ($featured as $f)
                @include('market.frontend.partials._market_product_card', ['product' => $f])
            @endforeach
        </div>
    </div>
</div>
