<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OmdbService;

class MovieController extends Controller
{
     protected $omdb;

    public function __construct(OmdbService $omdb)
    {
        $this->omdb = $omdb;
    }

  
    public function index(Request $request)
    {
        $query = $request->q ?? 'batman';
        $page  = $request->page ?? 1;

        $movies = $this->omdb->search($query, $page);

        // Jika request AJAX (infinite scroll)
        if ($request->ajax()) {
            return view('movies.partials.list', compact('movies'))->render();
        }

        return view('movies.index', compact('movies', 'query'));
    }

    public function detail($id)
    {
        $movie = $this->omdb->detail($id);

        return view('movies.detail', compact('movie'));
    }

}
