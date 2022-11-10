@extends('layouts.main')
@section('content')
    <main class="col-12">
        @include('market.frontend.partials._market_nav_top')
        <div class="container-fluid mt-3">
            <div class="card shadow">
                <div class="h4 card-header">{{ trans('market.cart') }}</div>
                <div class="card-body">
                    <div class="col-md-9 col-sm-8 content">
                        <div class="row cart">
                            <div class="col-md-12">
                                <div class="card card-info card-shadow mb-2">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless align-middle table-light table-striped">
                                                @if ($items->count() > 0)
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Description</th>
                                                            <th>Qty</th>
                                                            <th class="text-end">Price</th>
                                                            <th class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                @endif
                                                <tbody>
                                                    @php $total=0; @endphp
                                                    @forelse ($items as $ci)
                                                        <tr class="align-middle">
                                                            <td><img src="{{ $ci->product->main_image }}" class="img-cart">
                                                            </td>
                                                            <td><strong>{{ $ci->product->name }}</strong>
                                                                <p>Size : {{ $ci->size }}</p>
                                                                <a href="#">Save for later</a> | <a
                                                                    href="#">View
                                                                    similar products</a>

                                                            </td>
                                                            <form action="{{ route('market.cart.update') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="cid"
                                                                    value="{{ $ci->id }}">
                                                                <input type="hidden" name="pid"
                                                                    value="{{ $ci->product->id }}">
                                                                <td class="input-group pt-3">
                                                                    <input type="text" class="form-control"
                                                                        name="quantity" value="{{ $ci->quantity }}"
                                                                        readonly />
                                                                    <button name="del" type="submit"
                                                                        class="btn btn-danger"
                                                                        value="1">{!! getIcon('fas', 'trash') !!}</button>
                                                                    @if ($ci->quantity > 1)
                                                                        <button name="sub" type="submit"
                                                                            class="btn btn-secondary"
                                                                            value="1">{!! getIcon('fas', 'minus') !!}</button>
                                                                    @endif
                                                                    <button name="add" type="submit"
                                                                        class="btn btn-secondary"
                                                                        value="1">{!! getIcon('fas', 'plus') !!}</button>
                                                                </td>
                                                            </form>
                                                            <td class="text-end">
                                                                @if ($ci->product->discount)
                                                                    <span
                                                                        class="text-decoration-line-through text-danger">{{ toAthel($ci->product->price) }}</span>&nbsp;&nbsp;
                                                                @endif
                                                                {{ toAthel($ci->product->getPricePromo($ci->product->id)['price_promo'] ?? $ci->product->price) }}
                                                            </td>
                                                            <td class="text-end">
                                                                {{ toAthel(($ci->product->getPricePromo($ci->product->id)['price_promo'] ?? $ci->product->price) * $ci->quantity) }}
                                                            </td>
                                                        </tr>
                                                        @php $total+=(($ci->product->getPricePromo($ci->product->id)['price_promo']??$ci->product->price) * $ci->quantity); @endphp

                                                    @empty
                                                        <tr colspan=6>
                                                            <h4 class="text-center">{{ trans('market.cart.is_empty') }}
                                                            </h4>
                                                        </tr>
                                                    @endforelse
                                                    @if ($items->count() > 0)
                                                        <tr>
                                                            <td colspan="6">&nbsp;</td>
                                                        </tr>
                                                        <tr class="fs-5 text-end">
                                                            <td colspan="4" class="fw-bolder">Total Product</td>
                                                            <td class="fw-bold">{{ toAthel($total) }}</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('market.home') }}" class="btn btn-success">{!! getIcon('fas', 'arrow-left', trans('market.cart.continue')) !!}</a>
                                <a href="#" class="btn btn-primary pull-right">Next<span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
