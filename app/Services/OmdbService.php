<?php

namespace App\Services;

class OmdbService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OMDB_API_KEY');
    }

    public function search($query, $page = 1)
    {
        $url = "http://www.omdbapi.com/?apikey={$this->apiKey}&s={$query}&page={$page}";

        return json_decode(file_get_contents($url), true);
    }

    public function detail($imdbID)
    {
        $url = "http://www.omdbapi.com/?apikey={$this->apiKey}&i={$imdbID}";

        return json_decode(file_get_contents($url), true);
    }
}
