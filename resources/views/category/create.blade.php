@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Create Category</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <input id="description" type="text"
                                       class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                       name="description" value="{{ old('description') }}">

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">description
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group"></div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create category') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
