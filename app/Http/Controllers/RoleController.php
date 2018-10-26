<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('role.create',compact('permissions'));
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
            'name' => 'required|unique:roles',
        ]);
        $owner = new Role();
        $owner->name         = $request->get('name');
        $owner->display_name = $request->get('display_name');// optional
        $owner->description  = $request->get('description'); // optional
        $owner->save();
        if ($request->get('check')) {
            $owner->syncPermissions($request->get('check'));
        }

        return redirect(route('role.show',$owner->id))->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return void
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('role.show', compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return void
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('role.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $owner = Role::findOrFail($id);
        $owner->name         = $request->get('name');
        $owner->display_name = $request->get('display_name');// optional
        $owner->description  = $request->get('description'); // optional
        $owner->save();
        if ($request->get('check')) {
            $owner->syncPermissions($request->get('check'));
        }

        return redirect(route('role.edit',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect(route('role.index'))->with('success','Role Deleted Successfully');
    }
}
