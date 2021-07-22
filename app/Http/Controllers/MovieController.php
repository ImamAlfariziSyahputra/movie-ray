<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MovieController extends Controller
{
    protected $perPage = 5;
    // 'manage_movies' => [
    //     'movies.index',
    //     'movies.create',
    //     'movies.edit',
    //     'movies.show',
    //     'movies.delete',
    // ],

    public function __construct()
    {
        $this->middleware('permission:movies.index', ['only' => 'index']);
        $this->middleware('permission:movies.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:movies.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:movies.show', ['only' => 'show']);
        $this->middleware('permission:movies.delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movies = $request->get('keyword')
            ? Movie::search($request->keyword)->paginate($this->perPage)
            : Movie::paginate($this->perPage);

        return view('admin.movies.index', [
            'movies' => $movies->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'director' => 'required',
                'title' => 'required|string',
                'slug' => 'required|string|unique:movies,slug',
                'genres' => 'required',
                'banner' => 'required',
                'poster' => 'required',
                // 'desc' => 'required|string',
                'synopsis' => 'required|string',
                'casts' => 'required',
                'trailer' => 'required',
                'year' => 'required',
                'duration' => 'required',
                'imdb_rating' => 'required',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            // old('director')
            if($request->has('director')) {
                $request['director'] = Director::select('id', 'name')->find($request->director);
            }
            // old('year')
            if($request->has('year')) {
                $request['year'] = Year::select('id', 'name')->find($request->year);
            }
            // old('casts')
            if($request->has('casts')) {
                $request['casts'] = Cast::select('id', 'name')->whereIn('id', $request->casts)->get();
            }

            // old('genres')
            if($request->has('genres')) {
                $request['genres'] = Genre::select('id', 'name')->whereIn('id', $request->genres)->get();
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            $movie = Movie::create([
                'director_id' => $request->director,
                'title' => $request->title,
                'slug' => $request->slug,
                'banner' => parse_url($request->banner)['path'],
                'poster' => parse_url($request->poster)['path'],
                'desc' => $request->desc,
                'synopsis' => $request->synopsis,
                'trailer' => $request->trailer,
                'year' => $request->year,
                'duration' => $request->duration,
                'imdb_rating' => $request->imdb_rating,
            ]);

            // Todo: pivot cast_movie
            $movie->cast()->attach($request->casts);

            // Todo: pivot genre_movie
            $movie->genre()->attach($request->genres);

            Alert::success('Add Movie', 'Success');
            return redirect()->route('movies.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Add Movie', 'Error : '.$th->getMessage());

            // old('director')
            if($request->has('director')) {
                $request['director'] = Director::select('id', 'name')->find($request->director);
            }
            // old('year')
            if($request->has('year')) {
                $request['year'] = Year::select('id', 'name')->find($request->year);
            }
            // old('casts')
            if($request->has('casts')) {
                $request['casts'] = Cast::select('id', 'name')->whereIn('id', $request->casts)->get();
            }

            // old('genres')
            if($request->has('genres')) {
                $request['genres'] = Genre::select('id', 'name')->whereIn('id', $request->genres)->get();
            }

            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('admin.movies.show', [
            'movie' => $movie,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', [
            'movie' => $movie,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'director' => 'required',
                'title' => 'required|string',
                'slug' => 'required|string|unique:movies,slug,'.$movie->id,
                'genres' => 'required',
                'banner' => 'required',
                'poster' => 'required',
                // 'desc' => 'required|string',
                'synopsis' => 'required|string',
                'casts' => 'required',
                'trailer' => 'required',
                'year' => 'required',
                'duration' => 'required',
                'imdb_rating' => 'required',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            // old('director')
            if($request->has('director')) {
                $request['director'] = Director::select('id', 'name')->find($request->director);
            }
            // old('year')
            if($request->has('year')) {
                $request['year'] = Year::select('id', 'name')->find($request->year);
            }
            // old('casts')
            if($request->has('casts')) {
                $request['casts'] = Cast::select('id', 'name')->whereIn('id', $request->casts)->get();
            }

            // old('genres')
            if($request->has('genres')) {
                $request['genres'] = Genre::select('id', 'name')->whereIn('id', $request->genres)->get();
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            $movie->update([
                'director_id' => $request->director,
                'title' => $request->title,
                'slug' => $request->slug,
                'banner' => parse_url($request->banner)['path'],
                'poster' => parse_url($request->poster)['path'],
                'desc' => $request->desc,
                'synopsis' => $request->synopsis,
                'trailer' => $request->trailer,
                'year_id' => $request->year,
                'duration' => $request->duration,
                'imdb_rating' => $request->imdb_rating,
            ]);

            // Todo: pivot cast_movie
            $movie->cast()->sync($request->casts);

            // Todo: pivot genre_movie
            $movie->genre()->sync($request->genres);

            Alert::success('Edit Movie', 'Success');
            return redirect()->route('movies.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Edit Movie', 'Error : '.$th->getMessage());

            // old('director')
            if($request->has('director')) {
                $request['director'] = Director::select('id', 'name')->find($request->director);
            }
            // old('year')
            if($request->has('year')) {
                $request['year'] = Year::select('id', 'name')->find($request->year);
            }
            // old('casts')
            if($request->has('casts')) {
                $request['casts'] = Cast::select('id', 'name')->whereIn('id', $request->casts)->get();
            }

            // old('genres')
            if($request->has('genres')) {
                $request['genres'] = Genre::select('id', 'name')->whereIn('id', $request->genres)->get();
            }

            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        DB::beginTransaction();

        try {
            // Todo: pivot cast_movie
            $movie->cast()->detach();
            // Todo: pivot genre_movie
            $movie->genre()->detach();

            $movie->delete();

            Alert::success('Delete Movie', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Delete Movie', 'Error : '.$th->getMessage());
        } finally {
            DB::commit();

            return redirect()->back();
        }
    }
}
