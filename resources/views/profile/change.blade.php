@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Update Profile</div>

                    <div class="card-body">
                        <form action="{{ route('profile.change.put',$user->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="Currant_password">{{ __('Currant password') }}</label>
                                <input id="Currant_password" type="password"
                                       class="form-control{{ $errors->has('currant_password') ? ' is-invalid' : '' }}"
                                       name="currant_password">

                                @if ($errors->has('currant_password'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('currant_password') }}</strong>
                                </span>
                                @endif
                            </div>
                            @include('flash::message')
                            <div class="form-group">
                                <label for="new_password">{{ __('New Password') }}</label>
                                <input id="new_password" type="password"
                                       class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}"
                                       name="new_password">

                                @if ($errors->has('new_password'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
