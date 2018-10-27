<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::latest()->get();
        return view('user.create',compact('roles'));
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
        $this->validate($request,[
            'name'    => 'required|min:3|max:50',
            'email'   => 'required|email|unique:users',
            'username'   => 'required|unique:users,username',
            'password' => 'required|max:32|min:6',
            'role' => 'required'
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        $user->password = $request->get('password');
        $user->save();
        $user->roles()->sync($request->get('role'));
        return redirect(route('user.index'))->with('success','Successfully added user');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        return view('user.show',compact('user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit',compact('user','roles'));
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
        $this->validate($request,[
            'name'    => 'required|min:3|max:50',
            'email'   => 'required|email|',
            'username'   => 'required',
            'role' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        $user->save();
        $user->roles()->sync($request->get('role'));
        return redirect(route('user.show',$id));
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::findOrFail($id);
        $user->delete();
        return redirect(route('user.index'))->with('success','User deleted Successfully');
    }
}
