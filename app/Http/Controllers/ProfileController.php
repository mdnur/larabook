<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('profile.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $username
     * @return void
     */
    public function show($username)
    {
        //user
        $user = User::Where(['username' => $username])->get()->first();
        //post

        /*        foreach ($user->followings()->get() as $follwers) {

                    dd($follwers);
                }*/


        $posts = Post::whereUserId($user->id)->orderBy('created_at', 'desc')->paginate(5);

        dd($user->avatarUrl);

        return view('profile.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $username
     * @return void
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $username
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|',
            'username' => 'required',
            'birthday' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->birthday = $request->get('birthday');
        $user->bio = $request->get('bio');
        $user->gender = $request->get('gender');
        $user->username = $request->get('username');
        $user->save();
        return redirect(route('profile.show', $request->username));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $username
     * @return void
     */
    public function destroy($username)
    {
        //
    }

    public function avatar(Request $request)
    {
        $user = auth()->user();
        $id = $user->addMedia($request->file('avatar'))->toMediaCollection('images')->id;
        $userUpdate = User::findOrFail($user->id);
        $userUpdate->avatar_id = $id;
        $userUpdate->save();
    }

    public function getLikers($id)
    {
        $post = Post::with('user')->findOrfail($id);
        $post->user->avatarUrl;
        return $post->collectLikers();
    }

    public function ChangePasswordView()
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('profile.change', compact('user'));
    }

    public function ChangePassword(Request $request, $id)
    {
        $this->validate($request, [
            'currant_password' => 'required',
            'new_password' => ['required', 'string', 'min:6']
        ]);

        $user = User::findOrfail($id);
        if (!Hash::check($request->currant_password, $user->password)) {
            flash('Current password does not matched')->error();
            return back();
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect(route('profile.show', auth()->user()->username));
    }
}
