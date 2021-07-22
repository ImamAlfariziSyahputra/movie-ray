<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class YearController extends Controller
{
    private $perPage = 5;

    public function __construct()
    {
        $this->middleware('permission:years.index', ['only' => 'index']);
        $this->middleware('permission:years.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:years.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:years.show', ['only' => 'show']);
        $this->middleware('permission:years.delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $years = $request->get('keyword')
            ? Year::search($request->keyword)->paginate($this->perPage)
            : Year::paginate($this->perPage);

        return view('admin.year.index', [
            'years' => $years->withQueryString(),
        ]);
    }

    public function getYears(Request $request)
    {
        $years = [];
        $years = $request->get('q')
            ? Year::select('id', 'name')->search($request->q)->get()
            : Year::select('id', 'name')->limit(5)->get();

        return response()->json($years);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.year.create');
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
                'name' => 'required|string|min:3|max:30|unique:years,name',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            Year::create([
                'name' => $request->name,
            ]);

            Alert::success('Add Year', 'Success');
            return redirect()->route('years.index');
        } catch (\Throwable $th) {
            Alert::error('Add Year', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        return view('admin.year.edit', [
            'year' => $year,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:30|unique:years,name,'.$year->id,
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            $year->update([
                'name' => $request->name,
            ]);

            Alert::success('Edit Year', 'Success');
            return redirect()->route('years.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Year', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        try {
            $year->delete();

            Alert::success('Delete Year', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Year', 'Error : '.$th->getMessage());
        }

        return redirect()->back();
    }
}
