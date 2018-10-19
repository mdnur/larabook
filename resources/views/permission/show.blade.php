@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">View Permission</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name"
                                   value="{{ $permission->name }}" readonly>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="display_name">{{ __('Display Name') }}</label>
                            <input id="display_name" type="text" class="form-control" name="display_name"
                                   value="{{ $permission->display_name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input id="description" type="text" class="form-control" name="description"
                                   value="{{ $permission->description }}" readonly>


                        </div>


                        @foreach($roles as $role)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck{{ $role->id }}"
                                       @foreach ($permission->roles as $myRole)
                                       @if($role->id == $myRole->id)
                                       checked
                                    @endif
                                    @endforeach>
                                <label class="form-check-label"
                                       for="exampleCheck{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach


                        <div class="form-group pt-5 ">
                            <a class="btn btn-primary" href="{{ route('permission.index') }}">
                                {{ __('Go back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
