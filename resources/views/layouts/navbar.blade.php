<nav class="navbar navbar-expand-md bg-body-tertiary shadow-sm" aria-label="Fourth navbar example">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="/img/logo.png" class="img-fluid" alt="Logo" style="height: 35px;">
            St. Gregory the Great Parish</a>
        <i class="fa fas-copy"></i> 
        <button class="navbar-toggler rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            {{-- <span class="navbar-toggler-icon"></span> --}}
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Events</a>
                </li> --}}

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end mt-0 rounded-0" aria-labelledby="navbarDropdown" data-bs-offset="10,5">
                            @if (Auth::user()->is_admin) 
                                <a class="dropdown-item" href="#">Admin Dashboard</a>
                            @else
                                <a class="dropdown-item" href="{{ route('userprofile') }}">My Profile</a>
                                <a class="dropdown-item" href="{{ route('client-documentrequestlist') }}">My Requests</a>
                                <a class="dropdown-item" href="{{ route('clientreservations') }}">My Reservations</a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                
                
            </ul>
        </div>
    </div>
</nav>