@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Update Profile</div>

                    <div class="card-body">
                        <form action="{{ route('profile.update',$user->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ $user->name }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="text"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                       value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="email">{{ __('Username') }}</label>
                                <input id="email" type="text"
                                       class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                       name="username" value="{{ $user->username }}">

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif

                            </div>


                            <div class="form-group">
                                <label for="bio">{{ __('Bio') }}</label>
                                <input id="bio" type="text"
                                       class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" name="bio"
                                       value="{{ $user->bio }}">

                                @if ($errors->has('bio'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bio') }}</strong>
                                </span>
                                @endif

                            </div>
                            {{--  <div class="date form-group" data-provide="datepicker" >
                                  <label for="data">Birthday</label>
                                  <input data-date-format="yyyy/mm/dd" class="form-control" id="data" value="" name="birthday">
                                  <div class="input-group-addon">
                                      <span class="glyphicon glyphicon-th"></span>
                                  </div>
                              </div>
  --}}
                            <div class="form-group">
                                <label for="start">Birthday</label>
                                <input type="date" class="form-control" id="start" name="birthday"
                                       value="{{ $user->birthday }}" max="2010-12-31"/>
                            </div>

                            <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1"
                                                   value="0" @if ($user->gender == 0)
                                                   checked
                                                @endif>
                                            <label class="form-check-label" for="gridRadios1">
                                                Female
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                                   value="1" @if ($user->gender == 1)
                                                   checked
                                                @endif>
                                            <label class="form-check-label" for="gridRadios2">
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>


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
