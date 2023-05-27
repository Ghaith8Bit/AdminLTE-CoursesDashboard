<nav class="main-header navbar navbar-expand-md navbar-dark">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="{{ route('dashboard.home') }}">IBP</a>

    <!-- Hamburger icon for navbar toggle button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="{{ route('dashboard.home') }}"
                    class="nav-link {{ request()->is('dashboard') ? 'text-primary' : '' }}">Home</a>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a href="{{ route('dashboard.users.index') }}"
                        class="nav-link {{ request()->is('dashboard/users') ? 'text-primary' : '' }}">Users</a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('dashboard.courses.index') }}"
                    class="nav-link {{ request()->is('dashboard/courses') ? 'text-primary' : '' }}">Courses</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.announcements.index') }}"
                    class="nav-link {{ request()->is('dashboard/announcements') ? 'text-primary' : '' }}">Announcements</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.chats.index') }}" class="nav-link {{ request()->is('dashboard/chats') ? 'text-primary' : '' }}">Chat</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
