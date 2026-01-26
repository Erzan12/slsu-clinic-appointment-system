<nav class="navbar navbar-expand-lg navbar-wrapper  @guest sticky-top @endguest">
    <div class="@guest container @endguest @auth container-fluid @endauth">
      @guest
        <a class="navbar-brand text-light" href="/">{{env('APP_NAME')}}</a>  
        @endguest
        
      @guest
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      @endguest

      <div class="d-lg-none" style="padding:20px;"></div>

      <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
          
          <li class="nav-item">
            <button class="nav-link btn p-2 text-light" id="toggleBtn"></button>
          </li>

          @guest
            <li class="nav-item">
              <a class="nav-link btn btn-outline-primary px-5 text-light" aria-current="page" href="{{route('login')}}">Login</a>
            </li>
          @endguest

          @auth

            <li class="nav-item dropdown d-flex justify-content-center align-items-center">
              <div class="profile-wrapper rounded rounded-circle">
                <img src="{{auth()->user()->avatar()}}" alt="" class="rounded-circle">
              </div>
              <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{auth()->user()->displayName()}}
              </a>
              <ul class="dropdown-menu navbar-dropmenu">
                <li><a class="dropdown-item" href="{{route('profile.information')}}">Profile</a></li>
                <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
              </ul>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>