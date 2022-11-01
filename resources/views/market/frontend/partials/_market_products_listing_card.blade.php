                                <div class="item col-xs-4 col-lg-4 d-flex {{ $loop->first ? 'mt-3' : 'mt-2' }}">
                                    <div class="thumbnail img-fluid card shadow flex-fill">
                                        <div class="img-event">
                                            <img class="group list-group-image img-fluid" src="{{ $product->main_image }}"
                                                alt="{{ $product->name }}" />
                                        </div>
                                        <div class="caption card-body">
                                            <h4 class="group card-title inner list-group-item-heading">{{ $product->name }}
                                            </h4>
                                            <p class="group inner list-group-item-text">
                                                {!! Str::limit($product->description, 288, $end = '...') !!}</p>
                                            <p class="small text-muted">
                                                {{ $product->code }}&nbsp;/&nbsp;{{ ucfirst($product->color) }}
                                            </p>
                                            <p class="h6">Brand: {{ $product->brand->name }}</p>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex flex-row justify-content-center">
                                                        @if ($product->getPricePromo($product->id))
                                                            <div class="px-2 text-decoration-line-through">
                                                                {{ toAthel($product->price) }}</div>
                                                            <div class="px-2 text-danger fs-4">
                                                                {{ toAthel($product->getPricePromo($product->id)['price_promo']) }}
                                                            </div>
                                                        @else
                                                            <div class="px-2 fs-4">{{ toAthel($product->price) }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to
                                                cart</a>
                                        </div>
                                    </div>
                                </div>
