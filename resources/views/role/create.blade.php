@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Create Role</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('role.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" >{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="display_name" >{{ __('Display Name') }}</label>
                                <input id="display_name" type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ old('display_name') }}">

                                @if ($errors->has('display_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description" >{{ __('Description') }}</label>
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}"  >

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>

                            @foreach($permissions as $permission)
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck{{ $permission->id }}" name="check[]" value="{{ $permission->id }}">
                                    <label class="form-check-label"
                                           for="exampleCheck{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach

                             <div class="form-group"></div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Role') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
