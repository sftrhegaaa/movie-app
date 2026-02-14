<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>{{ __('messages.movie_list') }}</title>

</head>
<body>

<div id="movie-container">
    @include('movies.partials.list')
</div>

<div id="loading" style="display:none; text-align:center;">
    Loading...
</div>



</body>

<script>
let page = 1;
let loading = false;

window.addEventListener('scroll', function () {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {

        if (loading) return;

        loading = true;
        page++;

        document.getElementById('loading').style.display = 'block';

        fetch(`?page=${page}&q={{ $query }}`)
            .then(response => response.text())
            .then(data => {
                if (data.trim() !== '') {
                    document.getElementById('movie-container')
                        .insertAdjacentHTML('beforeend', data);
                }
                document.getElementById('loading').style.display = 'none';
                loading = false;
            });
    }
});
</script>

</html>
