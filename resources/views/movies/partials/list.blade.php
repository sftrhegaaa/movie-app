<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.movie_list') }}</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('messages.movie_list') }}</h2>

        <div>
            <a href="/favorites" class="btn btn-warning btn-sm">⭐ Favorites</a>
            <a href="/lang/en" class="btn btn-outline-dark btn-sm">EN</a>
            <a href="/lang/id" class="btn btn-outline-dark btn-sm">ID</a>
        </div>
    </div>

    <!-- Search -->
    <div class="d-flex justify-content-end mb-4">
        <form method="GET" action="/movies">
            <div class="input-group">
                <input type="text" style="max-width: 350px;"
                       name="q"
                       value="{{ $query }}"
                       class="form-control"
                       placeholder="{{ __('messages.search') }}">
                <button class="btn btn-primary">
                    {{ __('messages.search') }}
                </button>
            </div>
        </form>
    </div>
   

    <!-- Movie Grid -->
    <div class="row">

        @if(isset($movies['Search']))
            @foreach($movies['Search'] as $movie)
                <div class="col-md-3 mb-4">

                    <div class="card h-100 shadow-sm">

                        <a href="/movies/{{ $movie['imdbID'] }}">
                            <img src="{{ $movie['Poster'] }}"
                                 class="card-img-top"
                                 loading="lazy"
                                 style="height:350px; object-fit:cover;">
                        </a>

                        <div class="card-body d-flex flex-column">

                            <h6 class="card-title">
                                {{ $movie['Title'] }}
                            </h6>

                            <small class="text-muted mb-2">
                                {{ $movie['Year'] }}
                            </small>

                            <form method="POST" action="/favorites" class="mt-auto">
                                @csrf
                                <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                                <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                                <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                                <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                                <button class="btn btn-outline-warning btn-sm w-100">
                                    ⭐ {{ __('messages.add_favorite') }}
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div class="text-center py-5">
                <h5 class="text-muted">
                    {{ __('messages.no_movies') }}
                </h5>
            </div>
        @endif

    </div>

</div>

</body>
</html>
