<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="/">{{ config('app.name', 'MNFFL') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      @auth
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
          <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
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
</nav>