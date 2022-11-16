{{-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        @include('layouts.common._clock')

        <ul class="nav flex-column">

        </ul>
        @yield('side-panels')
    </div>
</nav> --}}

<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <a class="navbar-brand" href="/">Anthaleja <small
                class="text-muted fs-6">v{{ config('ath.version') }}<small></a>
        <hr>
        @include('layouts.partials.common._ath-clock')
        {{-- <li><a href="#">Shortcuts</a></li> --}}
        @yield('side-links')
    </ul>
    @yield('side-panels')
</div>
