@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header"><div class="float-left"><h4>Role</h4></div><div class="float-right"><a class="btn btn-secondary" href="{{ route('role.create') }}">Create Role</a></div></div>

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
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->display_namme }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td class="align-items-center">
                                        <a href="{{ route('role.edit',$role->id) }}"
                                           class="btn btn-secondary">Edit</a>
                                        <a href="{{ route('role.show',$role->id) }}"
                                           class="btn btn-primary">View</a>
                                        <form action="{{ route('role.destroy',$role->id) }}" method="Post"
                                              style="display: inline" id="delete-form-{{ $role->id }}">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger"
                                                    @click.prevent="showAlert('{{ $role->id }}')">Delete
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
