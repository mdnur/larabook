<div class="collapse navbar-collapse" id="navbarSupportedContent">

        <form class="form-inline" method="get" action="{{ route('search.user') }}">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Any Person" aria-label="Search" name="q">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">
        @auth()
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile.index') }}">{{ __('Find user') }}</a>
        </li>
        @endauth
        @role("superadministrator")
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                User <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.create') }}">
                    {{ __('Create User') }}
                </a>
                <a class="dropdown-item" href="{{ route('user.index') }}">
                    {{ __('User') }}
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                Post <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('post.create') }}">
                    {{ __('Create Post') }}
                </a>
                <a class="dropdown-item" href="{{ route('post.index') }}">
                    {{ __('Post') }}
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                Category <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('category.create') }}">
                    {{ __('Create Category') }}
                </a>
                <a class="dropdown-item" href="{{ route('category.index') }}">
                    {{ __('Category') }}
                </a>
            </div>
        </li>


        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                Role <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('role.create') }}">
                    {{ __('Create Role') }}
                </a>
                <a class="dropdown-item" href="{{ route('role.index') }}">
                    {{ __('Roles') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                Permission <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('permission.create') }}">
                    {{ __('Create Permission') }}
                </a>
                <a class="dropdown-item" href="{{ route('permission.index') }}">
                    {{ __('Permissions') }}
                </a>

            </div>
        </li>
        @endrole
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->

        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}<span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile.show',auth()->user()->username) }}">
                        {{ __('My Profile') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.change') }}">
                        {{ __('Change Password') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

    </ul>
</div>
