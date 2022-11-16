@auth
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{-- <x-gravatar :email="{{ md5(strtolower(auth()->user()->email)) }}", :size="24" /> --}}
            {!! gravatar(auth()->user()->email, 24) !!}
            {{ auth()->user()->username }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            @role('admin')
                <li><a class="dropdown-item" href="#">Admin Dashboard</a></li>
            @endrole
            @role('vendor')
                <li><a class="dropdown-item" href="#">Vendor dashboard</a></li>
            @endrole
            <li><a class="dropdown-item" href="#">{{ trans('auth.user.profile.my') }}</a></li>
            {{-- href="{{ route('profile', Auth::user()->username) }}">{{ trans('auth.user.profile.my') }}</a></li> --}}
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                {{-- <li><a class="dropdown-item" href="{{ route('frontier.password') }}">{{ trans('frontier.password.change') }}</a> --}}
            </li>
            <li><a class="dropdown-item" href="{{ route('frontier.logout') }}">{{ trans('frontier.leave_city') }}</a></li>
        </ul>
    </li>
@endauth
