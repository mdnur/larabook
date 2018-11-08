<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store($following)
    {
        $follow = User::findOrFail($following);
        auth()->user()->follow($follow);
        return back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function unfollowing($id)
    {
        $follow = User::findOrFail($id);
        auth()->user()->unfollow($follow);
        return back();
    }
}
