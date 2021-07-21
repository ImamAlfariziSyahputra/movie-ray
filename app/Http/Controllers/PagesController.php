<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    private $perPage = 4;

    public function home()
    {
        $movies = Movie::paginate($this->perPage);
        $genres = Genre::all();

        return view('pages.home', [
            'movies' => $movies->withQueryString(),
            'genres' => $genres,
        ]);
    }

    public function searchMovies(Request $request)
    {
        if(!$request->get('keyword')) {
            return redirect()->route('pages.home');
        }

        $movies = Movie::search($request->keyword)->paginate($this->perPage);
        $genres = Genre::all();

        return view('pages.searchMovies', [
            'movies' => $movies,
            'genres' => $genres,
        ]);
    }

    public function detailMovie($movie)
    {
        $movie = Movie::where('slug', $movie)->first();
        $genres = Genre::all();

        return view('pages.detailMovie', [
            'movie' => $movie,
            'genres' => $genres,
        ]);
    }
}
