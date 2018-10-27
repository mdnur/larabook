@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>Update Category</h4></div>
                    <div class="card-body">
                        <form action="{{ route('category.update',$category->id) }}" method="Post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       id="name" name="name" value="{{ $category->name }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}"
                                       id="slug" name="slug" value="{{ $category->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description Name (Optional)</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                       id="description" name="description" value="{{ $category->description }}">

                                @if ($errors->has('display_name'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                                @endif
                            </div>


                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
