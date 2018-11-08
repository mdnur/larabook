@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit Post</div>

                    <div class="card-body">
                        <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       id="title" name="title" value="{{ $post->title }}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                          role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                       id="description" name="description" value="{{ $post->description }}">
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
                                          id="content" rows="3" name="content">{{ $post->content }}</textarea>
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
                                        <option value="{{ $category->id }}" @if($post->category_id)
                                        @if($category->id == $post->category->id)
                                        selected
                                            @endif @endif>{{ $category->name }}</option>
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
                                <label for="file">Add Media</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                                <small id="emailHelp" class="form-text text-muted">Sorry!!!! You can upload only one file for one post</small>
                            </div>

                            <div class="form-group">
                                <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="" width="40%" height="40%">
                            </div>


                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select class="form-control js-example-tokenizer" multiple="multiple" id="tags"
                                        name="tags[]">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                                @foreach ($post->tags as $mytag)
                                                @if($tag->id == $mytag->id)
                                                selected
                                            @endif
                                            @endforeach>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection
