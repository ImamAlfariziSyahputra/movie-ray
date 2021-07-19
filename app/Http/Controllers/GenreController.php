<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GenreController extends Controller
{
    private $perPage = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genres = $request->get('keyword')
            ? Genre::search($request->keyword)->paginate($this->perPage)
            : Genre::paginate($this->perPage);

        return view('admin.genre.index', [
            'genres' => $genres->withQueryString(),
        ]);
    }

    public function getGenres(Request $request)
    {
        $genres = [];
        $genres = $request->has('q')
            ? Genre::select('id', 'name')->search($request->q)->get()
            : Genre::select('id', 'name')->limit(5)->get();

        return response()->json($genres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.create');
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
                'name' => 'required|string|min:3|max:20|unique:genres,name',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            Genre::create([
                'name' => $request->name,
            ]);

            Alert::success('Add Genre', 'Success');
            return redirect()->route('genres.index');
        } catch (\Throwable $th) {
            Alert::error('Add Genre', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', [
            'genre' => $genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:20|unique:genres,name,'.$genre->id,
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            $genre->update([
                'name' => $request->name,
            ]);

            Alert::success('Edit Genre', 'Success');
            return redirect()->route('genres.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Genre', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();

            Alert::success('Delete Genre', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Genre', 'Error : '.$th->getMessage());
        }

        return redirect()->back();
    }
}
