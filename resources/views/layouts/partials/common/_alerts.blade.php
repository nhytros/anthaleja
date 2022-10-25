{{-- <div id="alerts" class="d-flex justify-content-center align-items-center w-100 pt-1"> --}}
<div id="alerts" class="w-100">
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">{!! getIcon('fas', 'check-circle', __('Success')) !!}</h4>
            <div>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @elseif (Session::has('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">{!! getIcon('fas', 'exclamation-triangle', __('Error')) !!}</h4>
            <div>
                <p>{{ session('danger') }}</p>
            </div>
        </div>
    @elseif (Session::has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">{!! getIcon('fas', 'exclamation-circle', __('Warning')) !!}</h4>
            <div>
                <p>{{ session('warning') }}</p>
            </div>
        </div>
    @elseif (Session::has('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">{!! getIcon('fas', 'info-circle', __('Info')) !!}</h4>
            <div>
                <p>{{ session('info') }}</p>
            </div>
        </div>
    @elseif (Session::has('primary'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('primary')) !!}
                </p>
            </div>
        </div>
    @elseif (Session::has('secondary'))
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('secondary')) !!}
                </p>
            </div>
        </div>
    @elseif (Session::has('light'))
        <div class="alert alert-light alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('light')) !!}
                </p>
            </div>
        </div>
    @elseif (Session::has('dark'))
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('dark')) !!}
                </p>
            </div>
        </div>
    @elseif (Session::has('pink'))
        <div class="alert alert-pink alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('pink')) !!}
                </p>
            </div>
        </div>
    @elseif (Session::has('purple'))
        <div class="alert alert-purple alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('purple')) !!}
                </p>
            </div>
        </div>
        @elsef (Session::has('teal'))
        <div class="alert alert-teal alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('teal')) !!}
                </p>
            </div>
        </div>
    @elseif (Session::has('indigo'))
        <div class="alert alert-indigo alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('indigo')) !!}
                </p>
            </div>
        </div>
    @elseif (Session::has('orange'))
        <div class="alert alert-orange alert-dismissible fade show" role="alert">
            <div>
                <p>
                    {!! getIcon('fas', 'info', session('orange')) !!}
                </p>
            </div>
        </div>
    @elseif ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <h4 class="alert-heading">{!! getIcon('fas', 'exclamation-triangle', __('Error')) !!}</h4>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
