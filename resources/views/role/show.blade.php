@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">View Role</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name"
                                   value="{{ $role->name }}" readonly>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="display_name">{{ __('Display Name') }}</label>
                            <input id="display_name" type="text" class="form-control" name="display_name"
                                   value="{{ $role->display_name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input id="description" type="text" class="form-control" name="description"
                                   value="{{ $role->description }}" readonly>


                        </div>


                        @foreach($permissions as $allPermission)
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1"  name="check[]" @foreach($role->permissions()->pluck('id') as $pluck) @if($allPermission->id == $pluck) checked @endif @endforeach readonly>
                                <label class="form-check-label" for="exampleCheck1">{{ $allPermission->name }}</label>
                            </div>
                        @endforeach

                        <div class="form-group pt-5 ">
                            <a class="btn btn-primary" href="{{ route('role.index') }}">
                                {{ __('Go back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
