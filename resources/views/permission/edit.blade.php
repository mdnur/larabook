@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Create Permission</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('permission.update',$permission->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ $permission->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="display_name">{{ __('Display Name') }}</label>
                                <input id="display_name" type="text"
                                       class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}"
                                       name="display_name" value="{{ $permission->display_name }}">

                                @if ($errors->has('display_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <input id="description" type="text"
                                       class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                       name="description" value="{{ $permission->description }}">

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="roles">{{ __('Permission for Roles ') }}</label>
                                <select class="js-example-basic-multiple js-states form-control" id="roles"
                                        name="roles[]" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                                @foreach ($permission->roles as $myRole)
                                                @if($role->id == $myRole->id)
                                                selected
                                            @endif
                                            @endforeach>{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Permission') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
