@push('scripts')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
@endpush
<nav class="nav">
    <div class="nav--container">
        <h1 class="nav--headline">
            <a href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
        </h1>
        <div class="collapse nav-collapse">
            <ul class="nav--list nav--list-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav--list-item"><a href="{{ route('login') }}">Login</a></li>
                    <li class="nav--list-item"><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav--list-item dropdown">
                        <a href="{{ route('account') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
<!--                         <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul> -->
                    </li>
                    <li class="nav--list-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
