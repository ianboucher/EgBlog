<div class="blog-masthead">
    <div class="container">

        <nav class="nav">

            <ul class="nav mr-auto">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="#">New Post</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            </ul>



            <!-- Right Side Of Navbar -->
            <ul class="nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link "href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link "href="{{ route('register') }}">Register</a></li>

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

                                <form id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

        </nav>

    </div>
</div>
