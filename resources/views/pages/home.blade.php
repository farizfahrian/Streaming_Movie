<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <title>Streaming Movie</title>
    @livewireStyles
</head>

<body>
    <div class="hero-image position-relative" style="background-image: url('assets/Spiderman.jpg');">
        <nav class="navbar" style="background-color: none; box-shadow: none;">
            @guest
            <div class="container-fluid mx-5">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('assets/Logo-white.svg') }}" alt="Logo" style="height: 38px;">
                </a>
                <div class="d-flex gap-3">
                    <a href=" {{ route('login') }} " class="btn btn-outline-light">Login</a>
                    <a href=" {{ url('register') }} " class="btn btn-primary">Sign Up</a>
                </div>
            </div>
            @endguest
            @auth
            <div class="container-fluid mx-5">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('assets/Logo-white.svg') }}" alt="Logo" style="height: 38px;">
                </a>
                <div class="d-flex gap-3">
                    <form action=" {{ url('logout') }} " method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
        </nav>
        <div class="hero-image-overlay">
        </div>
        <div class="d-flex align-items-center h-100 w-100">
            <div class="col-4 offset-4 offset-lg-2 text-white hero-section text-center text-lg-start">
                <h1>Spider-Man: Across the Spider-Verse</h1>
                <p class="d-none d-lg-block">Miles Morales catapults across the Multiverse, where he encounters a team of Spider-People charged with protecting its very existence. When the heroes clash on how to handle a new threat, Miles must redefine what it means to be a hero.</p>
                @guest
                <a href=" {{ route('login') }} " class="btn btn-primary mt-3">Watch now</a>
                @endguest
                @auth
                <a href="https://www.youtube.com/embed/shW9i6k8cB0" class="btn btn-primary mt-3">Watch now</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="col-8 m-auto">
        <div class="my-5">
            <h3 class="h3 text-body text-center fw-bold mb-4 text-center text-lg-start">Most Popular Movies</h3>
            <div class="row">
                @foreach ($movies as $movie)
                <div class="column">
                    <a href="{{ route('admin.show', $movie->id) }}">
                        <img class="poster" src="{{ $movie->image_link }}" alt="poster">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        @livewireScripts
</body>

</html>