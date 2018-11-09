<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['delete','destroy','edit']);
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


        if ($request->hasFile('file')) {
            $post->addMedia($request->file)->toMediaCollection('posts');
        }

        $post->tags()->sync($intTag);
        if (!empty($strTag)) {
            foreach ($strTag as $tag) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->save();
                $tags->posts()->attach($post->id);
            }
        }



        return redirect(route('home'))->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return void
     */
    public function show($slug)
    {
        $post = Post::with('tags','user')->whereSlug($slug)->get()->first();


        $comments = Comment::wherePostId($post->id)->orderBy('created_at','desc')->paginate(10);
        return view('post.show', compact('post','comments'));
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
     * @param $id
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
        $post->save();;
        if ($request->hasFile('file')) {
            if ($post->getFirstMedia('posts') != null) {
                Post::find($id)->deleteMedia($post->getFirstMedia('posts')->id);
            }

            $post->addMedia($request->file)->toMediaCollection('posts');
        }

        $post->tags()->sync($intTag);
        if (!empty($strTag)) {
            foreach ($strTag as $tag) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->save();
                $tags->posts()->attach($id);
            }
        }

//        return redirect(route('profile.show',auth()->user()->username))->with('success', 'Post Created');
        return redirect(route('post.show',$post->slug))->with('success', 'Post Updated');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::findOrFail($id);
        $post->delete();
        return redirect(route('profile.show',auth()->user()->username));
    }


    /**
     * @param Request $request
     * @return array
     */
    private function separateStringAndIntergerOfArray(Request $request): array
    {
        $intTag = [];
        $strTag = [];
        if ($request->get("tags")){
            foreach ($request->get('tags') as $tag) {
                if (is_numeric($tag)) {
                    array_push($intTag, $tag);
                } else {
                    array_push($strTag, $tag);
                }
            }
        }
        return array($intTag, $strTag);
    }

    private function deleteImage($post)
    {
        $post->clearMediaCollectionExcept('posts', $post->getFirstMedia());
    }

}
