<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private $perPage = 6;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $request->get('keyword')
            ? User::search($request->keyword)->paginate($this->perPage)
            : User::paginate($this->perPage);

        return view('admin.users.index', [
            'users' => $users->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
                'name' => 'required|string|min:3|max:40',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|confirmed',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            if($request->has('role')) {
                $request['role'] = Role::select('id', 'name')->find($request->role);
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Assign Role for this User
            $user->assignRole($request->role);

            Alert::success('Add User', 'Success');

            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Add User', 'Error : '.$th->getMessage());

            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'selectedRole' => $user->roles->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role' => 'required',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            if($request->has('role')) {
                $request['role'] = Role::select('id', 'name')->find($request->role);
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            // Update Role for this User
            $user->syncRoles($request->role);

            Alert::success('Edit User', 'Success');

            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Edit User', 'Error : '.$th->getMessage());

            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();

        try {
            // Remove Role for this User
            $user->removeRole($user->roles->first());
            $user->delete();

            Alert::success('Delete User', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Delete User', 'Error : '.$th->getMessage());
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }
}
