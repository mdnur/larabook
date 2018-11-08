@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Create User</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="email">{{ __('Username') }}</label>
                                <input id="email" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @else
                                    <small id="emailHelp" class="form-text text-muted">username be like this jone_doe,etc</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('password') }}</label>
                                <input id="password" type="text"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" value="{{ old('password') }}">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                     </span>


                                @endif


                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="birthday">Birth Day</label>--}}
                                {{--<input type="text" class="form-control datepicker" id="birthday"  name="birthday" value="02-16-2000">--}}
                                {{--<small id="emailHelp" class="form-text text-muted">m/d/y</small>--}}
                            {{--</div>--}}


                            <div class="form-group">
                                <label for="roles">{{ __('Roles for User') }}</label>
                                <select class="js-example-basic-multiple js-states form-control" id="roles"
                                        name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create User') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
