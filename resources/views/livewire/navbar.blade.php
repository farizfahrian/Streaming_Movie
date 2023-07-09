<nav class="navbar">
    @guest
    <div class="container-lg">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('assets/Logo.svg') }}" alt="Logo" style="height: 38px;">
        </a>
        <div class="d-flex gap-3">
            <a href=" {{ route('login') }} " class="btn btn-outline-light border-secondary text-dark">Login</a>
            <a href=" {{ route('register') }} " class="btn btn-primary">Sign Up</a>
        </div>
    </div>
    @endguest
    @auth
    <div class="container-lg">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('assets/Logo.svg') }}" alt="Logo" style="height: 38px;"></a>
        <div class="d-flex gap-3">
            <form action=" {{ url('logout') }} " method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
    </div>
    @endauth
</nav>