<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    private $perPage = 5;

    public function __construct()
    {
        $this->middleware('permission:ratings.index', ['only' => 'index']);
        $this->middleware('permission:ratings.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ratings.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ratings.show', ['only' => 'show']);
        $this->middleware('permission:ratings.delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ratings = $request->get('keyword')
            ? Rating::search($request->keyword)->paginate($this->perPage)
            : Rating::paginate($this->perPage);

        return view('admin.rating.index', [
            'ratings' => $ratings->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rating.create');
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
                'number' => 'required|integer|between:1,5|unique:ratings,number',
            ],
            [],
            [],
        );
        
        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        
        try {
            Rating::create([
                'number' => $request->number,
            ]);

            Alert::success('Add Rating', 'Success');
            return redirect()->route('ratings.index');
        } catch (\Throwable $th) {
            Alert::error('Add Rating', $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        return view('admin.rating.edit', [
            'rating' => $rating,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'number' => 'required|integer|between:1,5|unique:ratings,number,'.$rating->id,
            ],
            [],
            [],
        );
        
        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        
        try {
            $rating->update([
                'number' => $request->number,
            ]);

            Alert::success('Edit Rating', 'Success');
            return redirect()->route('ratings.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Rating', $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        try {
            $rating->delete();

            Alert::success('Delete Rating', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Rating', $th->getMessage());
        }

        return redirect()->back();
    }
}
