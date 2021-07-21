<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CastController extends Controller
{
    protected $perPage = 5;

    public function __construct()
    {
        $this->middleware('permission:casts.index', ['only' => 'index']);
        $this->middleware('permission:casts.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:casts.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:casts.show', ['only' => 'show']);
        $this->middleware('permission:casts.delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $casts = $request->get('keyword')
            ? Cast::search($request->keyword)->paginate($this->perPage)
            : Cast::paginate($this->perPage);

        return view('admin.cast.index', [
            'casts' => $casts->withQueryString(),
        ]);
    }

    public function selectInput(Request $request)
    {
        $casts = [];
        $casts = $request->has('q')
            ? Cast::select('id', 'name')->search($request->q)->get()
            : Cast::select('id', 'name')->limit(5)->get();

        return response()->json($casts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cast.create');
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
                'name' => 'required|string|min:3|max:30|unique:casts,name',
                'image' => 'required|max:2048',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            Cast::create([
                'name' => $request->name,
                'image' => parse_url($request->image)['path'],
            ]);

            Alert::success('Add Cast', 'Success');

            return redirect()->route('casts.index');
        } catch (\Throwable $th) {
            Alert::error('Add Cast', 'Error : '.$th->getMessage());

            return redirect()->back()->withInput($request->all());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cast  $cast
     * @return \Illuminate\Http\Response
     */
    public function show(Cast $cast)
    {
        return view('admin.cast.show', [
            'cast' => $cast,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cast  $cast
     * @return \Illuminate\Http\Response
     */
    public function edit(Cast $cast)
    {
        return view('admin.cast.edit', [
            'cast' => $cast,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cast  $cast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cast $cast)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:30|unique:casts,name,'.$cast->id,
                'image' => 'required|max:2048',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            $cast->update([
                'name' => $request->name,
                'image' => parse_url($request->image)['path'],
            ]);

            Alert::success('Edit Cast', 'Success');

            return redirect()->route('casts.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Cast', 'Error : '.$th->getMessage());

            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cast  $cast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cast $cast)
    {
        try {
            $cast->delete();

            Alert::success('Delete Cast', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Cast', 'Error : '.$th->getMessage());
        }

        return redirect()->back();
    }
}
