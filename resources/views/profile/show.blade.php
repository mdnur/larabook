@extends('layouts.app')

@section('content')
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="fb-profile">
            <div style="background-image: url({{ asset('images/0.jpeg') }});width:100%;height: 300px">
                {{--<img align="left" class="fb-image-lg" src="{{ asset('images/0.jpeg') }}"  width="400" height="300"  alt="Profile image example"/>--}}
                <div class="fb-image-lg" style="background-image: url({{ asset('images/0.jpeg') }});"></div>
                <div>
                    <div class="avatar-upload">
                        `
                        <form action="{{ route('profile.avatar') }}" method="Post" enctype="multipart/form-data">
                            @if (auth()->user()->id == $user->id)
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="avatar"
                                           v-on:click="getSubmit()"/>
                                    <label for="imageUpload"></label>
                                </div>
                            @endif
                            <div class="avatar-preview">
                                <div id="imagePreview" class="thumbnail"
                                     style="background-image: url({{ $user->avatarUrl ==null  ? '' : $user->avatarUrl }});" align="left">
                                </div>

                                @csrf
                                <button type="submit" class="btn btn-success" style="margin: 15px 54px;" v-if="check">
                                    Upload
                                </button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
            {{--<img align="left" class="fb-image-profile thumbnail" src="http://lorempixel.com/180/180/people/9/" alt="Profile image example"/>--}}
            <div class="fb-profile-text">
                <h1>{{ $user->name }} </h1>
                <h6>Followed By <span class="badge badge-secondary"> {{ $user->followings()->count() }}</span> persons</h6>
                <b>Bio</b>
                <p>{{ $user->bio }}</p>
                <p>Date OF Birth : {{ $user->birthday }}</p>
                <p>Gender : {{ $user->gender ? 'male' : 'female' }}</p>
                @if (auth()->user()->id == $user->id)
                    <a href="{{ route('profile.edit',$user->id) }}" class="btn btn-info"> Edit Profile</a>
                @endif

            </div>

            <div class="profile-pic-upload">

            </div>


        </div>

    </div>
    <div class="container">
        <div class="row ">
            <div class="col-md-10">

                @forelse($posts as $post)
                    <div class="card gedf-card mt-2">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="50px" height="50px"
                                             src="{{ $post->user->avatar->getUrl() }}" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0"><a
                                                href="{{ route('profile.show',$post->user->username) }}">{{ $post->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">Configuration</div>
                                            <a class="dropdown-item" href="#">Save</a>
                                            <a class="dropdown-item" href="{{ route('post.edit',$post->id) }}">Edit</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"><i
                                    class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}</div>
                            <a class="card-link" href="{{ route('post.show',$post->slug) }}">
                                <h5 class="card-title">{{ $post->title }}</h5>
                            </a>

                            <p class="card-text">
                                {!! str_limit($post->content , 150) !!}
                                <a href="{{ route('post.show',$post->slug) }}">more</a>
                            </p>
                            <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="" width="100%" height="100%">
                            <div>
                                tags:
                                @forelse($post->tags as $tag)
                                    <span class="badge badge-primary">{{ $tag->name }}</span>
                                @empty
                                    <span class="badge badge-primary">No tags found</span>
                                @endforelse

                            </div>
                        </div>
                        <div class="card-footer">
                            @if ($post->liked)
                                <a style="color: red;" href="{{ route('like.post',$post->id) }}"
                                   onclick="event.preventDefault();document.getElementById('unlike-form-{{ $post->id }}').submit();"
                                   class="card-link"><i class="fa fa-gittip"></i> Unlike</a>
                                <a href="#" data-toggle="modal" v-on:click="getLikers({{ $post->id }})"
                                   data-target="#exampleModal{{ $post->id }}"><span
                                        class="badge ">{{ $post->likesCount }}</span></a>
                                <form id="unlike-form-{{ $post->id }}" action="{{route('unlike.post',$post->id) }}"
                                      method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('like.post',$post->id) }}"
                                   onclick="event.preventDefault();document.getElementById('like-form-{{ $post->id }}').submit();"
                                   class="card-link"><i class="fa fa-gittip"></i> Like</a><a href=""><span
                                        class="badge ">{{ $post->likesCount }}</span></a>
                                <form id="like-form-{{ $post->id }}" action="{{route('like.post',$post->id) }}"
                                      method="POST" style="display: none;">
                                    @csrf
                                </form>

                            @endif


                            <a href="{{ route('post.show',$post->slug) }}" class="card-link"><i
                                    class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>

                    </div>
                @empty
                    <h1>You have no post yet</h1>
                @endforelse
                <div class="mt-2"></div>{{ $posts->links() }}
            </div>

        </div>
    </div>


@endsection
