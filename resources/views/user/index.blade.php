@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header"><div class="float-left"><h4>User</h4></div><div class="float-right"><a class="btn btn-secondary" href="{{ route('user.create') }}">Create user</a></div></div>

                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Role</th>
                                <th>Join Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="align-items-center">
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>@foreach ($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td class="align-items-center">
                                        <a href="{{ route('user.edit',$user->id) }}"
                                           class="btn btn-secondary">Edit</a>
                                        <a href="{{ route('user.show',$user->id) }}"
                                           class="btn btn-primary">View</a>
                                        <form action="{{ route('user.destroy',$user->id) }}" method="Post"
                                              style="display: inline" id="delete-form-{{ $user->id }}">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger"
                                                    @click.prevent="showAlert('{{ $user->id }}')">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                No user available
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
