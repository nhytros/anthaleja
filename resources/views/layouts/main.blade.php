<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials.common._head')

<body>
    <main id="wrapper" class="wrapper-content">
        @role('admin')
            @include('admin._partials.sidebar')
        @else
            @include('layouts.partials.common._sidebar')
        @endrole
        <div id="page-content-wrapper">
            @include('layouts.partials.common._nav-top')
            <div class="card shadow mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @unlessrole('admin')
                                {{-- Move in the right section because sidebar override this --}}
                                @include('layouts.partials.common._alerts')
                            @endunlessrole
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer></footer>
</body>

</html>
