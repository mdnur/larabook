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
                                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
                            </div>
                            <div class="form-group">
                                <label for="displayName">Display Name (Optional)</label>
                                <input type="text" class="form-control" id="displayName" name="display_name" value="{{ $role->display_name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description Name (Optional)</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $role->description }}">
                            </div>
                            <hr>
                            <h1>Permission</h1>
                            @foreach($permissions as $allPermission)

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck{{ $allPermission->id }}"  name="check[]" value="{{ $allPermission->id }}" @foreach($role->permissions()->pluck('id') as $pluck) @if($allPermission->id == $pluck) checked @endif @endforeach>
                                    <label class="form-check-label" for="exampleCheck{{ $allPermission->id }}">{{ $allPermission->name }}</label>
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
