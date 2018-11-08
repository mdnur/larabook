@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left"><h4>User</h4></div>

                    </div>

                    <div class="card-body">
                        @forelse($users as $user)
                            <div class="media" style="padding: 9px;border: 1px solid #ddd;">
                                @if ($user->avatar != null)
                                    <img class="mr-3" src="{{ $user->avatarUrl }}" alt="Generic placeholder image" width="64px" height="64px">
                                @else
                                    <img class="mr-3"  alt="Generic placeholder image" width="64px" height="64px">
                                @endif
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5 class="mt-0"><a
                                                    href="{{ route('profile.show',$user->username) }}">{{ $user->name }}</a>
                                            </h5>
                                            <p>{{ $user->bio }}</p>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-info" style="    margin-top: 18px;">Follow</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <p>There are no users found for this name</p>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
