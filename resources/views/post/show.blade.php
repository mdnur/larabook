@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-8 ">
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" height="45" src="{{ $post->user->avatar->getUrl() }}" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><a href="{{ route('profile.show',$post->user->username) }}">{{ $post->user->name }}</a></div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
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
                        <a class="card-link" href="#">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </a>

                        <p class="card-text">
                            {!! $post->content , 150 !!}
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
                        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                    </div>

                </div>
                <div class="mt-2"></div>
                <div class="card gedf-card ">
                    <form action="{{ route('comment.store',$post->id) }}" method="Post">
                        @csrf
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                        a Comment</a>
                                </li>
                                {{--   <li class="nav-item">
                                       <a class="nav-link " id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                                   </li>--}}
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane active show fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="message" rows="3" placeholder="What are you thinking?" name="body"></textarea>
                                        @if ($errors->has('body'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="tab-pane fade  " id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </div>


                             {{--   <div class="btn-group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-globe"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-2"></div>
                <div class="container">
                    <div class="row">
                        <div class="panel panel-default widget" style="width: 100%">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-comment"></span>
                                <h3 class="panel-title">
                                    Recent Comments</h3>
                                <span class="label label-info">Total comments {{ $post->comments->count() }}</span>
                            </div>
                            <div class="panel-body" id="panel_body">
                                <ul class="list-group" style="width: 100%">
                                    @foreach ($comments as $comment)
                                        <li class="list-group-item">
                                            <div class="media">
                                                {{--<img class="mr-3" src="http://placehold.it/80" alt="Generic placeholder image">--}}
                                                <img class="mr-3" src="{{ $comment->user->avatarUrl }}" alt="Generic placeholder image" height="80px" width="80px">
                                                <div class="media-body" style="width: 100%">
                                                    <h6 class="mt-0"><a href="#">{{ $comment->user->name }}</a> commented {{ $comment->created_at->diffForHumans() }}</h6>
                                                    <div>
                                                        {{ $comment->body }}
                                                    </div>

                                                        <div class="action">
                                                            @if (auth()->user()->id == $comment->user_id )
                                                            <a href="#" data-toggle="modal" v-on:click="getComment({{ $comment->id }})" data-target="#exampleModal{{ $comment->id }}">Edit</a> |
                                                            {{--<a href="">Approved</a> |--}}
                                                            @endif
                                                            @if ($comment->user_id == $post->user_id or auth()->user()->id == $comment->user_id)
                                                                <form action="{{ route('comment.delete',$comment->id) }}" method="Post"
                                                                      style="display: inline" id="delete-form-{{ $comment->id }}">
                                                                    @csrf
                                                                    @method('Delete')
                                                                    <a href="" @click.prevent="showAlert('{{ $comment->id }}')">Delete</a>
                                                                </form>
                                                            @endif
                                                        </div>

                                                </div>
                                            </div>
                                        </li>
                                        <!-- Modal -->
                                        <form action="{{ route('comment.update',$comment->id) }}" method="Post">
                                            @csrf
                                            @method('put')
                                        <div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="body">Comment Text</label>
                                                            <textarea class="form-control" id="body"  name="body" rows="3">@{{ comment.body }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                        <!--/ Model -->
                                    @endforeach

                                </ul>
                                <div class="mt-2"></div>
                                {{ $comments->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>



    </div>

@endsection
