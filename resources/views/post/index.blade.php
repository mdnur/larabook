@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left"><h4>Post</h4></div>
                        <div class="float-right"><a class="btn btn-secondary" href="{{ route('post.create') }}">Create
                                Post</a></div>
                    </div>

                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Post Title</th>
                                <th>slug</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="align-items-center">
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->slug }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td class="align-items-center">
                                        <a href="{{ route('post.edit',$post->id) }}"
                                           class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('post.destroy',$post->id) }}" method="Post"
                                              style="display: inline" id="delete-form-{{ $post->id }}">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger"
                                                    @click.prevent="showAlert('{{ $post->id }}')">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
