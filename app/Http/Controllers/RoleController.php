<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    private $perPage = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $request->get('keyword')
            ? Role::where('name', 'LIKE', "%$request->keyword%")->paginate($this->perPage)
            : Role::paginate($this->perPage);

        return view('admin.role.index', [
            'roles' => $roles->withQueryString(),
        ]);
    }

    public function getRoles(Request $request)
    {
        $roles = $request->has('q')
            ? Role::where('name', 'LIKE', "%$request->q%")
            : Role::limit(5)->get();

        return response()->json($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create', [
            'authorities' => config('permission.authorities'),
        ]);
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
                'name' => 'required|string|min:3|unique:roles,name',
                'permissions' => 'required',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            // insert to table Roles
            $role = Role::create([
                'name' => $request->name,
            ]);
            
            // pivot role_has_permission
            $role->givePermissionTo($request->permissions);

            Alert::success('Add Role', 'Success');

            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Add Role', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.role.show', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'rolePermissions' => $role->permissions->pluck('name')->toArray(), 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'checkedRole' => $role->permissions->pluck('name')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|unique:roles,name,'.$role->id,
                'permissions' => 'required',
            ],
            [],
            [],
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            // insert to table Roles
            $role->name = $request->name;
            // pivot role_has_permission
            $role->syncPermissions($request->permissions);

            $role->save();

            Alert::success('Edit Role', 'Success');

            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Edit Role', 'Error : '.$th->getMessage());
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        DB::beginTransaction();

        try {
            // pivot role_has_permission
            $role->revokePermissionTo($role->permissions->pluck('name')->toArray());

            $role->delete();

            Alert::success('Delete Role', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error('Delete Role', 'Error : '.$th->getMessage());
        } finally {
            DB::commit();

            return redirect()->back();
        }
    }
}
