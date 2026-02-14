<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.favorites') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('messages.favorites') }}</h2>

        <a href="/movies" class="btn btn-outline-primary btn-sm">
            ← {{ __('messages.back') }}
        </a>
    </div>

    <!-- Favorite Grid -->
    <div class="row">

        @if($favorites->count() > 0)

            @foreach($favorites as $favorite)
                <div class="col-md-3 mb-4">

                    <div class="card h-100 shadow-sm">

                        <img src="{{ $favorite->poster }}"
                             class="card-img-top"
                             style="height:350px; object-fit:cover;"
                             loading="lazy">

                        <div class="card-body d-flex flex-column">

                            <h6 class="card-title">
                                {{ $favorite->title }}
                            </h6>

                            <small class="text-muted mb-3">
                                {{ $favorite->year }}
                            </small>

                            <form method="POST" action="/favorites/{{ $favorite->id }}" class="mt-auto">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">
                                    🗑 Remove
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            @endforeach

        @else

            <div class="text-center py-5">
                <h5 class="text-muted">
                    {{ __('messages.no_favorites') ?? 'No favorite movies yet.' }}
                </h5>
            </div>

        @endif

    </div>

</div>

</body>
</html>
