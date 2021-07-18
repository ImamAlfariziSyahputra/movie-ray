<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DirectorController extends Controller
{
    private $perPage = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $directors = $request->get('keyword')
            ? Director::search($request->keyword)->paginate($this->perPage)
            : Director::paginate($this->perPage);

        return view('admin.director.index', [
            'directors' => $directors->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.director.create');
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
                'name' => 'required|string|min:3|max:30|unique:directors,name',
                'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            $hashImage = '/storage/images/'.$request->name.'-'.time().'.'.$request->image->extension();

            Director::create([
                'name' => $request->name,
                'image' => $hashImage,
            ]);

            $request->image->move(public_path('storage/images'), $hashImage);

            Alert::success('Add Director', 'Success');
            return redirect()->route('directors.index');
        } catch (\Throwable $th) {
            Alert::error('Add Director', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function show(Director $director)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit(Director $director)
    {
        return view('admin.director.edit', [
            'director' => $director,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Director $director)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:30|unique:directors,name,'.$director->id,
                'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        try {
            // !old image
            $image = $director->image;

            // !new image
            if($request->hasFile('image')) {
                $image = '/storage/images/'.$request->name.'-'.time().'.'.$request->image->extension();
            }

            $director->update([
                'name' => $request->name,
                'image' => $image,
            ]);

            $request->image->move(public_path('storage/images'), $image);

            Alert::success('Edit Director', 'Success');
            return redirect()->route('directors.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Director', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy(Director $director)
    {
        try {
            $director->delete();

            Alert::success('Delete Director', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Director', 'Error : '.$th->getMessage());
        }

        return redirect()->back();
    }
}
