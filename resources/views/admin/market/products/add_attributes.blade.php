@extends('layouts.main')
@section('content')
    <div class="col-12">
        @include('admin._partials.card_header', ['title' => $title])
        <div class="card-text">
            <p>{!! trans('admin.market.attributes.intro') !!}</p>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="h4">{{ trans('admin.market.attribute.add') }}</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.market.product.attributes.store', $product->slug) }}" method="post">@csrf
                            <div class="row mb-3">
                                @if ($product->main_image)
                                    <div class="col-3">
                                        <img src="{{ $product->main_image }}" class="img-fluid" alt="{{ $product->name }}" />
                                    </div>
                                @endif
                                <div class="col-{{ $product->main_image ? 9 : 12 }}">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">{!! getIcon('fas', 'box') !!}</span>
                                        <input type="text" class="form-control" value="{{ $product->name }}" disabled />
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">{!! getIcon('fas', 'barcode') !!}</span>
                                        <input type="text" class="form-control" value="{{ $product->code }}" disabled />
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">{!! athel() !!}</span>
                                        <input type="text" class="form-control" value="{{ $product->promo_price ?? $product->price }}"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="field_wrapper">
                                <label>{{ trans('admin.market.product.attributes_for', ['name' => $product->name]) }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="size[]" placeholder="{{ __('Size') }}" required />
                                    <input type="text" class="form-control" name="sku[]" placeholder="{{ __('SKU') }}" required />
                                    <input type="text" class="form-control" name="price[]" placeholder="{{ __('Price') }}" required />
                                    <input type="text" class="form-control" name="stock[]" placeholder="{{ __('Stock') }}" required />
                                    <a href="javascript:void(0);" class="input-group-text add_button" title="Add field">{!! getIcon('fas', 'plus bg-success text-light') !!}</a>
                                </div>
                            </div>


                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.market.product.edit', $product->slug) }}" class="btn btn-secondary">{!! getIcon('fas', 'arrow-left', __('Cancel')) !!}</a>
                            <button type="submit" class="btn btn-primary">{!! getIcon('fas', 'save', __('Save')) !!}</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 12; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="input-group">';
            fieldHTML += '<input type="text" class="form-control" name="size[]" placeholder="{{ __('Size') }}" />';
            fieldHTML += '<input type="text" class="form-control" name="sku[]" placeholder="{{ __('SKU') }}" />';
            fieldHTML += '<input type="text" class="form-control" name="price[]" placeholder="{{ __('Price') }}" />';
            fieldHTML += '<input type="text" class="form-control" name="stock[]" placeholder="{{ __('Stock') }}" />';
            fieldHTML +=
                '<a href="javascript:void(0);" class="input-group-text remove_button" title="Remove field">{!! getIcon('fas', 'minus bg-danger text-light') !!}</a>';
            fieldHTML += '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
@endsection
