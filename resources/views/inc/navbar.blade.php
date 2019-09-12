<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <div class="brand-container">
      <div class="brand-left"></div>
      <a class="navbar-brand" href="/">{{ config('app.name', 'MNFFL') }}</a>
      <div class="brand-right"></div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto">
        @auth
        <li class="nav-item">
          <a class="nav-link" href="/">Posts</a>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="/archive">Archive</a>
          </li>
          @if(Auth::user()->isAdmin())
            <li class="divider">
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/users">Users</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard/') }}">Dashboard</a>
          </li>
        @endauth
      </ul>
      <div class="dropdown-divider"></div>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        {{-- Authentication Links --}}
        @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('/profile/edit/') }}">
                        Edit Profile
                    </a>
                    <a class="dropdown-item" href="{{ url('/password/change/') }}">
                        Change Password
                    </a>
                    <div class="dropdown-divider"></div>
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
  </div>
</nav>