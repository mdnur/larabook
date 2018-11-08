@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Created Post</div>

                    <div class="card-body">
                        <form action="{{ route('post.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       id="title" name="title" placeholder="Title">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                          role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group" >
                                <label for="description">Description</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                       id="description" name="description" placeholder="Description">
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                          id="content" rows="3" name="content"></textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                          role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                {{--  <select class="form-control" id="exampleFormControlSelect1">
                                      <option>1</option>

                                  </select>--}}
                                <select class="js-example-basic-multiple js-states form-control" id="category"
                                        name="category[]">
                                    <option value="1">Uncategorized</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="invalid-feedback{{ $errors->has('category') ? ' is-invalid' : '' }}"
                                          role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select class="form-control js-example-tokenizer" multiple="multiple" id="tags"
                                        name="tags[]">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.0.0/quill.js"></script>
    <script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>



    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.0.0/quill.core.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.0.0/quill.core.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    </script>
@endsection
