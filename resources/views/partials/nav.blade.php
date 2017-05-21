<div class="blog-masthead">
    <div class="container">

        <div class="col-xs-8">
            <nav class="nav">
                <a class="nav-link active" href="#">Home</a>
                <a class="nav-link" href="#">New features</a>
                <a class="nav-link" href="#">Press</a>
                <a class="nav-link" href="#">New hires</a>
                <a class="nav-link" href="#">About</a>
            </nav>
        </div>

        <!-- Right Side Of Navbar -->
        <nav class="nav navbar-right">
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <a class="nav-link "href="{{ route('login') }}">Login</a>
                  <a class="nav-link "href="{{ route('register') }}">Register</a>
              @else
                  <li class="dropdown">
                      <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                      </ul>
                  </li>
              @endif
        </nav>

    </div>
</div>
