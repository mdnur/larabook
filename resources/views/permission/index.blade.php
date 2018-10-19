@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">Permissions</div>

                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Permission Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="align-items-center">
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->display_namme }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td class="align-items-center">
                                        <a href="{{ route('permission.edit',$permission->id) }}"
                                           class="btn btn-secondary">Edit</a>
                                        <a href="{{ route('permission.show',$permission->id) }}"
                                           class="btn btn-primary">View</a>
                                        <form action="{{ route('permission.destroy',$permission->id) }}" method="Post"
                                              style="display: inline" id="delete-form-{{ $permission->id }}">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger"
                                                    @click.prevent="showAlert('{{ $permission->id }}')">Delete
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
