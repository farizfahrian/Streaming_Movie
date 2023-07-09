<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href=" {{ url('css/style.css') }} ">
    <title>Movie Name</title>
    @livewireStyles

</head>

<body>
    
    @livewire('navbar')
    

    <div class="container col-12 col-lg-12 my-5 row justify-content-sm-center m-auto px-2">
        <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 box mx-auto box text-center justify-content-center">
            <div>
                <img class="poster-header" src="{{ $movie['image_link'] }}" alt="poster">
            </div>
            <div>
                <a href="{{ $movie['video_link'] }}" type="button" class="mt-3 mb-4 btn btn-primary focus-ring btn-md" style="width: 200px;">Watch now</a>
            </div>
        </div>
        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-6 box">
            <h1 class="h3 fw-bold mb-2">{{ $movie['name'] }}</h1>
            <div class="my-3">
                <span class="badge">Action</span>
            </div>
            <div class="font-size-18">
                <div class="d-flex gap-10" style="gap:10px; height:fit-content; ">
                    <span><b class="me-1">{{$movie['duration']}}</b> <b>Minutes</b></span>
                    <span>•</span>
                    <div class="rating">
                        <span class="d-inline"><b>{{ $movie['rating'] }}</b></span> <img src="{{url('assets/Star icon.svg')}}" alt="rating">
                    </div>
                </div>
                <p class="mt-2">Release Date: <span>{{ $movie['release_date'] }}</span></p>
            </div>
            <p class="text-body-secondary font-size-18">{{ $movie['description'] }}</p>
        </div>

        @php
        $fullUrl = url()->full();
        $lastSlashPosition = strrpos($fullUrl, '/');
        $lastSegment = substr($fullUrl, $lastSlashPosition + 1);
        @endphp

        <div class="my-5">
            <h3 class="h4 text-body">Recomendation For You</h3>
            <div class="row">
                @foreach ($movies as $movie)
                @if ($movie->id == $lastSegment)
                    @continue
                @else
                <div class="column">
                    <a href="{{ route('admin.show', $movie->id) }}">
                        <img class="poster" src="{{ $movie->image_link }}" alt="poster">
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    @livewireScripts
</body>

</html>