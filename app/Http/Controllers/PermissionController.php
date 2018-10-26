<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest()->get();
        return view('permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::latest()->get();
        return view('permission.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50|unique:permissions',
        ]);

        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->display_name = $request->get('display_name');
        $permission->description = $request->get('description');
        $permission->save();

        if ($request->roles) {
            foreach ($request->roles as $role) {
                $permission->roles()->attach($role);
            }
        }

        return redirect(route('permission.index'))->with('success', 'Role added');
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return void
     */
    public function show(Permission $permission)
    {
        //
        $roles = Role::all();
        return view('permission.show', compact('permission', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return void
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('permission.edit', compact('permission', 'permissions','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permision = Permission::findOrfail($id);
        $permision->name = $request->name;
        $permision->display_name = $request->display_name;
        $permision->description = $request->description;
        $permision->save();
        if ($request->roles) {
            $permision->roles()->sync($request->roles);
        }

        return redirect()->route('permission.index')->with('success', 'Permision updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return void
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        if ($permission->delete()) {
            return redirect(route('permission.index'))->with('success', 'Delete successfully');
        } else {
            return redirect(route('permission.index'))->with('error', 'Something Wroung');
        }
    }
}
