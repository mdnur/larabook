<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
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
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.create', compact('categories', 'tags'));
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
            'title' => 'required|max:120|unique:posts',
            'content' => 'required'
        ]);
        list($intTag, $strTag) = $this->separateStringAndIntergerOfArray($request);

        $post = new Post();
        $post->title = $request->get('title');
        $post->category_id = $request->get('category_id');
        $post->user_id = auth()->user()->id;
        $post->content = $request->get('content');
        $post->description = $request->get('description');
        $post->save();
        if (empty($strTag)) {
            foreach ($strTag as $tag) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->save();
                $tags->posts()->attach($post->id);
            }
        }

        $post->tags()->sync($intTag);


        return redirect(route('post.index'))->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'content' => 'required'
        ]);
        list($intTag, $strTag) = $this->separateStringAndIntergerOfArray($request);

        $post = Post::findOrFail($id);
        $post->title = $request->get('title');
        $post->category_id = $request->get('category_id');
        $post->user_id = auth()->user()->id;
        $post->content = $request->get('content');
        $post->description = $request->get('description');
        $post->save();
        if (empty($strTag)) {
            foreach ($strTag as $tag) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->save();
                $tags->posts()->attach($post->id);
            }
        }

        $post->tags()->sync($intTag);


        return redirect(route('post.index'))->with('success', 'Post Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }


    /**
     * @param Request $request
     * @return array
     */
    private function separateStringAndIntergerOfArray(Request $request): array
    {
        $intTag = [];
        $strTag = [];
        foreach ($request->get('tags') as $tag) {
            if (is_numeric($tag)) {
                array_push($intTag, $tag);
            } else {
                array_push($strTag, $tag);
            }
        }
        return array($intTag, $strTag);
    }
}
