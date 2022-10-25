{{-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
        </ul>
    </div>
</nav> --}}

<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="navbar-brand"><a href="{{ route('admin.dashboard') }}">{{ __('Administration') }}</a></li>
        <hr>
        {{-- @include('layouts.common._clock') --}}
        <li class="nav-item">
            <a class="nodec nav-link{{ getActivePage('admin/dashboard') }}" href="{{ route('admin.dashboard') }}">
                {!! getIcon('fas', 'home', 'Dashboard') !!}</a>
        </li>
        <li class="nav-item">
            <a class="nodec nav-link{{ getActivePage('admin/users/*') }}" href="{{ route('admin.users') }}">
                {!! getIcon('fas', 'users', 'Users') !!}</a>
        </li>
        <li class="nav-item">
            <a class="nodec nav-link{{ getActivePage('admin/characters/*') }}" href="{{ route('admin.characters') }}">
                {!! getIcon('fas', 'id-badge', 'Characters') !!}</a>
        </li>
        <li class="nav-item">
            <a class="nodec nav-link{{ getActivePage('admin/roles*') }}" href="{{ route('admin.roles') }}">
                {!! getIcon('fas', 'tag', 'Roles') !!}</a>
        <li class="nav-item">
            <a class="nodec nav-link{{ getActivePage('admin/permissions*') }}"
                href="{{ route('admin.permissions') }}">
                {!! getIcon('fas', 'tags', 'Permissions') !!}</a>
        </li>
        <div class="accordion" id="sidevarMarket">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#_sidebarMarket" aria-expanded="false"
                        aria-controls="_sidebarMarket">{{ __('Market') }}</button>
                </h2>
                <div id="_sidebarMarket"
                    class="accordion-collapse accordion-flush collapse{{ Request::is('admin/market/*') ? 'show' : '' }}"
                    aria-labelledby="headingOne" data-bs-parent="#sidevarMarket">
                    <div class="accordion-body">
                        <li class="nav-item">
                            <a class="nodec nav-link{{ getActivePage('admin/market/section*') }}"
                                href="{{ route('admin.market.sections') }}">
                                {!! getIcon('fas', 'tags', __('Sections')) !!}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nodec nav-link{{ getActivePage('admin/market/categories*') }}"
                                href="{{ route('admin.market.categories') }}">
                                {!! getIcon('fas', 'list', __('Categories')) !!}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nodec nav-link{{ getActivePage('admin/market/brands*') }}"
                                href="{{ route('admin.market.brands') }}">
                                {!! getIcon('fab', 'qq', __('Brands')) !!}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nodec nav-link{{ getActivePage('admin/market/products*') }}"
                                href="{{ route('admin.market.products') }}">
                                {!! getIcon('fas', 'boxes', __('Products')) !!}</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </ul>
</div>
