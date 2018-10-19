@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <i class="fas fa-user"></i>
                        You are logged in!
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Category</div>

                <div class="card-body">
                    <div class="nav flex-column nav-pills">
                        <a class="nav-link active" id="v-pills-home-tab" href="">Home</a>
                        <a class="nav-link" id="v-pills-profile-tab" href="">Profile</a>
                        <a class="nav-link" id="v-pills-messages-tab" href="">Messages</a>
                        <a class="nav-link" id="v-pills-settings-tab" href="">Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
