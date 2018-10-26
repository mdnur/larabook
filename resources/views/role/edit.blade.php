@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Permission of Role <a href="">{{ $role->name }} </a></div>
                    <div class="card-body">
                        <form action="{{ route('role.update',$role->id) }}" method="Post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ $role->name }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="displayName">Display Name (Optional)</label>
                                <input type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" id="displayName" name="display_name" value="{{ $role->display_name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description Name (Optional)</label>
                                <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" value="{{ $role->description }}">

                                @if ($errors->has('display_name'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <hr>
                            <h1>Permission</h1>
                            @foreach($permissions as $allPermission)

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck{{ $allPermission->id }}"  name="check[]" value="{{ $allPermission->id }}" @foreach($role->permissions()->pluck('id') as $pluck) @if($allPermission->id == $pluck) checked @endif @endforeach>
                                    <label class="form-check-label" for="exampleCheck{{ $allPermission->id }}">{{ $allPermission->name }}</label>

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">description
                                            <strong>{{ $errors->first('role') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
