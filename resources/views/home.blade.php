@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-10">
            @foreach($posts as $post)
                <div class="card mt-2">
                    <div class="card-header">
                        <div class="float-left"><a href="">{{ $post->user->name }}</a></div>
                        <div class="float-right">Created <a href="">{{ $post->created_at->diffForHumans() }}</a></div>
                    </div>
                    <div class="card-body" id="something">
                        <a href=""><h3>{{ $post->title }}</h3></a>
                        {!! $post->content  !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
