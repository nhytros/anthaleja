@extends('layouts.main')
@section('content')
    <main class="col-12">
        @include('admin._partials.card_header', ['title' => trans('vendor.dashboard')])
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            {{-- TODO: Add logo --}}
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin"
                                class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4>{{ $vendor->vdetails->shop_name }}</h4>
                                <p class="text-secondary mb-1">---</p>
                                <p class="text-muted font-size-sm">{{ $vendor->vdetails->shop_address }}</p>
                                {{-- <button class="btn btn-primary">Follow</button> --}}
                                {{-- <button class="btn btn-outline-primary">Message</button> --}}
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">{!! getIcon('fas', 'globe fa-lg', __('Website')) !!}</h6>
                                <span class="text-secondary">{{ $vendor->vdetails->shop_website }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">{!! getIcon('fab', 'github fa-lg', 'Github') !!}</h6>
                                <span class="text-secondary">github</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 text-info">{!! getIcon('fab', 'twitter fa-lg', 'Twitter') !!}</h6>
                                <span class="text-secondary">@twitter</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 text-danger">{!! getIcon('fab', 'instagram fa-lg', 'Instagram') !!}</h6>
                                <span class="text-secondary">instagram</span>
                            </li>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 text-primary">{!! getIcon('fab', 'facebook fa-lg', 'Facebook') !!}</h6>
                                <span class="text-secondary">facebook</span>
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow mb-3">
                    <h4 class="card-header">Shop Details</h4>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control"
                                    value="{{ $vendor->character->last_name }} {{ $vendor->character->first_name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ $vendor->vdetails->shop_email }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Website</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ $vendor->vdetails->shop_website }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ $vendor->vdetails->shop_phone }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ $vendor->vdetails->shop_address }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <h6 class="mb-0">License Code</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ $vendor->vdetails->license_code }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input type="button" class="btn btn-primary px-4" value="Save Changes">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <h4 class="card-header">Bank Details</h4>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Bank Account</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control"
                                            value="{{ $vendor->vbank->bank_account }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Bank Balance</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control"
                                            value="{{ toAthel($vendor->vbank->bank_amount) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
