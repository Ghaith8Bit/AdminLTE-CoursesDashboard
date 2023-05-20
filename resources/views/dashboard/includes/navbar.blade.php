<nav class="main-header navbar navbar-expand navbar-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard.home') }}"
                    class="nav-link {{ request()->is('dashboard') ? 'text-primary' : '' }}">Home</a>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard.users.index') }}"
                        class="nav-link {{ request()->is('dashboard/users') ? 'text-primary' : '' }}">Users</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard.courses.index') }}"
                        class="nav-link {{ request()->is('dashboard/courses') ? 'text-primary' : '' }}">Courses</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard.announcements.index') }}"
                        class="nav-link {{ request()->is('dashboard/announcements') ? 'text-primary' : '' }}">Announcements</a>
                </li>
            @endif
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link {{ request()->is('#') ? 'text-primary' : '' }}">Chat</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
