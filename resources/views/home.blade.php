@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8 justify-content-center ">
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4>This is alpha version. And  Give me some feedback How I improve my website</h4>
                <p>Developed by <a href="http://facebook.com/realmdnur">mdnur</a></p>
            </div>
            <div class="card">
                <form action="{{ route('post.store') }}" method="POST" style="display: inline" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active  " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Make a Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Upload photo</a>
                        </li>
                        {{--<li class="nav-item">
                            <a class="nav-link active" id="Misssing-tab" data-toggle="tab" href="#Misssing" role="tab" aria-controls="profile" aria-selected="false">Misssing</a>
                        </li>--}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       id="title" name="title" placeholder="Title">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback{{ $errors->has('title') ? ' is-invalid' : '' }}" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="content1">Content</label>
                                <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                           rows="3" name="content" id="content1" v-on:click="checkContent"></textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback{{ $errors->has('content') ? ' is-invalid' : '' }}" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="file">Add Media</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>

                            <div class="form-group"  >
                                <label for="tags">Tags</label>
                                <select class="form-control js-example-tokenizer" multiple="multiple" id="tags"
                                        name="tags[]">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            {{--<form action="#">--}}
                                <div class="form-group">
                                    <label for="file">Photo</label>
                                    <input type="file" class="form-control-file" id="file">
                                </div>
                            {{--</form>--}}
                        </div>

                        {{--<div class="tab-pane fade show active" id="Misssing" role="tabpanel" aria-labelledby="Misssing-tab">--}}

                        {{--</div>--}}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Post</button>
                </div>

                </form>
            </div>


        @foreach($posts as $post)
                <div class="card gedf-card mt-2">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="50px" height="50px" src="{{ $post->user->avatar->getUrl() }}" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><a href="{{ route('profile.show',$post->user->username) }}">{{ $post->user->name }}</a></div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    @if ($post->user->id != auth()->user()->id)
                                        @if (!$post->user->isFollowedBy(auth()->user()->id))
                                            <a href="{{ route('follow.store',$post->user->id) }}" class="btn btn-info">Follow</a>
                                        @else
                                            <a href="{{ route('unfollow.store',$post->user->id) }}" class="btn btn-success">Following</a>
                                        @endif
                                    @endif
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        @if ($post->user->id == auth()->user()->id)
                                            {{--<a class="dropdown-item" href="{{ route('post.destroy',$post->id) }}">Delete</a>--}}
                                            <form action="{{ route('post.destroy',$post->id) }}" method="Post"
                                                  style="display: inline" id="delete-form-{{ $post->user->id }}">
                                                @csrf
                                                @method('Delete')
                                                <button class="dropdown-item"
                                                        @click.prevent="showAlert('{{ $post->user->id }}')">Delete
                                                </button>
                                            </form>
                                        @endif


                                        @if ($post->user->id == auth()->user()->id)
                                            <a class="dropdown-item" href="{{ route('post.edit',$post->id) }}">Edit</a>
                                        @endif
                                        <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}</div>
                        <a class="card-link" href="{{ route('post.show',$post->slug) }}">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </a>

                        <p class="card-text">
                           {!! str_limit($post->content , 150) !!}
                            <a href="{{ route('post.show',$post->slug) }}">more</a>



                        </p> <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="" width="100%" height="100%">
                        {{--{{ $post->getUrl('posts') }}--}}
                        <div>
                            tags:
                            @forelse($post->tags as $tag)
                                <span class="badge badge-primary">{{ $tag->name }}</span>
                            @empty
                                no tags
                            @endforelse

                        </div>
                    </div>
                    <div class="card-footer">

                        @if ($post->liked)
                            <a  style="color: red;" href="{{ route('like.post',$post->id) }}" onclick="event.preventDefault();document.getElementById('unlike-form-{{ $post->id }}').submit();" class="card-link"><i class="fa fa-gittip"></i> Unlike</a>
                            <a href="#" data-toggle="modal" v-on:click="getLikers({{ $post->id }})" data-target="#exampleModal{{ $post->id }}"><span class="badge ">{{ $post->likesCount }}</span></a>
                            <form id="unlike-form-{{ $post->id }}" action="{{route('unlike.post',$post->id) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('like.post',$post->id) }}" onclick="event.preventDefault();document.getElementById('like-form-{{ $post->id }}').submit();" class="card-link"><i class="fa fa-gittip"></i> Like</a><a href=""><span class="badge ">{{ $post->likesCount }}</span></a>
                            <form id="like-form-{{ $post->id }}" action="{{route('like.post',$post->id) }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        @endif

                            <div class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Like by</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" v-for="like in likes">
                                          <p >@{{ like.name }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <a href="{{ route('post.show',$post->slug) }}" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>

                </div>
            @endforeach
            <div class="mt-2"></div>{{ $posts->links() }}
        </div>

    </div>
</div>

@endsection
