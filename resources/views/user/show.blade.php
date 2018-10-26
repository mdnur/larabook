@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Create User</div>

                    <div class="card-body">
                        <form>

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"  readonly>
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>


                            </div>


                            <div class="form-group">
                                <label for="email">{{ __('Username') }}</label>
                                <input id="email" type="text" class="form-control" name="username" value="{{ $user->username }}" readonly>
                            </div>



                           {{-- <div class="form-group">
                                <label for="roles">{{ __('Roles for User') }}</label>
                                <select class="js-example-basic-multiple js-states form-control" id="roles"
                                        name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @foreach($user->roles->pluck('id') as $roleChecked)  @if($roleChecked == $role->id)  checked @endif  @endforeach>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>--}}

                            <div class="form-group">
                                <label for="role">{{ __('Username') }}</label>
                                @foreach ($user->roles as $role)
                                    <input id="role" type="text" class="form-control"  value="{{ $role->name }}" readonly>
                                @endforeach
                            </div>



                            <div class="form-group">
                                <a href="{{ route('user.index') }}" class="btn btn-primary">
                                    {{ __('back') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
