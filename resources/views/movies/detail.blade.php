<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div style="text-align:right;">
        <a href="/lang/en">EN</a> |
        <a href="/lang/id">ID</a>
    </div>
    <h1>{{ $movie['Title'] }}</h1>

    <img src="{{ $movie['Poster'] }}" width="200">

    <p><strong>Year:</strong> {{ $movie['Year'] }}</p>
    <p><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
    <p><strong>Director:</strong> {{ $movie['Director'] }}</p>
    <p><strong>Plot:</strong> {{ $movie['Plot'] }}</p>


            <form method="POST" action="/favorites">
                @csrf
                <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                <button type="submit">{{ __('messages.add_favorite') }}</button>
            </form>

    <a href="/movies">{{ __('messages.back') }}</a>

</body>
    

</html>