@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left"><h4>Role</h4></div>
                        <div class="float-right"><a class="btn btn-secondary" href="{{ route('category.create') }}">Create
                                Category</a></div>
                    </div>

                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Role Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="align-items-center">
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td class="align-items-center">
                                        <a href="{{ route('category.edit',$category->id) }}"
                                           class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('category.destroy',$category->id) }}" method="Post"
                                              style="display: inline" id="delete-form-{{ $category->id }}">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger"
                                                    @click.prevent="showAlert('{{ $category->id }}')">Delete
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
