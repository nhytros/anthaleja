<nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow">
    <div class="container-fluid">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
            <div class="hamburger-toggle">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </button>
        <div class="collapse navbar-collapse" id="navbar-content">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside">Categories</a>
                    <ul class="dropdown-menu shadow">
                        <li class="dropend">
                            @foreach (\App\Models\Market\Section::getSections() as $s)
                                @if ($s->categories->count() > 0)
                                    <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside">{{ $s->name }}</a>
                                    <ul class="dropdown-menu shadow">
                                        @foreach ($s->categories as $sc)
                                            @if ($sc->subcategories->count() > 0)
                                                <li class="dropend">
                                                    <a href="{{ route('market.category', $sc->slug) }}"
                                                        class="dropdown-item dropdown-toggle"
                                                        data-bs-toggle="dropdown">{{ $sc->name }}</a>
                                                    <ul class="dropdown-menu dropdown-submenu shadow">
                                                        @foreach ($sc->subcategories as $sub)
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('market.category', $sub->slug) }}">{{ $sub->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a class="dropdown-item" href=""> {{ $sc->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li><a class="dropdown-item" href=""> Third level 5</a></li>
                                    </ul>
                                @else
                        <li><a class="dropdown-item" href="">{{ $s->name }}</a></li>
                        @endif
                        @endforeach
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown dropdown-mega position-static">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside">Megamenu</a>
                <div class="dropdown-menu shadow">
                    <div class="mega-content px-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-3 py-4">
                                    <h5>Pages</h5>
                                    <div class="list-group">
                                        <a class="list-group-item" href="#">Accomodations</a>
                                        <a class="list-group-item" href="#">Terms & Conditions</a>
                                        <a class="list-group-item" href="#">Privacy</a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-3 py-4">
                                    <h5>Card</h5>
                                    <div class="card">
                                        <img src="img/banner-image.jpg" class="img-fluid" alt="image">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title
                                                and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-3 py-4">
                                    <h5>About CodeHim</h5>
                                    <p><b>CodeHim</b> is one of the BEST developer websites that provide web
                                        designers and developers with a simple way to preview and download a variety
                                        of free code & scripts.</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 py-4">
                                    <h5>Damn, so many</h5>
                                    <div class="list-group">
                                        <a class="list-group-item" href="#">Accomodations</a>
                                        <a class="list-group-item" href="#">Terms & Conditions</a>
                                        <a class="list-group-item" href="#">Privacy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-mega">
                <span class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">{!! getIcon('fas', 'search') !!}</span>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <form class="m-2" action="" method="post">@csrf
                            <div class="input-group">
                                <input class="form-control border-0 mr-2" type="search" name="q"
                                    placeholder="Search" aria-label="Search">
                                <select class="form-select">
                                    <option selected>Choose...</option>
                                    @foreach (\App\Models\Market\Section::getSections() as $section)
                                        <option value="{{ $section->slug }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-secondary" type="button">Button</button>
                            </div>
                        </form>
                    </li>
                </ul>
            </li>
            @if (isset($items) && $items->count() > 0)
                <?php $total = 0; ?>
                @foreach ($items as $ci)
                    <?php $total += ($ci->product->getPricePromo($ci->product->id)['price_promo'] ?? $ci->product->price) * $ci->quantity; ?>
                @endforeach

                <li id="cart-dropdown" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {!! getIcon('fas', 'shopping-cart') !!}&nbsp;({{ $items->count() }}&nbsp;|&nbsp;{{ trans('market.cart.subtotal') }}:
                        {{ toAthel($total) }})
                    </a>
                    <div id="cart-dropdown" class="dropdown-menu dropdown-cart actions">
                        <p class="text-center">Subtotal</p>
                        <p class="text-center">{{ toAthel($total) }}</p>
                        <span class="ms-auto me-auto"><a class="btn btn-sm btn-light"
                                href="{{ route('market.cart') }}">{{ trans('market.cart.goto') }}</a></span>
                        <span>
                            <hr class="dropdown-divider">
                        </span>
                        @foreach ($items as $ci)
                            <div class="card mx-1 mb-1">
                                <img src="{{ $ci->product->main_image }}" class="card-img-top">
                                <div class="card-body">
                                    <h6 class="card-title text-center fw-bold">
                                        {{ toAthel($ci->product->getPricePromo($ci->product->id)['price_promo'] ?? $ci->product->price) }}
                                    </h6>
                                    <form action="{{ route('market.cart.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="cid" value="{{ $ci->id }}">
                                        <input type="hidden" name="pid" value="{{ $ci->product->id }}">
                                        <span class="input-group pt-3">
                                            <input type="text" class="form-control form-control-sm"
                                                name="quantity" value="{{ $ci->quantity }}" readonly />
                                            <button name="del" type="submit"
                                                class="actions btn btn-danger btn-sm"
                                                value="1">{!! getIcon('fas', 'trash') !!}</button>
                                            @if ($ci->quantity > 1)
                                                <button name="sub" type="submit"
                                                    class="actions btn btn-secondary btn-sm"
                                                    value="1">{!! getIcon('fas', 'minus') !!}</button>
                                            @endif
                                            <button name="add" type="submit"
                                                class="actions btn btn-secondary btn-sm"
                                                value="1">{!! getIcon('fas', 'plus') !!}</button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- </li> <a href="{{ route('market.cart') }}">
                        <span class="fa-layers fa-fw text-light bg-secondary fa-2x">
                            {!! getIcon('fas', 'shopping-cart') !!}
                            <span class="fa-layers-text text-dark fw-bold"
                                data-fa-transform="shrink-9 up-2">{{ \App\Models\Market\Cart::cartItems()->count() }}</span>
                        </span>
                    </a> --}}
            @endif
            </ul>
        </div>
    </div>
</nav>

<script type="text/javascript">
    $(document).ready(function() {
        $('#cart-dropdown .dropdown-menu .dropdown-cart .actions').on({
            "click": function(e) {
                e.stopPropagation();
            }
        });
        $(".dropdown,.dropdown-mega,.dropend").hover(function() {
            var dropdownMenu =
                $(this).children(".dropdown-menu");
            if (dropdownMenu.is(":visible")) {
                dropdownMenu.parent().toggleClass("open");
            }
        });
    });
</script>
