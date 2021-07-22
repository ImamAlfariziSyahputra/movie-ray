<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Year;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    private $perPage = 4;

    public function home()
    {
        $movies = Movie::paginate($this->perPage);
        $genres = Genre::all();
        $years = Year::all();

        return view('pages.home', [
            'movies' => $movies->withQueryString(),
            'genres' => $genres,
            'years' => $years,
        ]);
    }

    public function searchMovies(Request $request)
    {
        if (!$request->get('keyword')) {
            return redirect()->route('pages.home');
        }

        $movies = Movie::search($request->keyword)->paginate($this->perPage);
        $genres = Genre::all();
        $years = Year::all();

        return view('pages.searchMovies', [
            'movies' => $movies,
            'genres' => $genres,
            'years' => $years,
        ]);
    }

    public function detailMovie($movie)
    {
        $movie = Movie::where('slug', $movie)->first();
        $genres = Genre::all();
        $years = Year::all();

        return view('pages.detailMovie', [
            'movie' => $movie,
            'genres' => $genres,
            'years' => $years,
        ]);
    }

    public function genreMovies($genreName)
    {
        
        // $movies = Movie::with('genre')->paginate($this->perPage);

        $movies = Movie::whereHas('genre', function ($query) use ($genreName) {
            $query->where('name', $genreName);
        })->paginate($this->perPage);
        $genres = Genre::all();
        $years = Year::all();

        // dd($genres->movie);

        return view('pages.genreMovies', [
            'movies' => $movies->withQueryString(),
            'genres' => $genres,
            'years' => $years,
            'choosenGenre' => $genreName,
        ]);
    }

    public function yearMovies($yearName)
    {
        // $movies = Movie::where('year_id', $yearName)->paginate($this->perPage);
        $movies = Movie::whereHas('year', function ($query) use ($yearName) {
            $query->where('name', $yearName);
        })->paginate($this->perPage);
        $genres = Genre::all();
        $years = Year::all();

        // dd($movies);

        return view('pages.yearMovies', [
            'movies' => $movies->withQueryString(),
            'genres' => $genres,
            'years' => $years,
            'choosenYear' => $yearName,
        ]);
    }
}
